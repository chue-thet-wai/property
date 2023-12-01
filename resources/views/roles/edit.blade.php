@extends('layouts.navbar')
@section('cardtitle')
    <h4>Role Management</h4>
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


{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br />
            <strong>Permission:</strong>
            <div class="row g-4 ms-1" style="display: flex;overflow-x: auto;">
                <table cellpadding="0" cellspacing="0" class="datatable table table-striped table-bordered" style="text-align:center;">
                    <thead style="background-color: #212529 !important;color: #fff;vertical-align: middle !important;">
                        <tr>
                            <th rowspan='2' style="width:10%;">Menu</th>
                            <th colspan='5'>Actions</th>
                        </tr>
                        <tr>
                            <th style="width:5%;">List</th>
                            <th style="width:5%;">Create</th>
                            <th style="width:5%;">View</th>
                            <th style="width:5%;">Edit</th>
                            <th style="width:5%;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($menu) && $menu->count())
                            @foreach($menu as $value)
                            <tr>
                                <td style="text-align: left;padding-left: 2%;"><label>{{ $value->sub_menu }}</label></td>
                                <td>
                                    @if (array_key_exists("list",$permission[$value->id]))
                                        {{ 
                                            Form::checkbox('permission[]', $permission[$value->id]['list'], 
                                            in_array($permission[$value->id]['list'], $rolepermissions), 
                                            array('class' => 'name')) 
                                        }}
                                    @endif
                                </td>
                                <td>
                                    @if (array_key_exists("create",$permission[$value->id]))
                                        {{ 
                                            Form::checkbox('permission[]', $permission[$value->id]['create'], 
                                            in_array($permission[$value->id]['create'], $rolepermissions), 
                                            array('class' => 'name')) 
                                        }}
                                    @endif
                                </td>
                                <td>
                                    @if (array_key_exists("view",$permission[$value->id]))
                                        {{ 
                                            Form::checkbox('permission[]', $permission[$value->id]['view'], 
                                            in_array($permission[$value->id]['view'], $rolepermissions), 
                                            array('class' => 'name')) 
                                        }}
                                    @endif
                                </td>
                                <td>
                                    @if (array_key_exists("edit",$permission[$value->id]))
                                        {{ 
                                            Form::checkbox('permission[]', $permission[$value->id]['edit'], 
                                            in_array($permission[$value->id]['edit'], $rolepermissions), 
                                            array('class' => 'name')) 
                                        }}
                                    @endif
                                </td>
                                <td>
                                    @if (array_key_exists("delete",$permission[$value->id]))
                                        {{ 
                                            Form::checkbox('permission[]', $permission[$value->id]['delete'], 
                                            in_array($permission[$value->id]['delete'], $rolepermissions), 
                                            array('class' => 'name')) 
                                        }}
                                    @endif
                                </td>                               
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="8">There are no data.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary px-4 py-2" href="{{ route('roles.index') }}"> Back</a>
        <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection