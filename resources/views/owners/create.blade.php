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
    {!! Form::open(array('route' => 'owners.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="bg-white px-4 py-5 rounded mb-2">
        <h2>Contact Information</h2>
        <div class="row g-3">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>First Name: <span class="required">*</span></strong>
                    {!! Form::text('name', null, array('placeholder' => 'first name','class' => 'form-control mt-2','required')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    {!! Form::text('lastname', null, array('placeholder' => 'last name','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Company Name:</strong>
                    {!! Form::text('companyname', null, array('placeholder' => 'last name','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Contact Number: <span class="required">*</span></strong>
                    {!! Form::text('phonenumber', null, array('placeholder' => 'contact number','class' => 'form-control mt-2','required')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Second Contact Number:</strong>
                    {!! Form::text('secondcontact', null, array('placeholder' => 'contact number','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Owner Email','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    {!! Form::textarea('address', null, array('placeholder' => 'Full Address','class' => 'form-control mt-2','rows'=>5)) !!}
                </div>
            </div>            
        </div>        
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary px-4 py-2" href="{{ route('owners.index') }}"> Back</a>
        <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
    </div>  
    
    {!! Form::close() !!}
@endsection