<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblTempImgs;
use Illuminate\Support\Facades\Log;

class TempController extends Controller
{
    public function add(Request $request){
        $input = $request->all();
        try{
            TblTempImgs::create($input);
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
        return 'success';
    }

    public function destory(Request $request){
        TblTempImgs::where('key',$request->id)->delete();
        
        return 'success';

    }
}
