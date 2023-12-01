<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Floor;

class FloorController extends Controller
{
    public function index(){
        $floors = [];
        $response = [];
        $headers = ['Floor', 'Floor(mm)','Actions'];
        
        $data = Floor::orderBy('id','DESC');
        if(session()->get(FLOOR_NAMEFILTER)){
            $data = $data->where(function($query){
                $query->orWhere('floor','like','%'.session()->get(FLOOR_NAMEFILTER).'%')
                ->orWhere('floor_mm','like','%'.session()->get(FLOOR_NAMEFILTER).'%');
            });
        }
        $data = $data->paginate(config('number.paginate'));
        if($data){
            foreach($data as $row){
                $list['floor'] = $row->floor;
                $list['floor_mm'] = $row->floor_mm;
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
            'floor'=>'required|unique:floors,floor',                 
            'floor_mm'=>'required|unique:floors,floor_mm'                 
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
            'floor'=>'required|unique:floors,floor,'.$id,
            'floor_mm'=>'required|unique:floors,floor_mm,'.$id
        ]);

        $floor = Floor::find($id);
        
        $input = $request->all();
        $input['updated_by'] = auth()->user()->id;

        if($floor){
            $floor->update($input);
        }
        return redirect()->route('floors.index');
    } 
    
    public function search(Request $request){
        session()->start();
        session()->put(FLOOR_NAMEFILTER, trim($request->floor));

        return redirect()->route('floors.index');
    }

    public function reset(){
        session()->forget([
            FLOOR_NAMEFILTER,
        ]);
        return redirect()->route('floors.index');
    }
}
