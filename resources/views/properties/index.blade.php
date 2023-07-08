<?php
    $id = session()->get(PROPERTY_IDFILTER);
    $name = session()->get(PROPERTY_NAMEFILTER);
    $category = session()->get(PROPERTY_CATEGORYFILTER);
    $location = session()->get(PROPERTY_LOCATIONFILTER);
    $build_year = session()->get(PROPERTY_BUILDYEARFILTER);
    $min_price = session()->get(PROPERTY_MINPRICEFILTER);
    $max_price = session()->get(PROPERTY_MAXPRICEFILTER);
?>
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['properties.search']]) !!}
        <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Property ID</strong>                        
                        {!! Form::text('id', $id, array('placeholder' => 'Property ID','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Property Name</strong>
                        
                        {!! Form::text('name', $name, array('placeholder' => "Property's Name",'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Category</strong>
                        {!! Form::select('category', $categories, $category, array('placeholder' => 'Choose...','class' => 'form-control')) !!}
                    </div>
                </div> 
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Location</strong>                     
                        {!! Form::text('location', $location, array('placeholder' => "Location",'class' => 'form-control','id'=>'township')) !!}
                    </div>
                </div> 
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Build Year</strong>                     
                        {!! Form::text('build_year', $build_year, array('placeholder' => "Build Year",'class' => 'form-control')) !!}
                    </div>
                </div>   
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Minimum Price</strong>                     
                        {!! Form::number('min_price', $min_price, array('placeholder' => "price",'class' => 'form-control','id'=>'min_price')) !!}
                    </div>
                </div> 
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Maximun Price</strong>                     
                        {!! Form::number('max_price', $max_price, array('placeholder' => "price",'class' => 'form-control','id'=>'max_price')) !!}
                    </div>
                </div>              
                <div class="col-xs-2 col-sm-2 col-md-2 py-4">                                
                    <button type="submit" class="btn btn-primary px-4 py-2">Search</button>
                    <a class="btn btn-primary px-4 py-2" href="{{ route('properties.search.reset') }}"> Reset</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <x-create-btn label="Create New Property" route="properties"/>
    <x-table :body="$response['properties']" :headers="$response['headers']" routename="properties" title="Properties"/>
    {!! $response['data']->render() !!}
@endsection


