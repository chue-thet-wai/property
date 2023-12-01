<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ward;

class WardController extends Controller
{
    public function index(){
        $wards = [];
        $response =[];
        $headers = ['Division','Township', 'Ward', 'Ward(mm)','Action'];
        $data = Ward::join('townships','townships.id','=','wards.township_id')
        ->join('divisions','divisions.id','=','townships.division_id');
        
        if(session()->get(WARD_TOWNSHIPFILTER)){
            $data = $data->where('township_id',session()->get(WARD_TOWNSHIPFILTER));
        }
        if(session()->get(WARD_DIVISIONFILTER)){
            $data = $data->where('division_id',session()->get(WARD_DIVISIONFILTER));
        }
        if(session()->get(WARD_NAMEFILTER)){
            $data = $data->where(function($query){
                $query->orWhere('ward','like','%'.session()->get(WARD_NAMEFILTER).'%')
                ->orWhere('ward_mm','like','%'.session()->get(WARD_NAMEFILTER).'%');
            });
        }
        $data = $data->orderBy('wards.created_at','DESC')->paginate(config('number.paginate'));
        $township_arr = get_all_townships();
        $division_arr = get_all_divisions();
        if($data){
            foreach($data as $row){
                $list = [];
                $list['division'] = $row->division;
                $list['township'] = $row->township;
                $list['ward'] = $row->ward;
                $list['ward_mm'] = $row->ward_mm;
                $list['action'] = $row->id;
                $wards[] = $list;
            }
        }
        $response['data'] = $data;
        $response['townships'] = $township_arr;
        $response['divisions'] = $division_arr;
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
            'ward'=>'required|unique:wards,ward',
            'ward_mm'=>'required|unique:wards,ward_mm',
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
            'ward_mm'=>'required|unique:wards,ward_mm,'.$id,
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

    public function wardbytownship(Request $request) {
        $wards = Ward::select('id', 'ward')->where('township_id', $request->township_id)->get();
        return $wards;
    }
    public function search(Request $request){
        session()->start();
        session()->put(WARD_DIVISIONFILTER, trim($request->division_id));
        session()->put(WARD_TOWNSHIPFILTER, trim($request->township_id));
        session()->put(WARD_NAMEFILTER, trim($request->ward));

        return redirect()->route('wards.index');
    }

    public function reset(){
        session()->forget([
            WARD_DIVISIONFILTER,
            WARD_TOWNSHIPFILTER,
            WARD_NAMEFILTER
        ]);
        return redirect()->route('wards.index');
    }
}
