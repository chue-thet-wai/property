@extends('layouts.navbar')
@section('cardtitle')
<h4>Role Management</h4>
@endsection
@section('cardbody')

<x-create-btn label="Create New Role" route="roles"/>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="card card-xxl-stretch">
    <div class="table-responsive">
        <table class="table table-bordered" id="kt_table_widget_1">
            <thead>
                <tr class="text-start bg-primary text-white text-uppercase">
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        
                        @can('role-edit')
                            <a class="btn btn-primary px-4 py-2" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection