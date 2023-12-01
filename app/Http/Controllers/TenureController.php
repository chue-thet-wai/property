<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenure;

class TenureController extends Controller
{
    public function index(){
        $tenures = [];
        $response = [];
        $headers = ['Tenure', 'Tenure(mm)','Actions'];
        
        $data = Tenure::orderBy('id','DESC');
        if(session()->get(TENURE_NAMEFILTER)){
            $data = $data->where(function($query){
                $query->orWhere('tenure','like','%'.session()->get(TENURE_NAMEFILTER).'%')
                ->orWhere('tenure_mm','like','%'.session()->get(TENURE_NAMEFILTER).'%');
            });
        }
        $data = $data->paginate(config('number.paginate'));
        if($data){
            foreach($data as $row){
                $list['tenure'] = $row->tenure;
                $list['tenure_mm'] = $row->tenure_mm;
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
            'tenure'=>'required|unique:tenures,tenure',                    
            'tenure_mm'=>'required|unique:tenures,tenure_mm'                    
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
            'tenure'=>'required|unique:tenures,tenure,'.$id,
            'tenure_mm'=>'required|unique:tenures,tenure_mm,'.$id
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
    public function search(Request $request){
        session()->start();
        session()->put(TENURE_NAMEFILTER, trim($request->tenure));

        return redirect()->route('tenures.index');
    }

    public function reset(){
        session()->forget([
            TENURE_NAMEFILTER,
        ]);
        return redirect()->route('tenures.index');
    }
}
