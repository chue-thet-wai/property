@php
    $id = session()->get(PROPERTY_IDFILTER);
    $name = session()->get(PROPERTY_NAMEFILTER);
    $build_year = session()->get(PROPERTY_BUILDYEARFILTER);
    $min_price = session()->get(PROPERTY_MINPRICEFILTER);
    $max_price = session()->get(PROPERTY_MAXPRICEFILTER);
    $division = session()->get(PROPERTY_DIVISIONFILTER);
    $township = session()->get(PROPERTY_TOWNSHIPFILTER);
    $ward = session()->get(PROPERTY_WARDFILTER);
@endphp
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
                        {!! Form::text('id', $id, array('placeholder' => 'Property ID','class' => 'form-control  mt-2')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Property Name</strong>
                        
                        {!! Form::text('name', $name, array('placeholder' => "Property's Name",'class' => 'form-control mt-2')) !!}
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
                <div class="col-xs-2 col-sm-2 col-md-2 py-4">                                
                    <button type="submit" class="btn btn-primary px-4 py-2">Search</button>
                    <a class="btn btn-primary px-4 py-2" href="{{ route('properties.search.reset') }}"> Reset</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <x-create-btn label="Create New Property" route="properties"/>
    <x-table :body="$response['properties']" :headers="$response['headers']" routename="properties" title="Properties"/>
@endsection


