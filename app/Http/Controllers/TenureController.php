<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenure;

class TenureController extends Controller
{
    public function index(){
        $tenures = [];
        $response = [];
        $headers = ['Tenure','Actions'];
        
        $data = Tenure::orderBy('id','DESC')->get();
        if($data){
            foreach($data as $row){
                $list['tenure'] = $row->tenure;
                $list['action'] = $row->id;
                $tenures[] = $list;
            }
        }
        $response['data'] = $data;
        $response['tenures'] = $tenures;
        $response['headers'] = $headers;
        return view('tenures.index',compact('response'));
    }

    public function create(){
        return view('tenures.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'tenure'=>'required|unique:tenures,tenure'                    
        ]);
        
        $input = $request->all();
        $input['create_by'] = auth()->user()->id;

        Tenure::create($input);

        return redirect()->route('tenures.index');
    }

    public function edit($id){
        $tenure = Tenure::find($id);
        return view('tenures.edit',compact('tenure'));
    }  

    public function update(Request $request,$id){
        $this->validate($request, [
            'tenure'=>'required|unique:tenures,tenure,'.$id                    
        ]);

        $tenure = Tenure::find($id);
        
        $input = $request->all();
        $input['updated_by'] = auth()->user()->id;

        if($tenure){
            $tenure->update($input);
        }
        return redirect()->route('tenures.index');
    }

    public function show($id){
        $tenure = Tenure::find($id);
        return view('tenures.show',compact('tenure'));
    }
}
