
@php    
    $property_type = session()->get(PROPERTY_TYPE_NAMEFILTER);
@endphp
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['property_types.search']]) !!}
        <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Property Type</strong>                     
                        {!! Form::text('property_type', $property_type, array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>         
            </div>
            <x-filter-btn resetRoute="property_types.search.reset"/>
        {!! Form::close() !!}
    </div>   
    <x-create-btn label="Create New Property Type" route="property_types"/>
    <x-table :maindata="$response['data']" :body="$response['property_types']" :headers="$response['headers']" routename="property_types" title="property_types"/>
    
@endsection