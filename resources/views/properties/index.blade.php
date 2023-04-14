@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <x-create-btn label="Create New Property" route="properties"/>
    <x-table :body="$response['properties']" :headers="$response['headers']" routename="properties" title="Properties"/>
    {!! $response['data']->render() !!}
@endsection


