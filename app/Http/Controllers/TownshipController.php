<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Township;

class TownshipController extends Controller
{
    public function index(){
        $townships = [];
        $response =[];
        $headers = ['Township','Action'];
        $data = Township::orderBy('created_at','DESC')->paginate(10);
        if($data){
            foreach($data as $row){
                $list = [];
                $list['township'] = $row->township;
                $list['action'] = $row->id;
                $townships[] = $list;
            }
        }
        $response['data'] = $data;
        $response['townships'] = $townships;
        $response['headers'] = $headers;
        return view('townships.index',compact('response'));
    }

    public function create(){
        $divisions = get_all_divisions();
        return view('townships.create',compact('divisions'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'township'=>'required|unique:townships,township'                    
        ]);
        
        $input = $request->all();
        $input['create_by'] = auth()->user()->id;

        Township::create($input);

        return redirect()->route('townships.index');
    }

    public function edit($id){
        $divisions = get_all_divisions();
        $township = Township::find($id);
        return view('townships.edit',compact('township','divisions'));
    }

    public function update(Request $request, $id){
         $this->validate($request, [
            'township'=>'required|unique:townships,township,'.$id                    
        ]);

        $township = Township::find($id);
        
        $input = $request->all();
        $input['updated_by'] = auth()->user()->id;

        if($township){
            $township->update($input);
        }
        return redirect()->route('townships.index');
    }

    public function townshipbydivision(Request $request) {
        $townships = Township::select('id', 'township')->where('division_id', $request->division_id)->get();
        return $townships;
    }
}
