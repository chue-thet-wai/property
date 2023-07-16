@php    
    $tenure = session()->get(TENURE_NAMEFILTER);
@endphp
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['tenures.search']]) !!}
        <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Tenure Property</strong>                     
                        {!! Form::text('tenure', $tenure, array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>         
                <div class="col-xs-12 col-sm-12 col-md-12 py-4">                                
                    <button type="submit" class="btn btn-primary px-4 py-2">Search</button>
                    <a class="btn btn-primary px-4 py-2" href="{{ route('tenures.search.reset') }}"> Reset</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <x-create-btn label="Create New Tenure" route="tenures"/>
    <x-table :body="$response['tenures']" :headers="$response['headers']" routename="tenures" title="tenures"/>
    
@endsection