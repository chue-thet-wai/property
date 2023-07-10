@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <x-create-btn label="Create New Township" route="townships"/>
    <x-table :body="$response['townships']" :headers="$response['headers']" routename="townships" title="townships"/>
   
@endsection