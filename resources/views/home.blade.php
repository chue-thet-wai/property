@extends('layouts.navbar')

@section('cardtitle')
    Dashboard
@endsection
@section('cardbody')
    {{ __('WELCOME!') }}
    {{__('messages.welcome')}}
@endsection