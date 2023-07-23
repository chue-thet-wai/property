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
    {!! Form::open(array('route' => 'wards.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
        <h2>Ward Set Up</h2>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Township: <span class="required">*</span></strong>
                    {!! Form::select('township_id', $townships,null, array('placeholder' => 'Choose','class' => 'form-control','required')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Ward: <span class="required">*</span></strong>
                    {!! Form::text('ward', null, array('placeholder' => 'Ward Name','class' => 'form-control','required')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Ward(mm): <span class="required">*</span></strong>
                    {!! Form::text('ward_mm', null, array('placeholder' => 'Ward Name','class' => 'form-control','required')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary" href="{{ route('wards.index') }}"> Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    {!! Form::close() !!}
@endsection