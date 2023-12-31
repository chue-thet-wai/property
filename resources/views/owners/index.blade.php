<?php
    $phone = session()->get(OWNER_PHONEFILTER);
    $name = session()->get(OWNER_NAMEFILTER);    
?>
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['owners.search']]) !!}
        <div class="row">
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
            </div>
            <x-filter-btn resetRoute='owners.search.reset' />
        {!! Form::close() !!}
    </div>
    <x-create-btn label="Create New Owner" route="owners"/>
    <x-table :maindata="$response['data']" :body="$response['owners']" :headers="$response['headers']" routename="owners" title="Owners"/>    
@endsection


