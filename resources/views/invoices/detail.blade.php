@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @foreach ($errors->all() as $error)
        <x-alert type="danger" message="{{$error}}" />
    @endforeach

    <div class="bg-white px-4 py-5 rounded mb-2">
        <h2 class="mb-4 fw-bolder">Invoice Info</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <strong>Invoice ID</strong>
                <div>{{ $invoice->invoice_id }}</div>
            </div> 
            <div class="col-md-4">
                <strong>Type</strong>
                <div>{{ $categories[$invoice->type] }}</div>
            </div> 
            <div class="col-md-4">
                <strong>Contract Date</strong>
                <div>{{ $invoice->contract_date }}</div>
            </div> 
            @if($invoice->type == RENT)
                <div class="col-md-4">
                    <strong>Rent Out Date</strong>
                    <div>{{ $invoice->rentout_date }}</div>
                </div>                
            @endif             
            <div class="col-md-4">
                <strong>Contract Month</strong>
                <div>{{ $invoice->contract_month }}</div>
            </div> 
            <div class="col-md-4">
                <strong>Deal Price</strong>
                <div>{{ $invoice->deal_price }}</div>
            </div> 
            <div class="col-md-4">
                <strong>Agent Fee</strong>
                <div>{{ $invoice->agent_fee }}</div>
            </div> 
            <div class="col-md-4">
                <strong>Discount</strong>
                <div>{{ $invoice->discount }}</div>
            </div>
            <div class="col-md-4">
                <strong>Tax</strong>
                <div>{{ $invoice->tax }}</div>
            </div>  
            <div class="col-md-4">
                <strong>Total</strong>
                <div>{{ $invoice->total }}</div>
            </div>
            <div class="col-md-4">
                <strong>Partner Fee</strong>
                <div>{{ $invoice->partner_fee }}</div>
            </div>  
            <div class="col-md-4">
                <strong>Agent Net Amount</strong>
                <div>{{ $invoice->agency_net_amt }}</div>
            </div> 
        </div>
    </div>

    <div class="bg-white px-4 py-5 rounded mb-2">
        <h2 class="mb-4 fw-bolder">Owner Info</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <strong>Owner</strong>
                <div>{{ $invoice->owner->name }}</div>
            </div> 
            <div class="col-md-4">
                <strong>Owner Contact</strong>
                <div>{{ $invoice->owner->phonenumber }}</div>
            </div> 
            <div class="col-md-4">
                <strong>Owner Email</strong>
                <div>{{ $invoice->owner->email }}</div>
            </div> 
        </div>
    </div>

    <div class="d-flex gap-2">
        <div class="bg-white px-4 py-5 rounded mb-2 w-50">
            <h2 class="mb-4 fw-bolder">Customer Information</h2>
            <div class="row g-3">
                <div class="col-md-6">                
                    <strong>Name</strong>
                    <div>{{ $invoice->customer->name }}</div>        
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">                
                    <strong>Contact</strong>
                    <div>{{ $invoice->customer->phonenumber }}</div>        
                </div>
            </div>
            <div class="row g-3">
                <div class="col-lg-6 col-md-3">                
                    <strong>Email</strong>
                    <div>{{ $invoice->customer->email }}</div>        
                </div>
            </div>
        </div>
        <div class="bg-white px-4 py-5 rounded mb-2 w-50">
            <h2 class="mb-4 fw-bolder">Partner Information</h2>
            <div class="row g-3">
                <div class="col-md-6">                
                    <strong>First Name</strong>
                    <div>{{ $invoice->partner->first_name }}</div>        
                </div>
                <div class="col-md-6">                
                    <strong>Last Name</strong>
                    <div>{{ $invoice->partner->last_name }}</div>          
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-md-3">                
                    <strong>Contact</strong>
                    <div>{{ $invoice->partner->phone_no }}</div>        
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-3">                
                    <strong>Email</strong>
                    <div>{{ $invoice->partner->email }}</div>        
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white px-4 py-5 rounded mb-2">
        <h2 class="mb-4 fw-bolder">Property Info</h2>
        <div class="row g-3">                
            <div class="col-md-6">                    
                <strong>{{__('messages.title')}}</strong>
                <div>{{ $invoice->property->title }}</div>        
            </div>
            <div class="col-md-6">                    
                <strong>{{__('messages.title')}} (mm):</strong>
                <div>{{ $invoice->property->title_mm }}</div>        
            </div>
            <div class="col-md-6">                    
                <strong>Price</strong>
                <div>{{ $invoice->property->price }}</div>        
            </div>
            <div class="col-md-6">                    
                <strong>Promotion Price</strong>
                <div>{{ $invoice->property->promotion_price }}</div>        
            </div>
            @if($invoice->type == RENT)
                <div class="col-md-6">
                    <strong>Available Date</strong>
                    <div>{{ $invoice->available_date }}</div>
                </div>
            @endif
            <div class="col-md-6">                    
                <strong>Bank Loan</strong>
                <div>{{ ($invoice->property->bank_loan == 1) ? 'Yes' : 'No'  }}</div>        
            </div>
            <div class="col-md-6">                    
                <strong>{{__('messages.description')}}</strong>
                <div>{{ $invoice->property->description }}</div>        
            </div> 
            <div class="col-md-6">          
                <strong>{{__('messages.description')}} (mm)</strong>
                <div>{{ $invoice->property->description_mm }}</div>        
            </div>            
        </div>        
    </div> 
    <div class="bg-white px-4 py-5 rounded mb-2">        
        <h2 class="mb-4 fw-bolder">Property Area</h2>
        <div class="row g-3">
            <div class="col-md-3">                
                <strong>Front Area</strong>
                <div>{{ $invoice->property->front_area }}</div>    
            </div>
            <div class="col-md-3">                
                <strong>Side Area</strong>
                <div>{{ $invoice->property->side_area }}</div>
            </div>
            <div class="col-md-3">
                <strong>Square Feet</strong>
                <div>{{ $invoice->property->square_feet }}</div>
            </div>
            <div class="col-md-3">
                
                <strong>Acre</strong>
                <div>{{ $invoice->property->acre }}</div>
            </div>
        </div>
    </div>
     <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Documents</h2>
            <div class="row g-3">                
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Confidential Documents</strong>                        
                        <div class="documentsBox d-flex flex-column gap-2">
                            @foreach ($invoice->document as $document)
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{$document->contract_doc}}</span>
                                </div>
                            @endforeach
                        </div>                        
                    </div>
                </div>                 
            </div>        
        </div>
@endsection