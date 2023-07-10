@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <x-create-btn label="Create New Ward" route="wards"/>
    <x-table :body="$response['wards']" :headers="$response['headers']" routename="wards" title="wards"/>
    
@endsection