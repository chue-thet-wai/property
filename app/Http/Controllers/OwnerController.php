<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblOwner;
use App\Models\TblProperty;
use Illuminate\Support\Facades\Log;
use Auth;

class OwnerController extends Controller
{
    public function index(Request $request){
        $response = array();        
        $owners = array();
        $headers = array(
            'id',
            'name',
            'lastname',
            'companyname',
            'phonenumber',
            'secondcontact',
            'email',
            'actions',
        );
        $data = TblOwner::select(
            'id',
            'name',
            'lastname',
            'companyname',
            'phonenumber',
            'secondcontact',
            'email',
            'id'
        );
        if(session()->get(OWNER_PHONEFILTER)){
            $data = $data->where('tbl_owners.phonenumber',session()->get(OWNER_PHONEFILTER));
        }
        if(session()->get(OWNER_NAMEFILTER)){
            $data = $data->where('tbl_owners.name','like','%'.session()->get(OWNER_NAMEFILTER).'%');
        }
        $data = $data->where('is_delete',0)->orderBy('id','DESC')->get();
        if($data){
            foreach($data as $row){
                $list = array();
                $list['id'] = $row->id;
                $list['name'] = $row->name;
                $list['lastname'] = $row->lastname;
                $list['companynmae'] = $row->companyname;
                $list['phonenumber'] = $row->phonenumber;
                $list['secondcontact'] = $row->secondcontact;
                $list['email'] = $row->email;
                $list['actions'] = $row->id;
                $owners[] = $list;
            }
        $response['data'] = $data;
        $response['owners'] = $owners;
        $response['headers'] = $headers;

        return view('owners.index',compact('response'));
        }
    }
    public function create(){
        return view('owners.create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'phonenumber'=>'required',           
        ]);
        $inputs = $request->all();
        $inputs['created_by'] = Auth::user()->id;
        try{
            $owner = TblOwner::create($inputs);
            Log::error('Contact '. $owner->id . ' created success');
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
        return redirect()->route('owners.index')->with('success','Contact created successfully!');
    }
    public function edit($id){
        $response = array();
        $owner = TblOwner::find($id);
        return view('owners.edit',compact('owner'));
    }
    public function update(Request $request, $id){
        $this->validate($request, [
            'name'=>'required',
            'phonenumber'=>'required',           
        ]);
        $inputs = $request->all();        
        $inputs['updated_by'] = Auth::user()->id;
        $owner = TblOwner::find($id);
        if($owner){
            try{
                $owner->update($inputs);
                Log::error('owner '. $id .' updated success');
            }catch(Exception $e){
                Log::error($e->getMessage());
            }
        }      
        return redirect()->route('owners.index')->with('success','Contact is updated successfully!');
    }
    public function destroy($id){
        TblOwner::find($id)->delete();
        return redirect()->route('owners.index')
                        ->with('success','Owner '.$id.' deleted successfully');
    }

    public function show($id){
        $owner_arr = array();
        $properties = array();
        $response = array();
        $owner = TblOwner::select(
            'name',
            'lastname',
            'companyname',
            'phonenumber',
            'secondcontact',
            'email',
            'address',
            'remark')->find($id)->toArray();

        if($owner){
            foreach($owner as $key=>$value){
                if($key == 'phonenumber'){
                    $key = 'Contact';
                }
                $owner_arr[ucwords($key)] = $value;
            }
        }
        $headers = array(
            'id',
            'Title',
            'category',
            'Property Type',
            'location',
            'address',
            'price',
            'square feet',
            'story',
            'bedroom',
            'bathroom'
        );
        $data = TblProperty::select(
            'id',
            'title',
            'category',
            'protype',
            'location',
            'address',
            'price',
            'squarefeet',
            'story',
            'bedroom',
            'bathroom')
            ->where('owner_id',$id)->orderBy('id','DESC');
            if($data){
                foreach($data as $row){
                    $list = array();
                    $list['id'] = $row->id;
                    $list['title'] = $row->title;
                    $list['category'] = $row->category;
                    $list['protype'] = $row->protype;
                    $list['location'] = $row->location;
                    $list['address'] = $row->address;
                    $list['price'] = $row->price;
                    $list['squarefeet'] = $row->squarefeet;
                    $list['story'] = $row->story;
                    $list['bedroom'] = $row->bedroom;
                    $list['bathroom'] = $row->bathroom;    
                    $properties[] = $list;
                }  
            }     
        $response['owner'] = $owner_arr;
        $response['properties'] = $properties;
        $response['headers'] = $headers;
        return view('owners.details',compact('response'));
    }

    public function get_owners(){
        $owner_arr = array();
        $owners = TblOwner::get();
        if($owners){
            foreach($owners as $row){ 
                $owner_arr[$row->id] = $row->name . '(' .$row->phonenumber . ')';            
            }
        }
        return $owner_arr;
    }

    public function get_owners_with_phone(){
        $owner_phone_arr = array();
        $owner_phones = TblOwner::get();
        if($owner_phones){
            foreach($owner_phones as $row){ 
                $owner_phone_arr[$row->id] = $row->phonenumber. '(' .$row->name . ')';            
            }
        }
        return $owner_phone_arr;
    }

    public function get_owner_details($owner){
        // return $owner;
        // $owner_arr = explode('(',$owner);
        // $name = $owner_arr[0];
        // // return $owner_arr;
        // $phonenumber_arr = explode(')',$owner_arr[1]);
        // $phonenumber = $phonenumber_arr[0];
        $owner = TblOwner::where('name',trim($owner))
        ->where('is_delete',0)
        ->first();
        return $owner;
    }

    public function get_owner_details_with_phone($phonenumber){
        $owner = TblOwner::where('phonenumber',$phonenumber)->where('is_delete',0)->first();
        return $owner;
    }

    public function search(Request $request){
        session()->start();
        session()->put(OWNER_NAMEFILTER, trim($request->name));
        session()->put(OWNER_PHONEFILTER, trim($request->phonenumber));
        return redirect()->route('owners.index');
    }

    public function reset(){
        session()->forget([
            OWNER_NAMEFILTER,
            OWNER_PHONEFILTER,
        ]);
        return redirect()->route('owners.index');
    }

    public function softdelete(Request $request){
        $owner = TblOwner::find($request->id);    
        if (!$owner) {
            abort(404);
        }        
        $owner->is_delete = 1;
        $owner->updated_by = auth()->user()->id;
        $owner->save();
        return 'success';
    }
}
