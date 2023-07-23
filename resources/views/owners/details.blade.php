@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @foreach ($errors->all() as $error)
        <x-alert type="danger" message="{{$error}}" />
    @endforeach

    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
        <h2>Owner Infromation</h2>
            @foreach($response['owner'] as $key=>$value)
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <strong class="detail-label">{{$key}}</strong> 
                    <p>{{$value}}<p>      
                </div> 
            @endforeach
        </div>
    </div>
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
        <h2>Owner's Properties</h2>            
            <x-table :body="$response['properties']" :headers="$response['headers']" routename="properties" title="Properties"/>            
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary px-4 py-2" href="{{ route('owners.index') }}"> Back</a>
    </div>
@endsection