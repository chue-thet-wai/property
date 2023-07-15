<?php

namespace App\Http\Controllers;
use App\Models\TblProperty;
use App\Models\TblPropertyImage;
use App\Models\TblPropertyDocument;
use App\Models\PropertyFloor;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
 
use Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $response = array();        
        $properties = array();
        $headers = array(
            'Id',            
            'Title',
            'category',
            'Owner',
            'Build Year',
            'Price',
            'Actions',
        );
        $data = TblProperty::select(
        'tbl_properties.*', 'tbl_owners.name')->join('tbl_owners','tbl_owners.id','=','tbl_properties.owner_id');
        if(session()->get(PROPERTY_IDFILTER)){
            $data = $data->where('tbl_properties.id',trim(session()->get(PROPERTY_IDFILTER)));
        }
        if(session()->get(PROPERTY_NAMEFILTER)){
            $data = $data->where('tbl_properties.title','like','%'.trim(session()->get(PROPERTY_NAMEFILTER)).'%');
        }
        // if(session()->get(PROPERTY_CATEGORYFILTER)){
        //     $data = $data->where('tbl_properties.category',trim(session()->get(PROPERTY_CATEGORYFILTER)));
        // }
        if(session()->get(PROPERTY_BUILDYEARFILTER)){
            $data = $data->where('tbl_properties.builtyear',trim(session()->get(PROPERTY_BUILDYEARFILTER)));
        }
        if(session()->get(PROPERTY_MINPRICEFILTER)){
            $data = $data->where('tbl_properties.price','>=',trim(session()->get(PROPERTY_MINPRICEFILTER)));
        }
        if(session()->get(PROPERTY_MAXPRICEFILTER)){
            $data = $data->where('tbl_properties.price','<=',trim(session()->get(PROPERTY_MAXPRICEFILTER)));
        }
        if(session()->get(PROPERTY_DIVISIONFILTER)){
            $data = $data->where('tbl_properties.division',trim(session()->get(PROPERTY_DIVISIONFILTER)));
        }
        if(session()->get(PROPERTY_TOWNSHIPFILTER)){
            $data = $data->where('tbl_properties.township',trim(session()->get(PROPERTY_TOWNSHIPFILTER)));
        }
        if(session()->get(PROPERTY_WARDFILTER)){
            $data = $data->where('tbl_properties.ward',trim(session()->get(PROPERTY_WARDFILTER)));
        }
        $data = $data->where('tbl_properties.is_delete',0)->orderBy('id','DESC')->get();
      
        if($data){
            foreach($data as $row){
                $list = array();
                $list['id'] = $row->id;
                $list['title'] = $row->title;
                $list['category'] = $row->category;
                $list['name'] = $row->name;
                $list['build_year'] = $row->build_year;
                $list['price'] = $row->price;
                $list['actions'] = $row->id;
                $properties[] = $list;
            }
        $response['data'] = $data;
        $response['properties'] = $properties;
        $response['headers'] = $headers;
        $setup['divisions'] = $division_arr;
        $setup['townships'] = $township_arr;
        $setup['wards'] = $ward_arr;

        return view('properties.index',compact('response','setup'));
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
        return view('properties.create', compact('setup'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'owner'=>'required',
            'phonenumber'=>'required',
            'title'=>'required',
            'title_mm'=>'required',
            'status'=>'required',
            'price'=>'required',
            'promotion_price'=>'required',
            'description'=>'required',
            'description_mm'=>'required',
            'postal_code'=>'required',
            'google_map_url'=>'required',
            'detail_address'=>'required',
            'front_area'=>'required',
            'side_area'=>'required',
            'square_feet'=>'required',
            'acre'=>'required',
            'tenure_property'=>'required',
            'property_type'=>'required',
            'floor' =>'required',
            'build_year' => 'required',
            'master_bedroom' => 'required',
            'common_room' => 'required',
            'bathroom' => 'required',
            'building_facility' => 'required',
            'special_features.*' => 'required',
            'remark' => 'required',
            'feature_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'other_photo' => 'required|max:1024',
            'confidential_documents' => 'required|max:1024',
        ]);
      
        $inputs = $request->all();

        $image = $request->feature_photo;
        $imageName = time().rand(1,99).'.'.$image->extension();
        $inputs['feature_photo'] = $imageName;
        $inputs['category'] = SALE;
        $inputs['created_by'] = Auth::user()->id;
        try{            
            $property = TblProperty::create($inputs);
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
                $image['property_id'] = $property->id;  
                // return $image;              
                TblPropertyImage::create($image);
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
                $document['property_id'] = $property->id;  
                // return $image;              
                TblPropertyDocument::create($document);
            }
            Log::error('success save property');
        }catch(Exception $e){
            Log::error('Error save property');
            Log::error($e->getMessage());
        }
        return redirect()->route('properties.index');
    }

    public function edit($id){
        $divisions = get_all_divisions();
        $tenures = get_all_tenures();
        $propertytypes = get_all_propertytypes();
        $floors = get_all_floors();
        $setup = [];          
        $setup['divisions'] = $divisions; 
        $setup['tenures'] = $tenures; 
        $setup['propertytypes'] = $propertytypes; 
        $setup['floors'] = $floors;

        $property = TblProperty::with('owner')->find($id);
        $images = TblPropertyImage::where('property_id',$id)->get();        
        $documents = TblPropertyDocument::where('property_id',$id)->get();        
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        $response['document'] = $documents;

        // return $property;

        return view('properties.edit',compact('response', 'setup'));
    }

    public function update(Request $request,$id){

        $this->validate($request, [
            'owner'=>'required',
            'phonenumber'=>'required',
            'title'=>'required',
            'title_mm'=>'required',
            'status'=>'required',
            'price'=>'required',
            'promotion_price'=>'required',
            'description'=>'required',
            'description_mm'=>'required',
            'postal_code'=>'required',
            'google_map_url'=>'required',
            'detail_address'=>'required',
            'front_area'=>'required',
            'side_area'=>'required',
            'square_feet'=>'required',
            'acre'=>'required',
            'tenure_property'=>'required',
            'property_type'=>'required',
            'floor' =>'required',
            'build_year' => 'required',
            'master_bedroom' => 'required',
            'common_room' => 'required',
            'bathroom' => 'required',
            'building_facility' => 'required',
            'special_features.*' => 'required',
            // 'remark' => 'required',
            // 'feature_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            // 'other_photo' => 'required|max:1024',
            // 'confidential_documents' => 'required|max:1024',
        ]);

        $inputs = $request->all();

        if($request->feature_photo) {
            $image = $request->feature_photo;
            $imageName = time().rand(1,99).'.'.$image->extension();
            $inputs['feature_photo'] = $imageName;
            $image->storeAs('public/feature_images', $imageName);
        }

        $inputs['category'] = SALE;
        $inputs['updated_by'] = Auth::user()->id;
        $property = TblProperty::find($id);
        try{
            $property->update($inputs);
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
                $image['property_id'] = $property->id;  
                // return $image;              
                TblPropertyImage::create($image);
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
                $document['property_id'] = $property->id;  
                // return $image;              
                TblPropertyDocument::create($document);
            }
            Log::error('success save property');
        }catch(Exception $e){
            Log::error('Error update property');
            Log::error($e->getMessage());
        }
        return redirect()->route('properties.index');
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

        $property = TblProperty::with('owner')->find($id);
        $images = TblPropertyImage::where('property_id',$id)->get();        
        $documents = TblPropertyDocument::where('property_id',$id)->get();        
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        $response['document'] = $documents;

        return view('properties.detail',compact('response', 'setup'));
    }

    public function destory_img(Request $request){
        try{
            TblPropertyImage::find($request->id)->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function destory_doc(Request $request){
        try{
            TblPropertyDocument::find($request->id)->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function search(Request $request){
        session()->start();
        session()->put(PROPERTY_IDFILTER, trim($request->id));
        session()->put(PROPERTY_NAMEFILTER, trim($request->name));
        session()->put(PROPERTY_CATEGORYFILTER, trim($request->category));
        session()->put(PROPERTY_LOCATIONFILTER, trim($request->location));
        session()->put(PROPERTY_BUILDYEARFILTER, trim($request->build_year));
        session()->put(PROPERTY_MINPRICEFILTER, trim($request->min_price));
        session()->put(PROPERTY_MAXPRICEFILTER, trim($request->max_price));

        return redirect()->route('properties.index');
    }

    public function reset(){
        session()->forget([
            PROPERTY_IDFILTER,
            PROPERTY_NAMEFILTER,
            PROPERTY_CATEGORYFILTER,
            PROPERTY_LOCATIONFILTER,
            PROPERTY_BUILDYEARFILTER,
            PROPERTY_MINPRICEFILTER,
            PROPERTY_MAXPRICEFILTER,
        ]);
        return redirect()->route('properties.index');
    }
}
