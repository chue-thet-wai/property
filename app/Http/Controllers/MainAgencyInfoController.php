<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainAgencyInformation;


class MainAgencyInfoController extends Controller
{
    public function index()
    {
        $response = [];
        $info_arr = [];
        $headers = [
            'name',
            'logo',
            'contact',
            'email',
            'action',
        ];
        $informations = MainAgencyInformation::where('is_delete',0);
        if(session()->get(AGENCYINFO_NAMEFILTER)){
            $informations = $informations->where('name','like','%'.session()->get(AGENCYINFO_NAMEFILTER).'%');
        }
        if(session()->get(AGENCYINFO_PHONEFILTER)){
            $informations = $informations->where('contact',session()->get(AGENCYINFO_PHONEFILTER));
        }
        $informations = $informations->get();
        if($informations){
            foreach($informations as $info){
                $list = [];
                $list['name'] = $info->name;
                $list['logo'] = $info->logo;
                $list['contact'] = $info->contact;
                $list['email'] = $info->email;
                $list['actions'] = $info->id;
                $info_arr[] = $list;
            }
        }
        $response['headers'] = $headers;
        $response['informations'] = $info_arr;
        return view('informations.index',compact('response'));
    }

    public function create(Request $request)
    {
        return view('informations.create');        
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['created_by'] = auth()->user()->id;

        if ($request->hasFile('logo')) {
            $logo = $request->logo;            
            $imageName = time().rand(1,99).'.'.$logo->extension();            
            $inputs['logo'] = $imageName;
            $logo->storeAs('public/information_logos', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/information-logos/');
            
            $thumbnailImage = Image::make($logo)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }
        if ($request->hasFile('watermark_img')) {
            $watermark_img = $request->watermark_img;            
            $imageName = time().rand(1,99).'.'.$watermark_img->extension();            
            $inputs['watermark_img'] = $imageName;
            $watermark_img->storeAs('public/information_watermark_imgs', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/information-watermark-imgs/');
            
            $thumbnailImage = Image::make($watermark_img)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }
        if ($request->hasFile('default_img')) {
            $default_img = $request->default_img;            
            $imageName = time().rand(1,99).'.'.$default_img->extension();            
            $inputs['default_img'] = $imageName;
            $default_img->storeAs('public/information_default_imgs', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/information-default-imgs/');
            
            $thumbnailImage = Image::make($default_img)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }

        if ($request->hasFile('home_img')) {
            $home_img = $request->home_img;            
            $imageName = time().rand(1,99).'.'.$home_img->extension();            
            $inputs['home_img'] = $imageName;
            $home_img->storeAs('public/information_home_imgs', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/information-home-imgs/');
            
            $thumbnailImage = Image::make($home_img)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }

        MainAgencyInformation::create($inputs);

        return redirect()->route('informations.index')->with('Information is created successfully.');
    }
    public function edit($id)
    {
        $information = MainAgencyInformation::find($id);
        
        return view('informations.edit',compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = MainAgencyInformation::find($id);
        $inputs = [];
        $inputs = $request->all();

        $inputs['updated_by'] = auth()->user()->id;
        
        if ($request->hasFile('logo')) {
            Storage::delete('public/' . $information->logo);
            $logo = $request->logo;            
            $imageName = time().rand(1,99).'.'.$logo->extension();            
            $inputs['logo'] = $imageName;
            $logo->storeAs('public/information_logos', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/information-logos/');
            
            $thumbnailImage = Image::make($logo)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }

        if ($request->hasFile('watermark_img')) {
            Storage::delete('public/' . $information->watermark_img);
            $watermark_img = $request->watermark_img;            
            $imageName = time().rand(1,99).'.'.$watermark_img->extension();            
            $inputs['watermark_img'] = $imageName;
            $watermark_img->storeAs('public/information_watermark_imgs', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/information-watermark-imgs/');
            
            $thumbnailImage = Image::make($watermark_img)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }

        if ($request->hasFile('default_img')) {
            Storage::delete('public/' . $information->default_img);
            $default_img = $request->default_img;            
            $imageName = time().rand(1,99).'.'.$default_img->extension();            
            $inputs['default_img'] = $imageName;
            $default_img->storeAs('public/information_default_imgs', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/information-default-imgs/');
            
            $thumbnailImage = Image::make($default_img)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }

        if ($request->hasFile('home_img')) {
            Storage::delete('public/' . $information->home_img);
            $home_img = $request->home_img;            
            $imageName = time().rand(1,99).'.'.$home_img->extension();            
            $inputs['home_img'] = $imageName;
            $home_img->storeAs('public/information_home_imgs', $imageName);
            // create thumbnail path
            $thumbnailPath = public_path('/thumbnails/information-home-imgs/');
            
            $thumbnailImage = Image::make($home_img)->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbnailImage->save($thumbnailPath . DIRECTORY_SEPARATOR . $imageName);
        }
        
        $information->update($inputs);

        return redirect()->route('informations.index')->with('success','Information is updated successfully');
    }
    public function softdelete(Request $request)
    {
        $information = MainAgencyInformation::find($request->id);
        $inputs['is_delete'] = 1;
        $inputs['updated_by'] = auth()->user()->id;
        $information->update($inputs);
        return redirect()->back();
    }

    public function search(Request $request){
        session()->start();
        session()->put(AGENCYINFO_NAMEFILTER, trim($request->name));
        session()->put(AGENCYINFO_PHONEFILTER, trim($request->phonenumber));
        return redirect()->route('informations.index');
    }

    public function reset(){
        session()->forget([
            AGENCYINFO_NAMEFILTER,
            AGENCYINFO_PHONEFILTER,
        ]);
        return redirect()->route('informations.index');
    }

    public function show($id){
        $information = MainAgencyInformation::find($id);
        return view('informations.details',compact('information'));
    }
}
