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
    {!! Form::model($owner,array('route' => ['owners.update',$owner->id],'method'=>'PATCH','enctype'=>'multipart/form-data')) !!}
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>First Name: <span class="required">*</span></strong>
                {!! Form::text('name', null, array('placeholder' => 'first name','class' => 'form-control','required')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Last Name:</strong>
                {!! Form::text('lastname', null, array('placeholder' => 'last name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Company Name:</strong>
                {!! Form::text('companyname', null, array('placeholder' => 'last name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Contact Number: <span class="required">*</span></strong>
                {!! Form::text('phonenumber', null, array('placeholder' => 'contact number','class' => 'form-control','required')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Second Contact Number:</strong>
                {!! Form::text('secondcontact', null, array('placeholder' => 'contact number','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Owner Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                {!! Form::textarea('address', null, array('placeholder' => 'Full Address','class' => 'form-control','rows'=>5)) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 py-4">
            <a class="btn btn-primary px-4 py-2" href="{{ route('owners.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection