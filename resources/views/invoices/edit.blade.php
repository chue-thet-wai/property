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
    {!! Form::model($invoice,array('method'=>'PATCH','enctype'=>'multipart/form-data','route'=>['invoices.update',$invoice->id])) !!}
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2>Invoice Information</h2>
            <div class="row g-3">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Type: <span class="required">*</span></strong>
                        {!! Form::select('type', $categories, null, array('placeholder' => 'Choose...','class' => 'form-control mt-2','required')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Invoice ID: <span class="required">*</span></strong>
                        {!! Form::text('invoice_id', null, array('placeholder' => 'invoice id','class' => 'form-control mt-2','required')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Contract Date: <span class="required">*</span></strong>
                        {!! Form::date('contract_date', null, array('placeholder' => '','class' => 'form-control mt-2','required')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Rent Out Date: <span class="required">*</span></strong>
                        {!! Form::date('rentout_date', null, array('placeholder' => '','class' => 'form-control mt-2','required')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Contract Month: <span class="required">*</span></strong>
                        {!! Form::number('contract_month', null, array('placeholder' => '','class' => 'form-control mt-2','required','min'=>0)) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2>Owner Information</h2>
            <div class="row g-3">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Owner Name: <span class="required">*</span></strong>
                        {!! Form::text('owner', $invoice->owner->name, array('placeholder' => '','class' => 'form-control mt-2','id'=>'owner','required')) !!}
                        {!! Form::hidden('owner_id', $invoice->owner->id, array('class' => 'form-control','id'=>'owner_id','required')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Owner Contact: <span class="required">*</span></strong>
                        {!! Form::text('phonenumber', $invoice->owner->phonenumber, array('placeholder' => '','class' => 'form-control mt-2','id'=>'phonenumber','required')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2>Customer Information</h2>
            <div class="row g-3">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Customer Name: <span class="required">*</span></strong>
                        {!! Form::text('customer_name', $invoice->customer->name, array('placeholder' => '','class' => 'form-control mt-2','required','id'=>'customer')) !!}
                        {!! Form::hidden('customer_id', $invoice->customer->id, array('placeholder' => '','class' => 'form-control','required','id'=>'customer_id')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Customer Contact: <span class="required">*</span></strong>
                        {!! Form::text('customer_contact', $invoice->customer->phonenumber, array('placeholder' => '','class' => 'form-control mt-2','required','id'=>'customer_contact')) !!}
                    </div>
                </div>
            </div>
            
        </div>
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2>Partner Information</h2>
            <div class="row g-3">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>First Name: <span class="required">*</span></strong>
                        {!! Form::text('partner', $invoice->partner->first_name, array('placeholder' => '','class' => 'form-control mt-2','required','id'=>'partner')) !!}
                        {!! Form::hidden('partner_id', null, array('placeholder' => '','class' => 'form-control','required','id'=>'partner_id')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Last Name:</strong>
                        {!! Form::text('last_name', $invoice->partner->last_name, array('placeholder' => '','class' => 'form-control mt-2','id'=>'last_name')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Partner Contact: <span class="required">*</span></strong>
                        {!! Form::text('partner_contact', $invoice->partner->phone_no, array('placeholder' => '','class' => 'form-control mt-2','required','id'=>'partner_contact')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2>Property Information</h2>
            <div class="row g-3">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Property: <span class="required">*</span></strong>
                        {!! Form::select('property_id',$properties,$invoice->property->id, array('placeholder' => '','class' => 'form-control mt-2','required','id'=>'property')) !!}                    
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Deal Price:</strong>
                        {!! Form::number('deal_price', null, array('placeholder' => '','class' => 'form-control mt-2','min'=>0,'id'=>'deal-price')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Agent Fee:</strong>
                        {!! Form::number('deal_price', null, array('placeholder' => '','class' => 'form-control mt-2','min'=>0,'id'=>'agent-fee')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Discount:</strong>
                        {!! Form::number('discount', null, array('placeholder' => '','class' => 'form-control mt-2','min'=>0,'id'=>'discount')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Tax:</strong>
                        {!! Form::number('tax', null, array('placeholder' => '','class' => 'form-control mt-2','min'=>0,'id'=>'tax')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Total:</strong>
                        {!! Form::number('total', null, array('placeholder' => '','class' => 'form-control mt-2','min'=>0,'id'=>'total')) !!}
                    </div>
                </div>
            </div>
        </div>    
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2>Others</h2>
            <div class="row g-3">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Partner Fee:</strong>
                        {!! Form::number('partner_fee', null, array('placeholder' => '','class' => 'form-control mt-2','id'=>'partner-fee')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Agency Net Amount:</strong>
                        {!! Form::number('agency_net_amt', null, array('placeholder' => '','class' => 'form-control mt-2','id'=>'agency-net-amt')) !!}
                    </div>
                </div>            
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        {!! Form::textarea('description', null, array('placeholder' => '','class' => 'form-control mt-2','rows' => 3)) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2>Documents</h2>
            <div class="row g-3">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Documents:</strong>
                        {!! Form::file('contract_doc[]', array('placeholder' => '','class' => 'form-control mt-2','multiple' => 'multiple')) !!}
                        <div class="documentsBox d-flex flex-column gap-2">
                            @foreach ($invoice->document as $document)
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{$document->contract_doc}}</span>
                                    <i class="fa-solid fa-circle-xmark contract-doc-delete-icon" data-id="{{$document->id}}"></i>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 py-4">
            <a class="btn btn-primary" href="{{ route('invoices.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {!! Form::close() !!}
@endsection