@extends('layouts.navbar')
@section('cardtitle')
  <h4>Users Management</h4>
@endsection
@section('cardbody')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
@php
  $name = session()->get(USER_NAMEFILTER);
  $phonenumber = session()->get(USER_PHONEFILTER);
@endphp
{!! Form::open(['method' => 'POST','route' => ['users.search']]) !!}
<div class="row">          
  <div class="col-xs-3 col-sm-3 col-md-3">
      <div class="form-group">
          <strong>Name</strong>                     
          {!! Form::text('name', $name, array('placeholder' => '','class' => 'form-control mt-2')) !!}
      </div>
  </div>
  <div class="col-xs-3 col-sm-3 col-md-3">
      <div class="form-group">
          <strong>Phone Number</strong>                     
          {!! Form::text('phonenumber', $phonenumber, array('placeholder' => '','class' => 'form-control mt-2')) !!}
      </div>
  </div>
</div>
<x-filter-btn resetRoute="users.search.reset"/>
{!! Form::close() !!}
<x-create-btn label="Create New User" route="users"/>
<div class="card card-xxl-stretch p-3">
  <div class="table-responsive table-scroll">
      <table class="table table-bordered table-scroll" id="table_id">
          <thead>
            <tr class="bg-primary text-white text-uppercase">
              <th class="text-nowrap">First Name</th>
              <th class="text-nowrap">Last Name</th>
              <th class="text-nowrap">User Name</th>
              <th class="text-nowrap">Email</th>
              <th class="text-nowrap">Department</th>
              <th class="text-nowrap">Phone Number</th>
              <th class="text-nowrap">Start Working Date</th>
              <th class="text-nowrap">Resignation Date</th>
              <th class="text-nowrap">Status</th>
              <th class="text-nowrap" width="280px">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($data as $key => $user)
            <tr>
              <td>{{ $user->first_name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if(!empty($roles) && count($roles) > 0)
                  @foreach($roles as $v)
                    <label class="badge badge-success bg-warning text-dark">{{ $v }}</label>
                  @endforeach
                @endif
              </td>
              <td>{{ $user->phone_no }}</td>
              <td>{{ $user->start_working_date }}</td>
              <td>{{ $user->resignation_date }}</td>
              <td class="fw-bold @if($user->status == 1) text-success @else text-danger @endif">{{ $user->status == 1 ? 'Active' : 'Disabled' }}</td>              
              <td class="text-nowrap">
                <a class="btn btn-action-dark px-3" href="{{ route('users.edit',$user->id) }}"> Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-action-danger text-white px-3']) !!}
                {!! Form::close() !!}
                {!! Form::open(['method' => 'POST','route' => ['users.disabled', $user->id],'style'=>'display:inline']) !!}
                  {!! Form::submit($user->status == 1 ? 'Disabled' : 'Activate', ['class' => 'btn btn-action-danger text-white px-3']) !!}
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
  </div>
</div>

@endsection