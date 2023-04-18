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

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      
        $images = [];
        return $request->images;
        if ($request->images){
            foreach($request->images as $key => $image)
            {
                // return $image->extension();
                $imageName = time().rand(1,99).'.'.$image->extension(); 
                // return $imageName;
 
                $image->move(public_path('property_images'), $imageName);
  
                $images[]['name'] = $imageName;
            }
        }
  
        foreach ($images as $key => $image) {
            Image::create($image);
        }
      
        return back()
                ->with('success','You have successfully upload image.')
                ->with('images', $images); 
    }

    
    public function edit($id){
        return view('banners.edit');
    }

    public function update(Request $request,$id){
        return 'update';
    }
}
