<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Floor;

class FloorController extends Controller
{
    public function index(){
        $floors = [];
        $response = [];
        $headers = ['Floor','Actions'];
        
        $data = Floor::orderBy('id','DESC');
        if($data){
            foreach($data as $row){
                $list['floor'] = $row->floor;
                $list['action'] = $row->id;
                $floors[] = $list;
            }
        }
        $response['data'] = $data;
        $response['floors'] = $floors;
        $response['headers'] = $headers;
        return view('floors.index',compact('response'));
    }

    public function create(){
        return view('floors.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'floor'=>'required|unique:floors,floor'                    
        ]);
        
        $input = $request->all();
        $input['create_by'] = auth()->user()->id;

        Floor::create($input);

        return redirect()->route('floors.index');
    }

    public function edit($id){
        $floor = Floor::find($id);
        return view('floors.edit',compact('floor'));
    }  

    public function update(Request $request,$id){
        $this->validate($request, [
            'floor'=>'required|unique:floors,floor,'.$id                    
        ]);

        $floor = Floor::find($id);
        
        $input = $request->all();
        $input['updated_by'] = auth()->user()->id;

        if($floor){
            $floor->update($input);
        }
        return redirect()->route('floors.index');
    }   
}
