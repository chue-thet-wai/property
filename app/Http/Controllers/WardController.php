<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ward;

class WardController extends Controller
{
    public function index(){
        $wards = [];
        $response =[];
        $headers = ['Ward','Township','Action'];
        $data = Ward::orderBy('created_at','DESC')->paginate(10);
        $township_arr = get_all_townships();
        if($data){
            foreach($data as $row){
                $list = [];
                $list['ward'] = $row->ward;
                $list['township'] = $township_arr[$row->township_id];
                $list['action'] = $row->id;
                $wards[] = $list;
            }
        }
        $response['data'] = $data;
        $response['wards'] = $wards;
        $response['headers'] = $headers;
        return view('wards.index',compact('response'));
    }

    public function create(){
        $townships = get_all_townships();
        return view('wards.create',compact('townships'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'ward'=>'required|unique:wards,ward' ,
            'township_id' => 'required'                   
        ]);
        
        $input = $request->all();
        $input['create_by'] = auth()->user()->id;

        Ward::create($input);

        return redirect()->route('wards.index');
    }

    public function edit($id){
        $townships = get_all_townships();
        $ward = Ward::find($id);
        return view('wards.edit',compact('townships','ward'));
    }

    public function update(Request $request, $id){
         $this->validate($request, [
            'ward'=>'required|unique:wards,ward,'.$id,
            'township_id' => 'required'                 
        ]);

        $ward = Ward::find($id);
        
        $input = $request->all();
        $input['updated_by'] = auth()->user()->id;

        if($ward){
            $ward->update($input);
        }
        return redirect()->route('wards.index');
    }
}
