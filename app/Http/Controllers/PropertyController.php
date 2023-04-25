<?php

namespace App\Http\Controllers;
use App\Models\TblProperty;
use App\Models\TblPropertyImage;
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
            'Property Type',
            'location',
            'address',
            'price',
            'square feet',
            'story',
            'bedroom',
            'bathroom',
            'Owner',
            'actions',
        );
        $data = TblProperty::select(
        'tbl_properties.id',
        'title',
        'category',
        'protype',
        'location',
        'tbl_properties.address',
        'price',
        'squarefeet',
        'story',
        'bedroom',
        'bathroom',
        'name')->join('tbl_owners','tbl_owners.id','=','tbl_properties.owner_id');
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
                $list['protype'] = $row->protype;
                $list['location'] = $row->location;
                $list['address'] = $row->address;
                $list['price'] = $row->price;
                $list['squarefeet'] = $row->squarefeet;
                $list['story'] = $row->story;
                $list['bedroom'] = $row->bedroom;
                $list['bathroom'] = $row->bathroom;
                $list['name'] = $row->name;
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
        return view('properties.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title'=>'required',
            'category'=>'required',
            'protype'=>'required',
            'location'=>'required',
            'price'=>'required',
            'squarefeet'=>'required',
            'address'=>'required',
            'postalcode'=>'required',
            'story'=>'required',
            'bedroom'=>'required',
            'bathroom'=>'required',
            'outinspace'=>'required',
            'amenities'=>'required',
            'availabledate'=>'required',
            'proname'=>'required',
            'area'=>'required',
            'condition'=>'required',
            'developer'=>'required',
            'tenure'=>'required',
            'builtyear'=>'required',
            'feature' =>'required',
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'owner_id' => 'required',
        ]);
      
        $inputs = $request->all();
        $inputs['created_by'] = Auth::user()->id;
        try{            
            $property = TblProperty::create($inputs);
            $images = [];
            if ($request->images){
                foreach($request->images as $key => $image)
                {   
                    $imageName = time().rand(1,99).'.'.$image->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    // $image->storeAs('property_images', $imageName);
                    $image->move(public_path('property_images'), $imageName);   
                    $images[]['image'] = $imageName;
                }
            } 
            foreach ($images as $key => $image) {
                $image['property_id'] = $property->id;  
                // return $image;              
                TblPropertyImage::create($image);
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
            'title'=>'required',
            'category'=>'required',
            'protype'=>'required',
            'location'=>'required',
            'price'=>'required',
            'squarefeet'=>'required',
            'address'=>'required',
            'postalcode'=>'required',
            'story'=>'required',
            'bedroom'=>'required',
            'bathroom'=>'required',
            'outinspace'=>'required',
            'amenities'=>'required',
            'availabledate'=>'required',
            'proname'=>'required',
            'area'=>'required',
            'condition'=>'required',
            'developer'=>'required',
            'tenure'=>'required',
            'builtyear'=>'required',
            'feature' =>'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
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
        $property_arr = array();
        $property = TblProperty::select(
            'title',
            'category',
            'protype',
            'price',
            'squarefeet',
            'story',
            'bedroom',
            'bathroom',
            'feature',
            'outinspace',
            'amenities',
            'availabledate',
            'accessories',
            'decoration',
            'proname',
            'area',
            'condition',
            'developer',
            'tenure',
            'builtyear',            
            'location',            
            'postalcode',
            'address',            
            'description',
        )->find($id)->toArray();
        if($property){
            foreach($property as $key=>$value){
                switch($key){
                    case 'protype' :
                        $key = 'Property Type';
                    break;
                    case 'squarefeet' :
                        $key = 'Square Feet';
                    break;
                    case 'bedroom' :
                        $key = 'bed room';
                    break;
                    case 'bathroom' :
                        $key = 'bath room';
                    break;
                    case 'outinspace' :
                        $key = 'Outside/Inside space';
                    break;
                    case 'availabledate' :
                        $key = 'available date';
                    break;
                    case 'proname' :
                        $key = 'Property name';
                    break;
                    case 'builtyear' :
                        $key = 'built year';
                    break;
                    case 'postalcode' :
                        $key = 'postal code';
                    break;
                    default :
                        $key = $key;
                    break;
                }
                $property_arr[ucwords($key)] = $value;
            }
        }
        $images = TblPropertyImage::where('property_id',$id)->get();
        $response = array();
        $response['property'] = $property_arr;
        $response['images'] = $images;
        return view('properties.detail',compact('response'));
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
