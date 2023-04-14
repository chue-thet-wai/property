<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends Controller
{    
    public function index(){
        return view('banners.index');
    }

    public function create(){
        return view('banners.create');
    }

    public function store(Request $request){
        return 'stroe';
    }
    
    public function edit($id){
        return view('banners.edit');
    }

    public function update(Request $request,$id){
        return 'update';
    }
}
