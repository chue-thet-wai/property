@php    
    $division = session()->get(WARD_DIVISIONFILTER);
    $township = session()->get(WARD_TOWNSHIPFILTER);
    $ward = session()->get(WARD_NAMEFILTER);
@endphp
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['wards.search']]) !!}
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
                        {!! Form::select('township_id', $response['townships'], $township, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'id' => 'township-dropdown')) !!}
                    </div>
                </div>   
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Ward</strong>                     
                        {!! Form::text('ward', $ward, array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>       
                <div class="col-xs-12 col-sm-12 col-md-12 py-4">                                
                    <button type="submit" class="btn btn-primary px-4 py-2">Search</button>
                    <a class="btn btn-primary px-4 py-2" href="{{ route('wards.search.reset') }}"> Reset</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    
    <x-create-btn label="Create New Ward" route="wards"/>
    <x-table :body="$response['wards']" :headers="$response['headers']" routename="wards" title="wards"/>
    
@endsection