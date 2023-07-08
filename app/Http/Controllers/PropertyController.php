<?php

namespace App\Http\Controllers;
use App\Models\TblProperty;
use App\Models\TblPropertyImage;
use App\Models\TblPropertyDocument;
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
            'Property Location',
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
        if(session()->get(PROPERTY_CATEGORYFILTER)){
            $data = $data->where('tbl_properties.category',trim(session()->get(PROPERTY_CATEGORYFILTER)));
        }
        if(session()->get(PROPERTY_LOCATIONFILTER)){
            $data = $data->where('tbl_properties.location',trim(session()->get(PROPERTY_LOCATIONFILTER)));
        }
        if(session()->get(PROPERTY_BUILDYEARFILTER)){
            $data = $data->where('tbl_properties.builtyear',trim(session()->get(PROPERTY_BUILDYEARFILTER)));
        }
        if(session()->get(PROPERTY_MINPRICEFILTER)){
            $data = $data->where('tbl_properties.price','>=',trim(session()->get(PROPERTY_MINPRICEFILTER)));
        }
        if(session()->get(PROPERTY_MAXPRICEFILTER)){
            $data = $data->where('tbl_properties.price','<=',trim(session()->get(PROPERTY_MAXPRICEFILTER)));
        }
        $data = $data->orderBy('id','DESC')->paginate(10);
        if($data){
            foreach($data as $row){
                $list = array();
                $list['id'] = $row->id;
                $list['title'] = $row->title;
                $list['category'] = $row->category;
                $list['name'] = $row->name;
                $list['property_location'] = $row->property_location;
                $list['build_year'] = $row->build_year;
                $list['price'] = $row->price;
                $list['actions'] = $row->id;
                $properties[] = $list;
            }
        $response['data'] = $data;
        $response['properties'] = $properties;
        $response['headers'] = $headers;

        return view('properties.index',compact('response'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function create(){
        $divisions = Division::select('id', 'division')->get();
        $division_arr = [];
        foreach ($divisions as $division) {
            $division_arr[$division->id] = $division->division;
        }
        
        return view('properties.create', compact('division_arr'));
    }

    public function store(Request $request){
        return $request;
        // $image = $request->feature_photo;
        // return $image->extension();
        $this->validate($request, [
            'owner'=>'required',
            'phonenumber'=>'required',
            'title'=>'required',
            'title_mm'=>'required',
            'category'=>'required',
            'status'=>'required',
            'price'=>'required',
            'promotion_price'=>'required',
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
        ]);
      
        $inputs = $request->all();
        $image = $request->feature_photo;
        $imageName = time().rand(1,99).'.'.$image->extension();
        $inputs['feature_image'] = $imageName;
        $inputs['created_by'] = Auth::user()->id;
        try{            
            $property = TblProperty::create($inputs);
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
                $image['property_id'] = $property->id;  
                // return $image;              
                TblPropertyImage::create($image);
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
        $property = TblProperty::find($id);
        $images = TblPropertyImage::where('property_id',$id)->get();        
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        return view('properties.edit',compact('response'));
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
            'promotion_price'=>'required',
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
        ]);
        $inputs = $request->all();
        $inputs['updated_by'] = Auth::user()->id;
        $property = TblProperty::find($id);
        try{
            $property->update($inputs);
            if ($request->images){
                foreach($request->images as $key => $image)
                {   
                    $imageName = time().rand(1,99).'.'.$image->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    // $image->storeAs('property_images', $imageName);
                    $image->move(public_path('property_images'), $imageName);   
                    // $images[]['image'] = $imageName;
                    $img_input['image'] = $imageName;
                    $img_input['property_id'] = $id;
                    TblPropertyImage::create($img_input);
                }
            }
        }catch(Exception $e){
            Log::error('Error update property');
            Log::error($e->getMessage());
        }
        return redirect()->route('properties.index');
    }

    public function show($id){
        // $property_arr = array();
        // $property = TblProperty::select(
        //     'title',
        //     'category',
        //     'protype',
        //     'price',
        //     'squarefeet',
        //     'story',
        //     'bedroom',
        //     'bathroom',
        //     'feature',
        //     'outinspace',
        //     'amenities',
        //     'availabledate',
        //     'accessories',
        //     'decoration',
        //     'proname',
        //     'area',
        //     'condition',
        //     'developer',
        //     'tenure',
        //     'builtyear',            
        //     'location',            
        //     'postalcode',
        //     'address',            
        //     'description',
        // )->find($id)->toArray();
        // if($property){
        //     foreach($property as $key=>$value){
        //         switch($key){
        //             case 'protype' :
        //                 $key = 'Property Type';
        //             break;
        //             case 'squarefeet' :
        //                 $key = 'Square Feet';
        //             break;
        //             case 'bedroom' :
        //                 $key = 'bed room';
        //             break;
        //             case 'bathroom' :
        //                 $key = 'bath room';
        //             break;
        //             case 'outinspace' :
        //                 $key = 'Outside/Inside space';
        //             break;
        //             case 'availabledate' :
        //                 $key = 'available date';
        //             break;
        //             case 'proname' :
        //                 $key = 'Property name';
        //             break;
        //             case 'builtyear' :
        //                 $key = 'built year';
        //             break;
        //             case 'postalcode' :
        //                 $key = 'postal code';
        //             break;
        //             default :
        //                 $key = $key;
        //             break;
        //         }
        //         $property_arr[ucwords($key)] = $value;
        //     }
        // }
        // $images = TblPropertyImage::where('property_id',$id)->get();
        // $response = array();
        // $response['property'] = $property_arr;
        // $response['images'] = $images;
        // return view('properties.detail',compact('response'));
    }

    public function destory_img(Request $request){
        try{
            TblPropertyImage::find($request->id)->delete();
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
