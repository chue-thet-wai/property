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

    <div class="bg-white px-4 py-5 rounded mb-2">
        <h2 class="mb-4 fw-bolder">Owner Info</h2>

        <div class="row g-3">
            <div class="col-md-4">
                
                <strong>Owner:</strong>
                <div>{{ $response['property']->owner->name }}</div>
    
            </div> 
            <div class="col-md-4">
                
                <strong>Owner Contact:</strong>
                <div>{{ $response['property']->owner->phonenumber }}</div>
    
            </div> 
            <div class="col-md-4">
                
                <strong>Owner Email:</strong>
                <div>{{ $response['property']->owner->email }}</div>
    
            </div> 
        </div>

    </div>

    <div class="d-flex gap-2">
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Property Info</h2>

            <div class="row g-3">
                
                <div class="col-md-6">
                    
                    <strong>{{__('messages.title')}}:</strong>
                    <div>{{ $response['property']->title }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>{{__('messages.title')}} (mm):</strong>
                    <div>{{ $response['property']->title_mm }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Price:</strong>
                    <div>{{ $response['property']->price }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Promotion Price:</strong>
                    <div>{{ $response['property']->promotion_price }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>{{__('messages.description')}}:</strong>
                    <div>{{ $response['property']->description }}</div>
        
                </div> 
                <div class="col-md-6">
                    
                    <strong>{{__('messages.description')}} (mm):</strong>
                    <div>{{ $response['property']->description_mm }}</div>
        
                </div> 
                <div class="col-md-6">
                    
                    <strong>Status:</strong>
                    <div>{{ $status[$response['property']->status] }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Bank Loan:</strong>
                    <div>{{ ($response['property']->bank_loan == 1) ? 'Yes' : 'No'  }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Public Status:</strong>
                    <div>{{ ($response['property']->public_status == 1) ? 'Yes' : 'No'  }}</div>
        
                </div>

            </div>
        
        </div> 

        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Address</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    
                    <strong>Division:</strong>
                    <div>{{ $setup['divisions'][$response['property']->division] }}</div>
                    
        
                </div> 
                <div class="col-md-6">
                    
                    <strong>Township:</strong>
                    <div>{{ (isset($setup['township'][$response['property']->township])) ? $setup['township'][$response['property']->township] : '' }}</div>
        
                </div> 
                <div class="col-md-6">
                    
                    <strong>Ward:</strong>
                    <div>{{ (isset($setup['ward'][$response['property']->ward])) ? $setup['ward'][$response['property']->ward] : '' }}</div>
        
                </div> 
                <div class="col-md-6">
                    
                    <strong>Postal Code:</strong>
                    <div>{{ $response['property']->postal_code }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Google Map URL:</strong>
                    <div>{{ $response['property']->google_map_url }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Detail Address:</strong>
                    <div>{{ $response['property']->detail_address }}</div>
        
                </div>
            </div>

        </div>
    </div>

    <div class="bg-white px-4 py-5 rounded mb-2">
        <h2 class="mb-4 fw-bolder">Property Area</h2>

        <div class="row g-3">
            <div class="col-md-3">
                
                <strong>Front Area:</strong>
                <div>{{ $response['property']->front_area }}</div>
    
            </div>
            <div class="col-md-3">
                
                <strong>Side Area:</strong>
                <div>{{ $response['property']->side_area }}</div>
    
            </div>
            <div class="col-md-3">
                
                <strong>Square Feet:</strong>
                <div>{{ $response['property']->square_feet }}</div>
    
            </div>
            <div class="col-md-3">
                
                <strong>Acre:</strong>
                <div>{{ $response['property']->acre }}</div>
    
            </div>
        </div>

    </div>
     
    <div class="d-flex gap-2">
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Property Detail</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    
                    <strong>Tenure Property:</strong>
                    <div>{{ $setup['tenures'][$response['property']->tenure_property] }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Property Type:</strong>
                    <div>{{ $setup['propertytypes'][$response['property']->property_type] }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Floor:</strong>
                    <div>{{ $setup['floors'][$response['property']->floor] }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Build Year:</strong>
                    <div>{{ $response['property']->build_year }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Master Bedroom:</strong>
                    <div>{{ $response['property']->master_bedroom }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Common Room:</strong>
                    <div>{{ $response['property']->common_room }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Bathroom:</strong>
                    <div>{{ $response['property']->bathroom }}</div>
        
                </div>
                <div class="col-md-6">
                    
                    <strong>Building Facility:</strong>
                    <div>{{ $response['property']->building_facility }}</div>
        
                </div> 
                <div class="col-md-6">
                    
                    <strong>Special Features:</strong>
                    <div>{{ $response['property']->special_features }}</div>
        
                </div> 
            </div>

        </div>

        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Photos / Documents</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    <strong>View Count:</strong>
                    <div>{{ $response['property']->view_count }}</div>
                </div>
                <div class="col-md-6">
                    <strong>Remark :</strong>
                    <div>{{ $response['property']->remark }}</div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Feature Photo:</strong>
                        <div class="featurePhotoBox">
                            <img src="{{ asset('storage/feature_images/'. $response['property']->feature_photo) }}" alt="feature_image">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Other Photo:</strong>
                        
                            <div class="otherPhotoBox d-flex gap-1 flex-wrap">
                                @foreach ($response['images'] as $photo)
                                    <div class="position-relative mb-1 ">
                                        <img class="showImage" src="{{ asset('storage/property_images/'. $photo->image) }}" alt="other_image">
                                    </div>
                                @endforeach
                            </div> 
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Confidential Documents:</strong>
                        
                            <div class="documentsBox d-flex flex-column gap-2">
                                @foreach ($response['document'] as $document)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{$document->confidential_documents}}</span>
                                        <!-- <i class="fa-solid fa-circle-xmark doc-delete-icon" data-id="{{$document->id}}"></i> -->
                                    </div>
                                 @endforeach
                            </div> 
                       
                    </div>
                </div>
                 
            </div>
        
        </div> 
    </div>

    <!-- <div class="card">
        <div class="card-header">Property Details</div>
        <div class="card-body">
        <div class="row">
        @foreach($response['property'] as $key=>$value)
            <div class="col-xs-6 col-sm-6 col-md-6">
                @if($key == 'Property Type')
                    <strong class="detail-label">{{$key}}</strong> 
                    <p>{{$protypes[$value]? : ''}}<p> 
                @elseif($key == 'Category')
                    <strong class="detail-label">{{$key}}</strong> 
                    <p>{{$categories[$value]}}<p> 
                @elseif($key == 'Feature')
                    <strong class="detail-label">{{$key}}</strong> 
                    <p>{{$features[$value]}}<p> 
                @else
                    <strong class="detail-label">{{$key}}</strong> 
                    <p>{{$value}}<p> 
                @endif      
            </div> 
        @endforeach 
        <div class="row my-4">
            @foreach($response['images'] as $row)
                <div class="col-sm-2 col-xs-2 col-md-4 detail-imagePreview">                        
                    <img src="{{ asset('property_images/'.$row->image) }}" />                               
                </div>
            @endforeach
        </div>             
            <div class="col-xs-12 col-sm-12 col-md-12 py-4">
                <a class="btn btn-primary px-4 py-2" href="{{ route('properties.index') }}"> Back</a>
            </div>
        </div>
        </div>
    </div> -->
@endsection