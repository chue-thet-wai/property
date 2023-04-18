@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <x-create-btn label="Create New Customer" route="customers"/>
    <x-table :body="$response['customers']" :headers="$response['headers']" routename="customers" title="customers"/>
    {!! $response['data']->render() !!}
@endsection


