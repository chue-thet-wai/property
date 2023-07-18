@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @foreach ($errors->all() as $error)
        <x-alert type="danger" message="{{$error}}" />
    @endforeach
    {!! Form::open(array('route' => 'properties.store','method'=>'POST','enctype'=>'multipart/form-data','id'=>'frm-property')) !!}
        
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Owner Info</h2>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Owner: <span class="required">*</span></strong>
                        {!! Form::text('owner', null, array('placeholder' => 'Type Owner Name','class' => 'form-control mt-2','id'=>'owner', 'required')) !!}
                        {!! Form::hidden('owner_id', null, array('class' => 'form-control','id'=>'owner_id')) !!}
                    </div>
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Owner Contact: <span class="required">*</span></strong>
                        {!! Form::text('phonenumber', null, array('class' => 'form-control mt-2','id'=>'phonenumber', 'required')) !!}
                    </div>
                </div> 
            </div>

        </div>

        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Property Info</h2>

            <div class="row g-3">
                
                <div class="col-md-6">
                    <div class="form-group">
                        <strong> {{__('messages.title')}}: <span class="required">*</span></strong>
                        {!! Form::text('title', null, array('placeholder' => 'Type Title','class' => 'form-control mt-2', 'required')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong> {{__('messages.title')}} (mm): <span class="required">*</span></strong>
                        {!! Form::text('title_mm', null, array('placeholder' => 'Type Title','class' => 'form-control mt-2', 'required')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Status: <span class="required">*</span></strong>
                        {!! Form::select('status', $status, null, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'required')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Price: <span class="required">*</span></strong>
                        {!! Form::number('price', null, array('placeholder' => 'Type Price','class' => 'form-control mt-2', 'required','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Promotion Price:</strong>
                        {!! Form::number('promotion_price', null, array('placeholder' => 'Type Promotion Price','class' => 'form-control mt-2','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>{{__('messages.description')}}:</strong>
                        {!! Form::textarea('description', null, array('placeholder' => 'Type description','class' => 'form-control mt-2', 'rows' => 3)) !!}
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>{{__('messages.description')}} (mm):</strong>
                        {!! Form::textarea('description_mm', null, array('placeholder' => 'Type description','class' => 'form-control mt-2', 'rows' => 3)) !!}
                    </div>
                </div> 
                <div class="col-md-2">
                    <div class="form-group">
                        <strong>Bank Loan:</strong>
                        {{ Form::checkbox('bank_loan') }}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <strong>Public Status:</strong>
                        {{ Form::checkbox('public_status') }}
                    </div>
                </div>

            </div>
        
        </div>  

        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Address</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Division: <span class="required">*</span></strong>
                        {!! Form::select('division', $setup['divisions'], null, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'id' => 'division-dropdown', 'required')) !!}
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Township: <span class="required">*</span></strong>
                        {!! Form::select('township', [], null, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'id' => 'township-dropdown', 'required')) !!}
                        <!-- <select id="township-dropdown" class="form-control">
                        </select> -->
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Ward: <span class="required">*</span></strong>
                        {!! Form::select('ward', [], null, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'id' => 'ward-dropdown', 'required')) !!}
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Postal Code:</strong>
                        {!! Form::text('postal_code', null, array('placeholder' => 'Type Postal Code','class' => 'form-control mt-2')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Google Map URL:</strong>
                        {!! Form::textarea('google_map_url', null, array('placeholder' => 'Type Google Map URL','class' => 'form-control mt-2', 'rows' => 3)) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Detail Address:</strong>
                        {!! Form::textarea('detail_address', null, array('placeholder' => 'Type Detail Address','class' => 'form-control mt-2', 'rows' => 3)) !!}
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Property Area</h2>

            <div class="row g-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Front Area: <span class="required">*</span></strong>
                        {!! Form::number('front_area', null, array('placeholder' => 'Type Front Area','class' => 'form-control','id'=>'front-area','required','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Side Area: <span class="required">*</span></strong>
                        {!! Form::number('side_area', null, array('placeholder' => 'Type Side Area','class' => 'form-control','id'=>'side-area','required','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Square Feet: <span class="required">*</span></strong>
                        {!! Form::number('square_feet', null, array('placeholder' => 'Type Square Feet','class' => 'form-control','id'=>'square-feet','required','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Acre: <span class="required">*</span></strong>
                        {!! Form::number('acre', null, array('placeholder' => 'Type acre','class' => 'form-control','id'=>'acre','required','min'=>0,'step'=>'any')) !!}
                    </div>
                </div>
            </div>

        </div>
     
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Property Detail</h2>

            <div class="row g-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Tenure Property: <span class="required">*</span></strong>
                        {!! Form::select('tenure_property', $setup['tenures'], null, array('placeholder' => 'Choose...','class' => 'form-control mt-2')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Property Type: <span class="required">*</span></strong>
                        {!! Form::select('property_type', $setup['propertytypes'], null, array('placeholder' => 'Choose...','class' => 'form-control mt-2', 'required')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Floor: <span class="required">*</span></strong>
                        {!! Form::select('floor[]', $setup['floors'], null, array('class' => 'form-control mt-2 selectpicker','multiple','data-live-search'=>'true')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Build Year:</strong>
                        {!! Form::selectRange('build_year', date('Y'), (date('Y') - 60)+ 10, null, ['class' => 'form-control mt-2', 'placeholder' => 'Select a Build Year']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Master Bedroom:</strong>
                        {!! Form::number('master_bedroom', null, array('placeholder' => 'Type Master Bedroom','class' => 'form-control mt-2','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Common Room:</strong>
                        {!! Form::number('common_room', null, array('placeholder' => 'Type Common Room','class' => 'form-control mt-2','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Bathroom:</strong>
                        {!! Form::number('bathroom', null, array('placeholder' => 'Type Bathroom','class' => 'form-control mt-2','min'=>0)) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Building Facility:</strong>
                        {!! Form::textarea('building_facility', null, array('placeholder' => 'Type Building Facility','class' => 'form-control mt-2', 'rows' => 3)) !!}
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Special Features:</strong>
                        {!! Form::textarea('special_features', null, array('placeholder' => 'Type Special Features','class' => 'form-control mt-2', 'rows' => 3)) !!}
                    </div>
                </div> 
            </div>

        </div>
    
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Photos / Documents</h2>

            <div class="row g-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Feature Photo: <span class="required">*</span></strong>
                        {!! Form::file('feature_photo', array('placeholder' => 'Type Feature Photo','class' => 'form-control mt-2', 'required')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Other Photo: <span class="required">*</span></strong>
                        {!! Form::file('other_photo[]', array('placeholder' => 'Type Other Photo','class' => 'form-control mt-2', 'multiple' => 'multiple', 'required')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Confidential Documents: <span class="required">*</span></strong>
                        {!! Form::file('confidential_documents[]', array('placeholder' => 'Type Confidential Documents','class' => 'form-control mt-2', 'multiple' => 'multiple', 'required')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>View Count:</strong>
                        {!! Form::number('view_count', null, ['placeholder'=>'Type View Count','class' => 'form-control mt-2']) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Remark :</strong>
                        {!! Form::textarea('remark', null, array('placeholder' => 'Type Special Features','class' => 'form-control mt-2', 'rows' => 3)) !!}
                    </div>
                </div> 
            </div>
        
        </div> 
            
        <div class="col-md-12 py-4">
            <a class="btn btn-primary px-4 py-2" href="{{ route('properties.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary px-4 py-2">Save</button>
        </div>
        
    {!! Form::close() !!}
@endsection