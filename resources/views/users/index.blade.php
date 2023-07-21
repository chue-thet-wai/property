@extends('layouts.navbar')
@section('cardtitle')
  <h4>Users Management</h4>
@endsection

@section('cardbody')
<x-create-btn label="Create New User" route="users"/>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<div class="card card-xxl-stretch p-3">
  <div class="table-responsive">
      <table class="table table-bordered" id="table_id">
          <thead>
            <tr class="text-center bg-primary text-white text-uppercase">
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
            <tr class="text-center">
              <td>{{ $user->first_name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if(!empty($user->getRoleNames()))
                  @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success bg-warning text-dark">{{ $v }}</label>
                  @endforeach
                @endif
              </td>
              <td>{{ $user->phone_no }}</td>
              <td>{{ $user->start_working_date }}</td>
              <td>{{ $user->resignation_date }}</td>
              <td class="fw-bold @if($user->status == 1) text-success @else text-danger @endif">{{ $user->status == 1 ? 'Active' : 'Disabled' }}</td>              
              <td class="text-nowrap">
                <a class="px-3 btn btn-primary" href="{{ route('users.edit',$user->id) }}"> Edit</a>    
                
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
                {!! Form::open(['method' => 'POST','route' => ['users.disabled', $user->id],'style'=>'display:inline']) !!}
                  {!! Form::submit($user->status == 1 ? 'Disabled' : 'Activate', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
  </div>
</div>

@endsection