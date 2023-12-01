@php    
    $invoice_id = session()->get(INVOICE_INVOICEIDFILTER);
    $contract_date = session()->get(INVOICE_CONTRACTDATEFILTER);
    $rentout_date = session()->get(INVOICE_RENTOUTDATEFILTER);
    $type = session()->get(INVOICE_TYPEFILTER);
@endphp
@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row p-2">
        {!! Form::open(['method' => 'POST','route' => ['invoices.search']]) !!}
        <div class="row">      
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Type</strong>                     
                        {!! Form::select('type',$categories,$type ,array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>           
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Invoice ID</strong>                     
                        {!! Form::text('invoice_id', $invoice_id, array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Contract Date</strong>                     
                        {!! Form::date('contract_date', $contract_date ,array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Rent Out Date</strong>                     
                        {!! Form::date('rentout_date', $rentout_date ,array('placeholder' => '','class' => 'form-control mt-2')) !!}
                    </div>
                </div>       
            </div>
            <x-filter-btn resetRoute='invoices.search.reset' />
        {!! Form::close() !!}
    </div>
    <x-create-btn label="Create New Invoice" route="invoices"/>
    <x-table :maindata="$response['data']" :body="$response['invoices']" :headers="$response['headers']" routename="invoices" title="invoices"/>   
@endsection