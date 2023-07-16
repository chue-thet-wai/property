<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;

class PropertyTypeController extends Controller
{
    public function index(){
        $property_types = [];
        $response = [];
        $headers = ['Property Type', 'Property_Type(mm)','Actions'];
        
        $data = PropertyType::orderBy('id','DESC');
        if(session()->get(PROPERTY_TYPE_NAMEFILTER)){
            $data = $data->where(function($query){
                $query->orWhere('property_type','like','%'.session()->get(PROPERTY_TYPE_NAMEFILTER).'%')
                ->orWhere('property_type_mm','like','%'.session()->get(PROPERTY_TYPE_NAMEFILTER).'%');
            });
        }
        $data = $data->get();
        if($data){
            foreach($data as $row){
                $list['property_type'] = $row->property_type;
                $list['property_type_mm'] = $row->property_type_mm;
                $list['action'] = $row->id;
                $property_types[] = $list;
            }
        }
        $response['data'] = $data;
        $response['property_types'] = $property_types;
        $response['headers'] = $headers;
        return view('property_types.index',compact('response'));
    }

    public function create(){
        return view('property_types.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'property_type'=>'required|unique:property_types,property_type',
            'property_type_mm'=>'required|unique:property_types,property_type_mm'
        ]);
        
        $input = $request->all();
        $input['create_by'] = auth()->user()->id;

        PropertyType::create($input);

        return redirect()->route('property_types.index');
    }

    public function edit($id){
        $property_type = PropertyType::find($id);
        return view('property_types.edit',compact('property_type'));
    }  

    public function update(Request $request,$id){
        $this->validate($request, [
            'property_type'=>'required|unique:property_types,property_type,'.$id,                   
            'property_type_mm'=>'required|unique:property_types,property_type_mm,'.$id,                   
        ]);

        $property_type = PropertyType::find($id);
        
        $input = $request->all();
        $input['updated_by'] = auth()->user()->id;

        if($property_type){
            $property_type->update($input);
        }
        return redirect()->route('property_types.index');
    }
    public function search(Request $request){
        session()->start();
        session()->put(PROPERTY_TYPE_NAMEFILTER, trim($request->property_type));

        return redirect()->route('property_types.index');
    }

    public function reset(){
        session()->forget([
            PROPERTY_TYPE_NAMEFILTER,
        ]);
        return redirect()->route('property_types.index');
    }
}
