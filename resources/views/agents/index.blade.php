@extends('layouts.navbar')
@section('cardtitle')
  <h4>Agents Management</h4>
@endsection

@section('cardbody')
<x-create-btn label="Create New Agent" route="agents"/>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<div class="card card-xxl-stretch p-3">
  <div class="table-responsive">
      <table class="table table-bordered" id="table_id">
          <thead>
            <tr class="bg-primary text-white text-uppercase">
              <th class="text-nowrap">First Name</th>
              <th class="text-nowrap">Last Name</th>
              <th class="text-nowrap">Company Name</th>
              <th class="text-nowrap">Website</th>
              <th class="text-nowrap">Email</th>
              <th class="text-nowrap">Phone Number</th>
              <th class="text-nowrap">Address</th>
              <th class="text-nowrap" width="280px">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($data as $key => $agent)
            <tr class="">
              <td>{{ $agent->first_name }}</td>
              <td>{{ $agent->last_name }}</td>
              <td>{{ $agent->company_name }}</td>
              <td>{{ $agent->website }}</td>
              <td>{{ $agent->email }}</td>
              <td>{{ $agent->phone_no }}</td>
              <td>{{ $agent->address }}</td>
              <td class="text-nowrap">
                <a class="btn btn-action-dark px-3" href="{{ route('agents.edit',$agent->id) }}"> Edit</a>                
                {!! Form::open(['method' => 'DELETE','route' => ['agents.destroy', $agent->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-action-danger text-white px-3']) !!}
                  {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
          </tbody>
      </table>
  </div>
</div>

@endsection