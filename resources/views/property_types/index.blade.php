<?php
    // $id = session()->get(CUST_IDFILTER);
    // $name = session()->get(CUST_NAMEFILTER);    
    // $phone = session()->get(CUST_PHONEFILTER);    
    // $type = session()->get(CUST_ENQUIRYTYPEFILTER);    
    // $property = session()->get(CUST_ENQUIRYPROPERTYFILTER);    
?>
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <x-create-btn label="Create New Property Type" route="property_types"/>
    <x-table :body="$response['property_types']" :headers="$response['headers']" routename="property_types" title="property_types"/>
    {!! $response['data']->render() !!}
@endsection