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
    {!! Form::model($division,['route' => ['divisions.update',$division->id],'method'=>'PATCH','enctype'=>'multipart/form-data']) !!}
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Division: <span class="required">*</span></strong>
                {!! Form::text('division', $division->division, array('placeholder' => 'Division','class' => 'form-control','required')) !!}
            </div>
            <div class="form-group">
                <strong>Division: <span class="required">*</span></strong>
                {!! Form::text('division_mm', $division->division_mm, array('placeholder' => 'Division','class' => 'form-control','required')) !!}
            </div>
        </div>        
        <div class="col-xs-12 col-sm-12 col-md-12 py-4">
            <a class="btn btn-primary" href="{{ route('divisions.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection