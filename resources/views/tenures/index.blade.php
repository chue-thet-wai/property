@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <x-create-btn label="Create New Tenure" route="tenures"/>
    <x-table :body="$response['tenures']" :headers="$response['headers']" routename="tenures" title="tenures"/>
    
@endsection