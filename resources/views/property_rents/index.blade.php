<?php
    $id = session()->get(PROPERTY_RENT_IDFILTER);
    $name = session()->get(PROPERTY_RENT_NAMEFILTER);
    $build_year = session()->get(PROPERTY_RENT_BUILDYEARFILTER);
    $min_price = session()->get(PROPERTY_RENT_MINPRICEFILTER);
    $max_price = session()->get(PROPERTY_RENT_MAXPRICEFILTER);
    $division = session()->get(PROPERTY_RENT_DIVISIONFILTER);
    $township = session()->get(PROPERTY_RENT_TOWNSHIPFILTER);
    $ward = session()->get(PROPERTY_RENT_WARDFILTER);
?>
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['property_rents.search'],'id'=>'frm-rent-search']) !!}
        <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Property ID</strong>                        
                        {!! Form::text('id', $id, array('placeholder' => 'Property ID','class' => 'form-control  mt-2')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Property Name</strong>                        
                        {!! Form::text('name', $name, array('placeholder' => "Property's Name",'class' => 'form-control  mt-2')) !!}
                    </div>
                </div>                
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Minimum Price</strong>                     
                        {!! Form::number('min_price', $min_price, array('placeholder' => "price",'class' => 'form-control mt-2','id'=>'min_price','min'=>0)) !!}
                    </div>
                </div> 
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Maximun Price</strong>                     
                        {!! Form::number('max_price', $max_price, array('placeholder' => "price",'class' => 'form-control mt-2','id'=>'max_price','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Build Year</strong>                     
                        {!! Form::selectRange('build_year', date('Y'), (date('Y') -60) + 10, $build_year, ['class' => 'form-control mt-2', 'placeholder' => 'Select a Build Year']) !!}
                    </div>
                </div>   
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Division</strong>                     
                        {!! Form::select('division', $setup['divisions'], $division, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'id' => 'division-dropdown')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Township</strong>                     
                        {!! Form::select('township', $setup['townships'], $township, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'id' => 'township-dropdown')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Ward</strong>                     
                        {!! Form::select('ward', $setup['wards'], $ward, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'id' => 'ward-dropdown')) !!}
                    </div>
                </div>
            </div>
            <x-filter-btn resetRoute="property_rents.search.reset"/>
        {!! Form::close() !!}
    </div>
    <x-create-btn label="Create New Property" route="property_rents"/>
    <x-table :maindata="$response['data']" :body="$response['property_rents']" :headers="$response['headers']" routename="property_rents" title="Rent"/>
    
@endsection


