<?php

namespace App\Http\Controllers;
use App\Models\PropertyRent;
use App\Models\PropertyRentImage;
use App\Models\PropertyRentDocument;
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
            'category',
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
        if(session()->get(PROPERTY_RENT_CATEGORYFILTER)){
            $data = $data->where('property_rents.category',trim(session()->get(PROPERTY_RENT_CATEGORYFILTER)));
        }
        
        if(session()->get(PROPERTY_RENT_BUILDYEARFILTER)){
            $data = $data->where('property_rents.builtyear',trim(session()->get(PROPERTY_RENT_BUILDYEARFILTER)));
        }
        if(session()->get(PROPERTY_RENT_MINPRICEFILTER)){
            $data = $data->where('property_rents.price','>=',trim(session()->get(PROPERTY_RENT_MINPRICEFILTER)));
        }
        if(session()->get(PROPERTY_RENT_MAXPRICEFILTER)){
            $data = $data->where('property_rents.price','<=',trim(session()->get(PROPERTY_RENT_MAXPRICEFILTER)));
        }
        $data = $data->orderBy('id','DESC')->paginate(10);
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
                $list['category'] = $row->category;
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

        return view('property_rents.index',compact('response'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
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
            'special_features' => 'required',
            'view_count' => 'required',
            'remark' => 'required',
            'feature_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'other_photo' => 'required|max:1024',
            'confidential_documents' => 'required|max:1024',
            'division'=>'required',
            'township' => 'required',
            'ward' => 'required',
        ]);
      
        $inputs = $request->all();
        $image = $request->feature_photo;
        $imageName = time().rand(1,99).'.'.$image->extension();
        $inputs['feature_image'] = $imageName;
        $inputs['category'] = RENT;
        $inputs['created_by'] = auth()->user()->id;
        try{            
            $property = PropertyRent::create($inputs);
            $image->storeAs('feature_images', $imageName);
            $images = [];
            $documents = [];
            if ($request->other_photo){
                foreach($request->other_photo as $key => $image)
                {   
                    $imageName = time().rand(1,99).'.'.$image->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    $image->storeAs('property_images', $imageName);
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
                    $document->storeAs('property_images', $documentName);
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
        $divisions = get_all_divisions();
        $tenures = get_all_tenures();
        $propertytypes = get_all_propertytypes();
        $floors = get_all_floors();
        $setup = [];          
        $setup['divisions'] = $divisions; 
        $setup['tenures'] = $tenures; 
        $setup['propertytypes'] = $propertytypes; 
        $setup['floors'] = $floors;

        $property = PropertyRent::find($id);
        $images = PropertyRentImage::where('property_rent_id',$id)->get();        
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        return view('property_rents.edit',compact('response','setup'));
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'owner'=>'required',
            'phonenumber'=>'required',
            'title'=>'required',
            'title_mm'=>'required',
            'category'=>'required',
            'status'=>'required',
            'price'=>'required',
            'description'=>'required',
            'description_mm'=>'required',
            'property_location'=>'required',
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
            'view_count' => 'required',
            'remark' => 'required',
            'feature_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'other_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'confidential_documents' => 'required|image|max:1024',
            'rent_out_date' => 'required',
            'available_date'=>'required',
        ]);
      
        $inputs = $request->all();
        $image = $request->feature_photo;
        $imageName = time().rand(1,99).'.'.$image->extension();
        $inputs['feature_image'] = $imageName;
        $inputs['created_by'] = Auth::user()->id;
        try{            
            $property = PropertyRent::create($inputs);
            $image->storeAs('feature_images', $imageName);
            $images = [];
            $documents = [];
            if ($request->other_photo){
                foreach($request->other_photo as $key => $image)
                {   
                    $imageName = time().rand(1,99).'.'.$image->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    $image->storeAs('property_images', $imageName);
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
                    $document->storeAs('property_images', $documentName);
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
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        $response['document'] = $documents;

        return view('properties.detail',compact('response', 'setup'));
    }
    
}
