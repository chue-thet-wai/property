@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <x-create-btn label="Create New Floor" route="floors"/>
    <x-table :body="$response['floors']" :headers="$response['headers']" routename="floors" title="floors"/>
    @endsection