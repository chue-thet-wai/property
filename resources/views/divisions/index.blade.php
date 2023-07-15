@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <x-create-btn label="Create New Division" route="divisions"/>
    <x-table :body="$response['divisions']" :headers="$response['headers']" routename="divisions" title="divisions"/>
    
@endsection