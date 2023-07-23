@extends('layouts.navbar')
@section('cardtitle')
<h4>Agent Management</h4>
@endsection

@section('cardbody')

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


    {!! Form::open(array('route' => 'agents.store','method'=>'POST','enctype' => 'multipart/form-data')) !!}
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
        
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>First Name: <span class="required">*</span></strong>
                    {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Company Name:</strong>
                    {!! Form::text('company_name', null, array('placeholder' => 'Company Name','class' => 'form-control mt-2')) !!}
                </div>
            </div> 

            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Website:</strong>
                    {!! Form::text('website', null, array('placeholder' => 'Website','class' => 'form-control mt-2')) !!}
                </div>
            </div> 

            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control mt-2')) !!}
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Phone Number: <span class="required">*</span></strong>
                    {!! Form::text('phone_no', null, array('placeholder' => 'Phone Number','class' => 'form-control mt-2')) !!}
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Profile Photo:</strong>
                    <input type="file" name="profile_photo" class="form-control mt-2">
                </div>
            </div>
            
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Document:</strong>
                    <input type="file" name="document" class="form-control mt-2">
                </div>
            </div>


            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Address:</strong>
                    {!! Form::textarea('address', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Remark:</strong>
                    {!! Form::textarea('remark', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
            <a class="btn btn-primary px-4 py-2" href="{{ route('agents.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
        </div>
    {!! Form::close() !!}

@endsection