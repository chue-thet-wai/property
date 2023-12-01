@extends('layouts.navbar')
@section('cardtitle')
  <h4> Main Agency Informations Management</h4>
@endsection

@section('cardbody')
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
@php
  $name = session()->get(AGENCYINFO_NAMEFILTER);
  $phonenumber= session()->get(AGENCYINFO_PHONEFILTER);
@endphp
{!! Form::open(['method' => 'POST','route' => ['informations.search']]) !!}
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
<x-filter-btn resetRoute='informations.search.reset' />
{!! Form::close() !!}
<x-create-btn label="Create New Agency Information" route="informations"/>
<x-table :maindata="$response['data']" :body="$response['informations']" :headers="$response['headers']" routename="informations" title="Main Agency Information"/>  
@endsection