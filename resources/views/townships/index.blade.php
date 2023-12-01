@php    
    $division = session()->get(TOWNSHIP_DIVISIONFILTER);
    $township = session()->get(TOWNSHIP_NAMEFILTER);
@endphp
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['townships.search']]) !!}
        <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Division</strong>                     
                        {!! Form::select('division_id', $response['divisions'], $division, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'id' => 'division-dropdown')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Township</strong>                     
                        {!! Form::text('township', $township, array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>         
            </div>
            <x-filter-btn resetRoute="townships.search.reset"/>
        {!! Form::close() !!}
    </div>
    <x-create-btn label="Create New Township" route="townships"/>
    <x-table :maindata="$response['data']" :body="$response['townships']" :headers="$response['headers']" routename="townships" title="townships"/>   
@endsection