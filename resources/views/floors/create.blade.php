@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @foreach ($errors->all() as $error)
        <x-alert type="danger" message="{{$error}}" />
    @endforeach
    {!! Form::open(array('route' => 'floors.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
        <h2>Floor Set Up</h2>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Floor: <span class="required">*</span></strong>
                    {!! Form::text('floor', null, array('placeholder' => 'Floor','class' => 'form-control','required')) !!}
                </div>
            </div>        
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Floor(mm): <span class="required">*</span></strong>
                    {!! Form::text('floor_mm', null, array('placeholder' => 'Floor','class' => 'form-control','required')) !!}
                </div>
            </div>
        </div>
    </div>        
    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary" href="{{ route('floors.index') }}"> Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    {!! Form::close() !!}
@endsection