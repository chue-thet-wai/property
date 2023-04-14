@extends('layouts.navbar')
@section('cardtitle')
  <h4>Users Management</h4>
@endsection

@section('cardbody')
<!-- <x-create-btn label="Create New User" route="users"/> -->


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>Name</th>
   <th>Email</th>
   <th>Contact No</th>
   <th>Township</th>
   <th>Address</th>
   <th width="280px">Action</th>
 </tr>

</table>


{!! $data->render() !!}

@endsection