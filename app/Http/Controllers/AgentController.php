<?php

namespace App\Http\Controllers;

use App\Models\TblAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TblAgent::orderBy('id','DESC')->get();
        return view('agents.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'phone_no' => 'required|unique:users,phone_no',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $agent = new TblAgent([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'website' => $request->website,
            'phone_no' => $request->phone_no,
            'remark' => $request->remark,
            'address' => $request->address,
        ]);

        if ($request->hasFile('profile_photo')) {
            $profile_photo = $request->profile_photo;
            $imagePath = $profile_photo->store('agent-photos','public');
            $agent->profile_photo = $imagePath;
        }

        if ($request->hasFile('document')) {
            $document = $request->document;
            $filePath = $document->store('agent-documents','public');
            $agent->document = $filePath;
        }

        $agent->save();

        return redirect()->route('agents.index')
                ->with('success','Agent created successfully');        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TblAgent  $tblAgent
     * @return \Illuminate\Http\Response
     */
    public function show(TblAgent $tblAgent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TblAgent  $tblAgent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = TblAgent::find($id);
        return view('agents.edit',compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TblAgent  $tblAgent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'phone_no' => 'required|unique:users,phone_no',$id,
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $agent = TblAgent::find($id);
        $agent->first_name =  $request->first_name;
        $agent->last_name =  $request->last_name;
        $agent->company_name =  $request->company_name;
        $agent->email =  $request->email;
        $agent->website =  $request->website;
        $agent->phone_no =  $request->phone_no;
        $agent->remark =  $request->remark;
        $agent->address =  $request->address;

      

        if ($request->hasFile('profile_photo')) {
            Storage::delete('public/' . $agent->profile_photo);
            $profile_photo = $request->profile_photo;
            $imagePath = $profile_photo->store('agent-photos','public');
            $agent->profile_photo = $imagePath;
        }

        if ($request->hasFile('document')) {
            Storage::delete('public/' . $agent->document);
            $document = $request->document;
            $filePath = $document->store('agent-documents','public');
            $agent->document = $filePath;
        }

        $agent->save();

        return redirect()->route('agents.index')
                ->with('success','Agent updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TblAgent  $tblAgent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TblAgent::find($id)->delete();
        return redirect()->route('agents.index')
                        ->with('success','Agent deleted successfully');
    }
}
