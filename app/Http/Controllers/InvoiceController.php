<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDocument;
use App\Models\TblOwner;

class InvoiceController extends Controller
{
    public function index(){
        $response = [];
        $invoice_arr = [];
        $headers = [
            'Type',
            'invoice_id',
            'contract_date',
            'rentout_date',
            'owner',
            'customer',
            'property',
            'action'
        ];
        $invoices = Invoice::with('owner')->with('partner')->with('property');
        if(session()->get(INVOICE_INVOICEIDFILTER)){
            $invoices = $invoices->where('invoice_id',session()->get(INVOICE_INVOICEIDFILTER));
        }
        if(session()->get(INVOICE_CONTRACTDATEFILTER)){
            $invoices = $invoices->where('contract_date',session()->get(INVOICE_CONTRACTDATEFILTER));
        }
        if(session()->get(INVOICE_RENTOUTDATEFILTER)){
            $invoices = $invoices->where('rentout_date',session()->get(INVOICE_RENTOUTDATEFILTER));
        }
        if(session()->get(INVOICE_TYPEFILTER)){
            $invoices = $invoices->where('type',session()->get(INVOICE_TYPEFILTER));
        }
        $invoices = $invoices->where('is_delete',0)->get();
        if($invoices){
            foreach($invoices as $invoice){
                $list = array();
                $list['type'] = $invoice->type;
                $list['invoice_id'] = $invoice->invoice_id;
                $list['contract_date'] = $invoice->contract_date;
                $list['rentout_date'] = $invoice->rentout_date;
                $list['owner'] = $invoice->owner->name;                
                $list['customer'] = $invoice->customer->name;
                $list['property'] = $invoice->property->title;
                $list['actions'] = $invoice->id;
                $invoice_arr[] = $list;
            }
        }
        $response['invoices'] = $invoice_arr;
        $response['headers'] = $headers;
        return view('invoices.index',compact('response'));
    }

    public function create(){
        $invoice_id = generate_invoice_id();
        return view('invoices.create',compact('invoice_id'));
    }

    public function edit($id){
        $properties = [];
        $invoice = Invoice::with('owner')->with('partner')->with('property')->with('customer')->where('id',$id)->first();
        $owner = TblOwner::with('property')->where('id',$invoice->owner->id)->first();
        
        if($owner->property){
            foreach($owner->property as $row){
                $properties[$row->id] = $row->title;
            }
        }
        return view('invoices.edit',compact('invoice','properties'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'type'=>'required',
            'contract_date' => 'required',
            'rentout_date' => 'required',
            'contract_month' => 'required',
            'owner_id' => 'required',
            'property_id' => 'required',
            'customer_id' => 'required',
            'total' => 'required'
        ]);
        $inputs = $request->all();
        $inputs['created_by'] = auth()->user()->id;
        $invoice = Invoice::create($inputs);
        $docs = [];
        $contract_doc = $request->contract_doc;
        if($contract_doc){
            foreach($contract_doc as $key => $doc)
            {   
                $docName = time().rand(1,99).'.'.$doc->extension();
                // $doc->storeAs('property_docs', $docName, 's3');
                $doc->storeAs('public/contract_docs', $docName);
                
                $docs[]['contract_doc'] = $docName;
            }
        }
        foreach ($docs as $key => $doc) {
            $doc['invoice_id'] = $invoice->id;  
            // return $image;              
            InvoiceDocument::create($doc);
        }
        return redirect()->route('invoices.index');
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'type'=>'required',
            'contract_date' => 'required',
            'rentout_date' => 'required',
            'contract_month' => 'required',
            'owner_id' => 'required',
            'property_id' => 'required',
            'customer_id' => 'required',
            'total' => 'required'
        ]);
        $invoice = Invoice::find($id);
        $inputs = $request->all();
        $inputs['updated_by'] = auth()->user()->id;
        if($invoice){
            $invoice->update($inputs);
        }
        $docs = [];
        $contract_doc = $request->contract_doc;
        if($contract_doc){
            foreach($contract_doc as $key => $doc)
            {   
                $docName = time().rand(1,99).'.'.$doc->extension();
                $doc->storeAs('public/contract_docs', $docName);                
                $docs[]['contract_doc'] = $docName;
            }
        }
        foreach ($docs as $key => $contract_doc) {
            $contract_doc['invoice_id'] = $invoice->id;            
            InvoiceDocument::create($contract_doc);
        }
        return redirect()->route('invoices.index');
    }

    public function show($id){
        $invoice = Invoice::with('owner')
        ->with('partner')
        ->with('property')
        ->with('customer')
        ->with('document')
        ->where('id',$id)->first();
        return view('invoices.detail',compact('invoice'));
    }

    public function softdelete(Request $request){
        $invoice = Invoice::find($request->id);
        $inputs = [];
        $inputs['is_delete'] = 1;
        $inputs['updated_by'] = auth()->user()->id;
        if($invoice){
            $invoice->update($inputs);
        }
        return $invoice;
    }

    function search(Request $request){
        session()->start();
        session()->put(INVOICE_INVOICEIDFILTER, trim($request->invoice_id));
        session()->put(INVOICE_CONTRACTDATEFILTER, trim($request->contract_date));
        session()->put(INVOICE_RENTOUTDATEFILTER, trim($request->rentout_date));
        session()->put(INVOICE_TYPEFILTER, trim($request->type));
        return redirect()->back();
    }

    function reset(){
        session()->forget([
            INVOICE_INVOICEIDFILTER,
            INVOICE_CONTRACTDATEFILTER,
            INVOICE_RENTOUTDATEFILTER,
            INVOICE_TYPEFILTER
        ]);
        return redirect()->back();
    }

    public function destory_doc(Request $request){
        try{
            InvoiceDocument::find($request->id)->delete();
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
}
