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
        <div class="card-header">Property Details</div>
        <div class="card-body">
        <div class="row">
        @foreach($property as $key=>$value)
            <div class="col-xs-6 col-sm-6 col-md-6">                
                <strong class="detail-label form-control">{{$key}}: {{$value}}</strong>                
            </div> 
        @endforeach              
            <div class="col-xs-12 col-sm-12 col-md-12 py-4">
                <a class="btn btn-primary" href="{{ route('properties.index') }}"> Back</a>
            </div>
        </div>
        </div>
    </div>
    
    
@endsection