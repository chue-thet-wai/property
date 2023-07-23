@extends('layouts.navbar')
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
    
    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
        <div class="bg-white px-4 py-5 rounded mb-2">
            <div class="row g-3">
                <div class="col-xs-2 col-sm-2 col-md-2 text-center">
                    <div class="user-profile">
                        <img src="{{ asset('thumbnails/user-photos/'. $user->profile_photo) }}" alt="profile img">
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8">
                    <h2>User Information</h2>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>First Name:</strong>
                        {!! Form::text('first_name', null, array('placeholder' => 'Name','class' => 'form-control','required')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Last Name:</strong>
                        {!! Form::text('last_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>User Name:</strong>
                        {!! Form::text('username', null, array('placeholder' => 'User Name','class' => 'form-control','required')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Phone Number:</strong>
                        {!! Form::text('phone_no', null, array('placeholder' => 'phone','class' => 'form-control','required')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','required')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Department:</strong>
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control selectpicker','multiple','required')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Start Working Date:</strong>
                        <input type="date" name="start_working_date" class="form-control" value="{{ old('start_working_date', $user->start_working_date) }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Resignation Date:</strong>
                        <input type="date" name="resignation_date" class="form-control" value="{{ old('resignation_date', $user->resignation_date) }}">
                    </div>
                </div> 
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Profile Photo:</strong>
                        <input type="file" name="profile_photo" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Document:</strong>
                        <input type="file" name="document" class="form-control">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{$user->document}}</span>                        
                        </div>
                    </div>
                </div>
                                      
            </div>
        </div>
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2>Change Password</h2>
            <div class="row g-3">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Current Password:</strong>
                        {!! Form::password('current_password', array('placeholder' => 'Current Password','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>New Password:</strong>
                        {!! Form::password('password', array('placeholder' => 'New Password','class' => 'form-control')) !!}
                    </div>
                </div>                    
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 py-4">
            <a class="btn btn-primary px-4 py-2" href="{{ route('users.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
        </div>
    {!! Form::close() !!}

@endsection