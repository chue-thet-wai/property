<?php

namespace App\Http\Controllers;
use App\Models\TblProperty;
use App\Models\PropertyRent;
use App\Models\TblPropertyImage;
use App\Models\TblPropertyDocument;
use App\Models\PropertyFloor;
use App\Models\Division;
use App\Models\MainAgencyInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
 
use Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $response = array();        
        $properties = array();
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
            'Price',
            'Status',
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
                $list['price'] = $row->price;
                $list['status'] = $row->status;
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
            'front_area'=>'required',
            'side_area'=>'required',
            'square_feet'=>'required',
            'acre'=>'required',
            'tenure_property'=>'required',
            'property_type'=>'required',
            'floor' =>'required',
        ]);
      
        $inputs = $request->all();

        if(!isset($inputs['bank_loan'])){
            $inputs['bank_loan'] = 0;
        }
        if(!isset($inputs['public_status'])){
            $inputs['public_status'] = 0;
        }

        //get water mark
        $information = MainAgencyInformation::first();

        if($information){
            $text = $information->watermark_txt;
        }else{
            $text = '';
        }

        $image = $request->feature_photo;
        $imageName = time().rand(1,99).'.'.$image->extension();        
        $inputs['feature_photo'] = $imageName;
        $inputs['category'] = SALE;
        $inputs['created_by'] = Auth::user()->id;
        try{            
            $property = TblProperty::create($inputs);
            $floors = $request->floor;
            if($floors){
                PropertyFloor::where('property_id', $property->id)->delete();
                foreach($floors as $floor){
                    $floor_inputs = [];
                    $floor_inputs['property_id'] = $property->id;
                    $floor_inputs['floor_id'] = $floor;                
                    PropertyFloor::create($floor_inputs);
                }
            }
            // save original images
            $imgFile = Image::make($image->getRealPath());
            $imgFile->text($text, 120, 100, function($font) { 
                $font->size(35);  
                $font->color('#ffffff');  
                $font->align('center');  
                $font->valign('bottom');  
                $font->angle(90);  
            });

            Storage::disk('public')->put('feature_images/' . $imageName, $imgFile->stream());

            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/feature_images/');
            
            $thumbnailImage = Image::make($image)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->text($text, 120, 100, function($font) { 
                $font->size(35);  
                $font->color('#ffffff');  
                $font->align('center');  
                $font->valign('bottom');  
                $font->angle(90);  
            })->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
            
            $images = [];
            $documents = [];
            if ($request->other_photo){
                foreach($request->other_photo as $key => $image)
                {   
                    $imageName = time().rand(1,99).'.'.$image->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    // $image->storeAs('public/property_images', $imageName);
                    $imgFile = Image::make($image->getRealPath());
                    $imgFile->text($text, 120, 100, function($font) { 
                        $font->size(35);  
                        $font->color('#ffffff');  
                        $font->align('center');  
                        $font->valign('bottom');  
                        $font->angle(90);  
                    });

                    Storage::disk('public')->put('property_images/' . $imageName, $imgFile->stream());   
                    // thumbnails
                    $thumbnailPath = public_path('/thumbnails/property_images/');
            
                    $thumbnailImage = Image::make($image)->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $thumbnailImage->text($text, 120, 100, function($font) { 
                        $font->size(35);  
                        $font->color('#ffffff');  
                        $font->align('center');  
                        $font->valign('bottom');
                        $font->angle(90);  
                    })->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);

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
                    //original img
                    $document->storeAs('public/confidential_documents', $documentName);

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
        $townships = get_all_townships();
        $wards = get_all_wards();
        $property_floors = get_property_floor_id($id); 

        $setup = [];
        $setup['divisions'] = $divisions; 
        $setup['tenures'] = $tenures; 
        $setup['propertytypes'] = $propertytypes; 
        $setup['floors'] = $floors;
        $setup['townships'] = $townships;
        $setup['wards'] = $wards;

        $property = TblProperty::with('owner')->find($id);
        $images = TblPropertyImage::where('property_id',$id)->get();        
        $documents = TblPropertyDocument::where('property_id',$id)->get();
              
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        $response['document'] = $documents;
        $response['property_floors'] = $property_floors;

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
            'front_area'=>'required',
            'side_area'=>'required',
            'square_feet'=>'required',
            'acre'=>'required',
            'tenure_property'=>'required',
            'property_type'=>'required',
            'floor' =>'required',
        ]);

        $inputs = $request->all();
        
        if(!isset($inputs['bank_loan'])){
            $inputs['bank_loan'] = 0;
        }
        if(!isset($inputs['public_status'])){
            $inputs['public_status'] = 0;
        }

        //water mark
        $information = MainagencyInformation::first();
        if($information){
            $text = $information->watermark_txt;            
        }else{
            $text = '';
        }

        if($request->feature_photo) {
            $image = $request->feature_photo;
            $imageName = time().rand(1,99).'.'.$image->extension();
            $inputs['feature_photo'] = $imageName;

            $imgFile = Image::make($image->getRealPath());
            $imgFile->text($text, 120, 100, function($font) { 
                $font->size(35);  
                $font->color('#ffffff');  
                $font->align('center');  
                $font->valign('bottom');  
                $font->angle(90);  
            });

            Storage::disk('public')->put('feature_images/' . $imageName, $imgFile->stream());
            // $image->storeAs('public/feature_images', $imageName);

            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/feature_images/');
            
            $thumbnailImage = Image::make($image)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->text($text, 120, 100, function($font) { 
                $font->size(35);  
                $font->color('#ffffff');  
                $font->align('center');  
                $font->valign('bottom');  
                $font->angle(90);  
            })->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }

        $inputs['category'] = SALE;
        $inputs['updated_by'] = Auth::user()->id;
        $property = TblProperty::find($id);
        try{
            $property->update($inputs);
            $floors = $request->floor;
            if($floors){
                PropertyFloor::where('property_id', $property->id)->delete();
                foreach($floors as $floor){
                    $floor_inputs = [];
                    $floor_inputs['property_id'] = $property->id;
                    $floor_inputs['floor_id'] = $floor;                
                    PropertyFloor::create($floor_inputs);
                }
            }
            $images = [];
            $documents = [];
            if ($request->other_photo){
                foreach($request->other_photo as $key => $image)
                {   
                    $imageName = time().rand(1,99).'.'.$image->extension();
                    // $image->storeAs('property_images', $imageName, 's3');
                    // $image->storeAs('public/property_images', $imageName);
                    $imgFile = Image::make($image->getRealPath());
                    $imgFile->text($text, 120, 100, function($font) { 
                        $font->size(35);  
                        $font->color('#ffffff');  
                        $font->align('center');  
                        $font->valign('bottom');  
                        $font->angle(90);  
                    });

                    Storage::disk('public')->put('property_images/' . $imageName, $imgFile->stream());
                    // thumbnails
                    $thumbnailPath = public_path('/thumbnails/property_images/');
            
                    $thumbnailImage = Image::make($image)->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $thumbnailImage->text($text, 120, 100, function($font) { 
                        $font->size(35);  
                        $font->color('#ffffff');  
                        $font->align('center');  
                        $font->valign('bottom');  
                        $font->angle(90);  
                    })->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);

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
        $property_floor = PropertyFloor::where('property_id',$id)->get();        
        $response = array();
        $response['property'] = $property;
        $response['images'] = $images;
        $response['document'] = $documents;
        $response['property_floor'] = $property_floor;

        // return $property_floor;
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
            PROPERTY_BUILDYEARFILTER,
            PROPERTY_MINPRICEFILTER,
            PROPERTY_MAXPRICEFILTER,
        ]);
        return redirect()->route('properties.index');
    }

    public function softdelete(Request $request){
        $property = TblProperty::find($request->id);    
        if (!$property) {
            abort(404);
        }        
        $property->is_delete = 1;
        $property->updated_by = auth()->user()->id;
        $property->save();
        return redirect()->back(); 
    }

    public function get_property_detail(Request $request){
        if($request->type == RENT){
            $property = PropertyRent::find($request->property_id);
        }else{
            $property = TblProperty::find($request->property_id);
        }
        return $property;
    }
}

