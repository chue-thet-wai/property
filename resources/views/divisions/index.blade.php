@php    
    $division = session()->get(DIVISION_NAMEFILTER);
@endphp
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['divisions.search']]) !!}
        <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Division</strong>                     
                        {!! Form::text('division', $division, array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>         
                <div class="col-xs-12 col-sm-12 col-md-12 py-4">                                
                    <button type="submit" class="btn btn-primary px-4 py-2">Search</button>
                    <a class="btn btn-primary px-4 py-2" href="{{ route('divisions.search.reset') }}"> Reset</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>    
    <x-create-btn label="Create New Division" route="divisions"/>
    <x-table :body="$response['divisions']" :headers="$response['headers']" routename="divisions" title="divisions"/>
    
@endsection