@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <x-create-btn label="Create New Owner" route="owners"/>
    <x-table :body="$response['owners']" :headers="$response['headers']" routename="owners" title="Owners"/>
    {!! $response['data']->render() !!}
@endsection


