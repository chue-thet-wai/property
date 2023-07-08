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

    <div class="card">
        <div class="card-header">Owner Details</div>
        <div class="card-body">
        <div class="row">
            @foreach($response['owner'] as $key=>$value)
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <strong class="detail-label">{{$key}}</strong> 
                    <p>{{$value}}<p>      
                </div> 
            @endforeach
        </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Owner's Properties</div>
        <div class="card-body">            
            <x-table :body="$response['properties']" :headers="$response['headers']" routename="properties" title="Properties"/>            
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary px-4 py-2" href="{{ route('owners.index') }}"> Back</a>
    </div>
@endsection