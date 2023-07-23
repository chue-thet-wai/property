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
    {!! Form::model($property_type,['route' => ['property_types.update',$property_type->id],'method'=>'PATCH','enctype'=>'multipart/form-data']) !!}
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
        <h2>Property Type Set Up</h2>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Property Type: <span class="required">*</span></strong>
                    {!! Form::text('property_type', $property_type->property_type, array('placeholder' => 'Property Type','class' => 'form-control','required')) !!}
                </div>
            </div>        
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <strong>Property Type(mm): <span class="required">*</span></strong>
                    {!! Form::text('property_type_mm', $property_type->property_type_mm, array('placeholder' => 'Property Type','class' => 'form-control','required')) !!}
                </div>
            </div> 
        </div>
    </div>       
    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary" href="{{ route('property_types.index') }}"> Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    {!! Form::close() !!}
@endsection