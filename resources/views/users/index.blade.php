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
<div class="card card-xxl-stretch">
  <div class="table-responsive">
      <table class="table table-bordered" id="table_id">
          <thead>
            <tr class="text-start bg-primary text-white text-uppercase">
              <th>Name</th>
              <th>Email</th>
              <th>Roles</th>
              <th width="280px">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($data as $key => $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if(!empty($user->getRoleNames()))
                  @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success bg-warning text-dark">{{ $v }}</label>
                  @endforeach
                @endif
              </td>
              <td>
                <a class="px-3 btn btn-primary" href="{{ route('users.edit',$user->id) }}"> Edit</a>    
                
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
  </div>
</div>

@endsection