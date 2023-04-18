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
    {!! Form::open(array('route' => 'customers.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Name: <span class="required">*</span></strong>
                {!! Form::text('name', null, array('placeholder' => 'Customer Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Contact: <span class="required">*</span></strong>
                {!! Form::text('phonenumber', null, array('placeholder' => 'Customer phone number','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Email: <span class="required">*</span></strong>
                {!! Form::text('email', null, array('placeholder' => 'Customer Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address: <span class="required">*</span></strong>
                {!! Form::textarea('address', null, array('placeholder' => 'Full Address','class' => 'form-control','rows'=>3)) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Enquiry Type: <span class="required">*</span></strong>
                {!! Form::select('enquiry_type', $enquirytypes, null, array('placeholder' => 'Choose...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>From Month: <span class="required">*</span></strong>
                {!! Form::date('from_month', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>To Month: <span class="required">*</span></strong>
                {!! Form::date('to_month', null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Property ID: <span class="required">*</span></strong>
                {!! Form::text('enquiry_property', null, array('placeholder' => 'Property','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Price: <span class="required">*</span></strong>
                {!! Form::text('enquiry_amount', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
            </div>
        </div>        
        <div class="col-xs-12 col-sm-12 col-md-12 py-4">
            <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection