@php    
    $floor = session()->get(FLOOR_NAMEFILTER);
@endphp
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['floors.search']]) !!}
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Floor</strong>                     
                    {!! Form::text('floor', $floor, array('placeholder' => '','class' => 'form-control mt-2')) !!}
                </div>
            </div>         
        </div>
        <x-filter-btn resetRoute='floors.search.reset' />
        {!! Form::close() !!}
    </div>    
    <x-create-btn label="Create New Floor" route="floors"/>
    <x-table :maindata="$response['data']" :body="$response['floors']" :headers="$response['headers']" routename="floors" title="floors"/>
    @endsection