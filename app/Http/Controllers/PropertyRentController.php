<?php

namespace App\Http\Controllers;
use App\Models\PropertyRent;
use App\Models\PropertyRentImage;
use App\Models\PropertyRentDocument;
use App\Models\PropertyRentFloor;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PropertyRentController extends Controller
{
    public function index(Request $request)
    {
        $response = array();        
        $property_rents = array();
        $division_arr = get_all_divisions();
        $township_arr = get_all_townships();
        $ward_arr = get_all_wards();
        $headers = array(
            'Id',            
            'Title',
            'Owner',
            'Division',
            'Township',
            'Ward',
            'Build Year',
            'Price',
            'Actions',
        );
        $data = PropertyRent::select(
        'property_rents.*', 'tbl_owners.name')->join('tbl_owners','tbl_owners.id','=','property_rents.owner_id');
        if(session()->get(PROPERTY_RENT_IDFILTER)){
            $data = $data->where('property_rents.id',trim(session()->get(PROPERTY_RENT_IDFILTER)));
        }
        if(session()->get(PROPERTY_RENT_NAMEFILTER)){
            $data = $data->where('property_rents.title','like','%'.trim(session()->get(PROPERTY_RENT_NAMEFILTER)).'%');
        }        
        if(session()->get(PROPERTY_RENT_BUILDYEARFILTER)){
            $data = $data->where('property_rents.build_year',trim(session()->get(PROPERTY_RENT_BUILDYEARFILTER)));
        }
        if(session()->get(PROPERTY_RENT_MINPRICEFILTER)){
            $data = $data->where('property_rents.price','>=',trim(session()->get(PROPERTY_RENT_MINPRICEFILTER)));
        }
        if(session()->get(PROPERTY_RENT_MAXPRICEFILTER)){
            $data = $data->where('property_rents.price','<=',trim(session()->get(PROPERTY_RENT_MAXPRICEFILTER)));
        }
        if(session()->get(PROPERTY_RENT_DIVISIONFILTER)){
            $data = $data->where('property_rents.division',trim(session()->get(PROPERTY_RENT_DIVISIONFILTER)));
        }
        if(session()->get(PROPERTY_RENT_TOWNSHIPFILTER)){
            $data = $data->where('property_rents.township',trim(session()->get(PROPERTY_RENT_TOWNSHIPFILTER)));
        }
        if(session()->get(PROPERTY_RENT_WARDFILTER)){
            $data = $data->where('property_rents.ward',trim(session()->get(PROPERTY_RENT_WARDILTER)));
        }
        $data = $data->where('property_rents.is_delete',0)->orderBy('id','DESC')->get();
        if($data){
            foreach($data as $row){
                if(isset($row->division, $division_arr)){
                    $division = $division_arr[$row->division];
                }else{
                    $division ='';
                }
                if(isset($row->township, $township_arr)){
                    $township = $township_arr[$row->township];
                }else{
                    $township ='';
                }
                if(isset($row->ward, $ward_arr)){
                    $ward = $ward_arr[$row->ward];
                }else{
                    $ward ='';
                }
                $list = array();
                $list['id'] = $row->id;
                $list['title'] = $row->title;
                $list['name'] = $row->name;
                $list['division'] = $division;
                $list['township'] = $township;
                $list['ward'] = $ward;
                $list['build_year'] = $row->build_year;
                $list['price'] = $row->price;
                $list['actions'] = $row->id;
                $property_rents[] = $list;
            }
        $response['data'] = $data;
        $response['property_rents'] = $property_rents;
        $response['headers'] = $headers;

        $setup['divisions'] = $division_arr;
        $setup['townships'] = $township_arr;
        $setup['wards'] = $ward_arr;

        return view('property_rents.index',compact('response','setup'));
        }
    }

    public function create(){

        $divisions = get_all_divisions();
        $tenures = get_all_tenures();
        $propertytypes = get_all_propertytypes();
        $floors = get_all_floors();
        $setup = [];          
        $setup['divisions'] = $divisions; 
        $setup['tenures'] = $tenures; 
        $setup['propertytypes'] = $propertytypes; 
        $setup['floors'] = $floors;
        
        return view('property_rents.create', compact('setup'));
    }

    public function store(Request $request){
        // return $request->all();
        $this->validate($request, [
            'owner'=>'required',
            'phonenumber'=>'required',
            'title'=>'required',
            'title_mm'=>'required',
            'status'=>'required',
            'price'=>'required',
            'front_area'=>'required',
            'side_area'=>'required',
            'square_feet'=>'required',
            'acre'=>'required',
            'tenure_property'=>'required',
            'property_type'=>'required',
            'floor' =>'required',
            'feature_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'other_photo' => 'required|max:1024',
            'confidential_documents' => 'required|max:1024',
        ]);
      
        $inputs = $request->all();
        $image = $request->feature_photo;
        $imageName = time().rand(1,99).'.'.$image->extension();
        $inputs['feature_photo'] = $imageName;
        $inputs['category'] = RENT;
        $inputs['created_by'] = auth()->user()->id;
        try{            
            $property = PropertyRent::create($inputs);
            $floors = $request->floor;
            if($floors){
                foreach($floors as $floor){
                    $floor_inputs = [];
                    $floor_inputs['property_rent_id'] = $property->id;
                    $floor_inputs['floor_id'] = $floor;                    
                    PropertyRentFloor::create($floor_inputs);
                }
            }
            $image->storeAs('public/feature_images', $imageName);
            $images = [];
            $documents = [];
            if ($request->other_photo){
                foreach($request->other_photo as $key => $image)
                {   
                    $imageName = time().rand(1,99).'.'.$image->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    $image->storeAs('public/property_images', $imageName);
                    // $image->move(public_path('property_images'), $imageName);   
                    $images[]['image'] = $imageName;
                }
            }
            foreach ($images as $key => $image) {
                $image['property_rent_id'] = $property->id;  
                // return $image;              
                PropertyRentImage::create($image);
            }
            if ($request->confidential_documents){
                foreach($request->confidential_documents as $key => $document)
                {   
                    $documentName = time().rand(1,99).'.'.$document->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    $document->storeAs('public/confidential_documents', $documentName);
                    // $image->move(public_path('property_images'), $imageName);   
                    $documents[]['confidential_documents'] = $documentName;
                }
            }
            foreach ($documents as $key => $document) {
                $document['property_rent_id'] = $property->id;  
                // return $image;              
                PropertyRentDocument::create($document);
            }
            Log::error('success save property');
        }catch(Exception $e){
            Log::error('Error save property');
            Log::error($e->getMessage());
        }
        return redirect()->route('property_rents.index');
    }

    public function edit($id){        

        $property = PropertyRent::with('owner')->find($id);
        $images = PropertyRentImage::where('property_rent_id',$id)->get(); 
        $documents = PropertyRentDocument::where('property_rent_id',$id)->get();        
        $property_rent_floors = get_property_rent_floor_id($id);
        
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        $response['documents'] = $documents;
        $response['property_rent_floors'] = $property_rent_floors;
        
        // return $response;
        $divisions = get_all_divisions();
        $townships = get_townships_by_division($property->division);
        $wards = get_wards_by_township($property->township);
        $tenures = get_all_tenures();
        $propertytypes = get_all_propertytypes();
        $floors = get_all_floors();
        $setup = [];          
        $setup['divisions'] = $divisions; 
        $setup['townships'] = $townships; 
        $setup['wards'] = $wards; 
        $setup['tenures'] = $tenures; 
        $setup['propertytypes'] = $propertytypes; 
        $setup['floors'] = $floors;
        return view('property_rents.edit',compact('response','setup'));
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'owner'=>'required',
            'phonenumber'=>'required',
            'title'=>'required',
            'title_mm'=>'required',
            'status'=>'required',
            'price'=>'required',
            'front_area'=>'required',
            'side_area'=>'required',
            'square_feet'=>'required',
            'acre'=>'required',
            'tenure_property'=>'required',
            'property_type'=>'required',
            'floor' =>'required',
        ]);

        // return $request->floor;
      
        $inputs = $request->all();
        if($request->feature_photo){
            $image = $request->feature_photo;
            $imageName = time().rand(1,99).'.'.$image->extension();
            $image->storeAs('public/feature_images', $imageName);
            $inputs['feature_photo'] = $imageName;
        }        
        
        $inputs['updated_by'] = auth()->user()->id;
        $property = PropertyRent::find($id);
        try{           
            $property->update($inputs);
            $floors = $request->floor;
            if($floors){
                PropertyRentFloor::where('property_rent_id', $property->id)->delete();
                foreach($floors as $floor){
                    $floor_inputs = [];
                    $floor_inputs['property_rent_id'] = $property->id;
                    $floor_inputs['floor_id'] = $floor;                    
                    PropertyRentFloor::create($floor_inputs);
                }
            }
            $images = [];
            $documents = [];
            if ($request->other_photo){
                foreach($request->other_photo as $key => $image)
                {   
                    $imageName = time().rand(1,99).'.'.$image->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    $image->storeAs('public/property_images', $imageName);
                    // $image->move(public_path('property_images'), $imageName);   
                    $images[]['image'] = $imageName;
                }
            }
            foreach ($images as $key => $image) {
                $image['property_rent_id'] = $property->id;  
                // return $image;              
                PropertyRentImage::create($image);
            }
            if ($request->confidential_documents){
                foreach($request->confidential_documents as $key => $document)
                {   
                    $documentName = time().rand(1,99).'.'.$document->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    $document->storeAs('public/confidential_documents', $documentName);
                    // $image->move(public_path('property_images'), $imageName);   
                    $documents[]['confidential_documents'] = $documentName;
                }
            }
            foreach ($documents as $key => $document) {
                $document['property_rent_id'] = $property->id;  
                // return $image;              
                PropertyRentDocument::create($document);
            }
            Log::error('success save property');
        }catch(Exception $e){
            Log::error('Error save property');
            Log::error($e->getMessage());
        }
        return redirect()->route('property_rents.index');
    }

    public function destory_img(Request $request){
        try{
            PropertyRentImage::find($request->id)->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function destory_doc(Request $request){
        try{
            PropertyRentDocument::find($request->id)->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function search(Request $request){
        session()->start();
        session()->put(PROPERTY_RENT_IDFILTER, trim($request->id));
        session()->put(PROPERTY_RENT_NAMEFILTER, trim($request->name));
        session()->put(PROPERTY_RENT_BUILDYEARFILTER, trim($request->build_year));
        session()->put(PROPERTY_RENT_MINPRICEFILTER, trim($request->min_price));
        session()->put(PROPERTY_RENT_MAXPRICEFILTER, trim($request->max_price));
        session()->put(PROPERTY_RENT_DIVISIONFILTER, trim($request->division));
        session()->put(PROPERTY_RENT_TOWNSHIPFILTER, trim($request->township));
        session()->put(PROPERTY_RENT_WARDFILTER, trim($request->ward));

        return redirect()->route('property_rents.index');
    }

    public function reset(){
        session()->forget([
            PROPERTY_RENT_IDFILTER,
            PROPERTY_RENT_NAMEFILTER,
            PROPERTY_RENT_BUILDYEARFILTER,
            PROPERTY_RENT_MINPRICEFILTER,
            PROPERTY_RENT_MAXPRICEFILTER,
            PROPERTY_RENT_DIVISIONFILTER,
            PROPERTY_RENT_TOWNSHIPFILTER,
            PROPERTY_RENT_WARDFILTER,
        ]);
        return redirect()->route('property_rents.index');
    }

    public function destroy($id){
        PropertyRent::find($id)->delete();
        return redirect()->route('property_rents.index');
    }
    public function show($id){

        $divisions = get_all_divisions();
        $tenures = get_all_tenures();
        $propertytypes = get_all_propertytypes();
        $floors = get_all_floors();
        $township = get_all_townships();
        $ward = get_all_wards();
        $setup = [];          
        $setup['divisions'] = $divisions; 
        $setup['tenures'] = $tenures; 
        $setup['propertytypes'] = $propertytypes; 
        $setup['floors'] = $floors;
        $setup['township'] = $township;
        $setup['ward'] = $ward;

        $property = PropertyRent::with('owner')->find($id);
        $images = PropertyRentImage::where('property_rent_id',$id)->get();        
        $documents = PropertyRentDocument::where('property_rent_id',$id)->get();        
        $property_floor = PropertyRentFloor::where('property_rent_id',$id)->get();      
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        $response['document'] = $documents;
        $response['property_floor'] = $property_floor;

        return view('property_rents.detail',compact('response', 'setup'));
    }

    public function softdelete(Request $request){
        // return $request->all();
        $property_rent = PropertyRent::find($request->id);    
        if (!$property_rent) {
            abort(404);
        }        
        $property_rent->is_delete = 1;
        $property_rent->updated_by = auth()->user()->id;
        $property_rent->save();
        return redirect()->back(); 
    }

}
