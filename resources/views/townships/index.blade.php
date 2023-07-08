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
    
    <x-create-btn label="Create New Township" route="townships"/>
    <x-table :body="$response['townships']" :headers="$response['headers']" routename="townships" title="townships"/>
    {!! $response['data']->render() !!}
@endsection