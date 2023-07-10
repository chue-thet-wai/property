@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <x-create-btn label="Create New Property Type" route="property_types"/>
    <x-table :body="$response['property_types']" :headers="$response['headers']" routename="property_types" title="property_types"/>
    
@endsection