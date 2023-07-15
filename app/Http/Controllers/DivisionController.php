<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index(){
        $divisions = [];
        $response = [];
        $headers = ['Division', 'Division(mm)','Actions'];
        
        $data = Division::orderBy('id','DESC')->get();
        if($data){
            foreach($data as $row){
                $list['division'] = $row->division;
                $list['division_mm'] = $row->division_mm;
                $list['action'] = $row->id;
                $divisions[] = $list;
            }
        }
        $response['data'] = $data;
        $response['divisions'] = $divisions;
        $response['headers'] = $headers;
        return view('divisions.index',compact('response'));
    }

    public function create(){
        return view('divisions.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'division'=>'required|unique:divisions,division',               
            'division_mm'=>'required|unique:divisions,division_mm'                 
        ]);
        
        $input = $request->all();
        $input['create_by'] = auth()->user()->id;

        Division::create($input);

        return redirect()->route('divisions.index');
    }

    public function edit($id){
        $division = Division::find($id);
        return view('divisions.edit',compact('division'));
    }  

    public function update(Request $request,$id){
        $this->validate($request, [
            'division'=>'required|unique:divisions,division,'.$id,                   
            'division_mm'=>'required|unique:divisions,division_mm,'.$id,                   
        ]);

        $division = Division::find($id);
        
        $input = $request->all();
        $input['updated_by'] = auth()->user()->id;

        if($division){
            $division->update($input);
        }
        return redirect()->route('divisions.index');
    }

    public function show($id){
        $division = Division::with('township')->where('id',$id)->first();
        return view('divisions.show',compact('division'));
    }
}
