@extends('layouts.navbar')
@section('cardtitle')
    <h4>User Management</h4>
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




{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id],'enctype' => 'multipart/form-data']) !!}

<div class="row g-2">
   
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>First Name: <span class="required">*</span></strong>
            {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Last Name:</strong>
            {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>User Name: <span class="required">*</span></strong>
            {!! Form::text('username', null, array('placeholder' => 'User Name','class' => 'form-control')) !!}
        </div>
    </div> 

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Email: <span class="required">*</span></strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Phone Number: <span class="required">*</span></strong>
            {!! Form::text('phone_no', null, array('placeholder' => 'Phone Number','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Profile Photo:</strong>
            <input type="file" name="profile_photo" class="form-control">
        </div>
    </div>
    
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Password: <span class="required">*</span></strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>    
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Confirm Password: <span class="required">*</span></strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Document:</strong>
            <input type="file" name="document" class="form-control">
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Start Working Date:</strong>
            <input type="date" name="start_working_date" class="form-control" value="{{ old('start_working_date', $user->start_working_date) }}">
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Resignation Date:</strong>
            <input type="date" name="resignation_date" class="form-control" value="{{ old('resignation_date', $user->resignation_date) }}">
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>About:</strong>
            {!! Form::textarea('about', null, array('class' => 'form-control','rows' => 4)) !!}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Address:</strong>
            {!! Form::textarea('address', null, array('class' => 'form-control','rows' => 4)) !!}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Remark:</strong>
            {!! Form::textarea('remark', $user->remark, array('class' => 'form-control','rows' => 4)) !!}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Department:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary px-4 py-2" href="{{ route('users.index') }}"> Back</a>
        <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection