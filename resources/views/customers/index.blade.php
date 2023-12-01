<?php
    $id = session()->get(CUST_IDFILTER);
    $name = session()->get(CUST_NAMEFILTER);    
    $phone = session()->get(CUST_PHONEFILTER);    
    $type = session()->get(CUST_ENQUIRYTYPEFILTER);    
    $property = session()->get(CUST_ENQUIRYPROPERTYFILTER);    
?>
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['customers.search']]) !!}
        <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Customer ID</strong>                        
                        {!! Form::text('id', $id, array('placeholder' => 'ID','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Name</strong>                        
                        {!! Form::text('name', $name, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Contact</strong>                        
                        {!! Form::text('phonenumber', $phone, array('placeholder' => "Contact",'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Enquiry Type</strong>
                    {!! Form::select('type', $enquirytypes, $type, array('placeholder' => 'Choose...','class' => 'form-control')) !!}
                </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Enquiry Property ID</strong>                        
                        {!! Form::text('property', $property, array('placeholder' => "Property ID",'class' => 'form-control')) !!}
                    </div>
                </div>            
            </div>
            <x-filter-btn resetRoute="customers.search.reset"/>
        {!! Form::close() !!}
    </div>
    <x-create-btn label="Create New Customer" route="customers"/>
    <x-table :maindata="$response['data']" :body="$response['customers']" :headers="$response['headers']" routename="customers" title="customers"/>
    
@endsection


