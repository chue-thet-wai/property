<?php

namespace App\Http\Controllers;
use App\Models\TblProperty;
use Illuminate\Http\Request;
use Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $response = array();        
        $properties = array();
        $headers = array(
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
            'actions',
        );
        $data = TblProperty::select(
        'id',
        'title',
        'category',
        'protype',
        'location',
        'address',
        'price',
        'squarefeet',
        'story',
        'bedroom',
        'bathroom')->orderBy('id','DESC')->paginate(10);
        if($data){
            foreach($data as $row){
                $list = array();
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
            'feature' =>'required'
        ]);
        $inputs = $request->all();
        $inputs['created_by'] = Auth::user()->id;
        try{            
            TblProperty::create($inputs);
        }catch(Exception $e){
            Log::error('Error save property');
            Log::error($e->getMessage());
        }
        return redirect()->route('properties.index');
    }

    public function edit($id){
        $property = TblProperty::find($id);
        return view('properties.edit',compact('property'));
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
            'feature' =>'required'
        ]);
        $inputs = $request->all();
        $inputs['updated_by'] = Auth::user()->id;
        $property = TblProperty::find($id);
        try{
            $property->update($inputs);
        }catch(Exception $e){
            Log::error('Error update property');
            Log::error($e->getMessage());
        }
        return redirect()->route('properties.index');
    }

    public function show($id){
        $property = TblProperty::find($id)->toArray();
        return view('properties.detail',compact('property'));
    }
}
