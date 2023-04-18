<?php

namespace App\Http\Controllers;
use App\Models\TblCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;

class CustomerController extends Controller
{
    public function index(Request $request){
        $response = array();        
        $customers = array();
        $headers = array(
            'id',
            'name',
            'contact',
            'email',
            'address',
            'enquiry_type',
            'enquiry_property',
            'from_month',
            'to_month',
            'enquiry_amount',
            'actions',
        );
        $data = TblCustomer::select(
            'id',
            'name',
            'phonenumber',
            'email',
            'address',
            'enquiry_type',
            'enquiry_property',
            'from_month',
            'to_month',
            'enquiry_amount'
        )->orderBy('id','DESC')->paginate(10);
        if($data){
            foreach($data as $row){
                $list = array();
                $list['id'] = $row->id;
                $list['name'] = $row->name;
                $list['phonenumber'] = $row->phonenumber;
                $list['email'] = $row->email;
                $list['address'] = $row->address;
                $list['enquiry_type'] = $row->enquiry_type;
                $list['enquiry_property'] = $row->enquiry_property;
                $list['from_month'] = $row->from_month;
                $list['to_month'] = $row->to_month;
                $list['enquiry_amount'] = $row->enquiry_amount;
                $list['actions'] = $row->id;
                $customers[] = $list;
            }
        $response['data'] = $data;
        $response['customers'] = $customers;
        $response['headers'] = $headers;

        return view('customers.index',compact('response'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }
    public function create(){
        return view('customers.create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'phonenumber'=>'required',
            'email'=>'required',
            'address'=>'required',
            'enquiry_type'=>'required',
            'enquiry_property'=>'required',
            'from_month'=>'required',
            'to_month'=>'required',
            'enquiry_amount'=>'required',           
        ]);
        $inputs = $request->all();
        $inputs['created_by'] = Auth::user()->id;
        try{
            $customer = TblCustomer::create($inputs);
            Log::error('customer '.$customer->id.' create success');
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
        return redirect()->route('customers.index')->with('success','Customer create successfully');
    }
    public function edit($id){
        $customer = TblCustomer::find($id);
        return view('customers.edit',compact('customer'));
    }
    public function update(Request $request , $id){
        $this->validate($request, [
            'name'=>'required',
            'phonenumber'=>'required',
            'email'=>'required',
            'address'=>'required',
            'enquiry_type'=>'required',
            'enquiry_property'=>'required',
            'from_month'=>'required',
            'to_month'=>'required',
            'enquiry_amount'=>'required',         
        ]);
        $inputs = $request->all();
        $inputs['updated_by'] = Auth::user()->id;
        try{
            $customer = TblCustomer::find($id);
            $customer->update($inputs);
            Log::error('customer '.$id.' update success');
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
        return redirect()->route('customers.index')->with('success','Customer update successfully');
    }
    public function show($id){
        return view('customers.detail');
    }
    public function destroy($id){
        TblCustomer::find($id)->delete();
        return redirect()->route('customers.index')
                        ->with('success','Customer '.$id.' deleted successfully');
    }
}
