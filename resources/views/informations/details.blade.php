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
        <h2 class="mb-4 fw-bolder">Main Agency Info</h2>

        <div class="row g-3">
            <div class="col-md-6">                
                <strong>Agency Name</strong>
                <div>{{ $information->name }}</div>    
            </div> 
            <div class="col-md-6">                
                <strong>Wate Mark Text</strong>
                <div>{{ $information->watermark_txt }}</div>    
            </div>             
            <div class="col-md-6">                
                <strong>Content</strong>
                <div>{{ $information->content }}</div>    
            </div> 
            <div class="col-md-6">                
                <strong>Content (MM)</strong>
                <div>{{ $information->content_mm }}</div>    
            </div> 
            <div class="col-md-6">                
                <strong>About Us</strong>
                <div>{{ $information->about_us }}</div>    
            </div> 
            <div class="col-md-6">                
                <strong>About Us(MM)</strong>
                <div>{{ $information->about_us_mm }}</div>    
            </div> 
        </div>

    </div>

    <div class="bg-white px-4 py-5 rounded mb-2">
        <h2 class="mb-4 fw-bolder">Contact</h2>
        <div class="row g-3">
            <div class="col-md-4">                
                <strong>Phone Number</strong>
                <div>{{ $information->contact }}</div>    
            </div> 
            <div class="col-md-4">                
                <strong>Email</strong>
                <div>{{ $information->email }}</div>    
            </div> 
            <div class="col-md-4">                
                <strong>Viber</strong>
                <div>{{ $information->viber }}</div>    
            </div> 
            <div class="col-md-4">                
                <strong>Whatsapp</strong>
                <div>{{ $information->whatsapp }}</div>    
            </div> 
            <div class="col-md-4">                
                <strong>Facebook</strong>
                <div>{{ $information->facebook }}</div>
            </div> 
            <div class="col-md-4">                
                <strong>Send Message</strong>
                <div>{{ $information->send_message }}</div>    
            </div> 
        </div>
    </div>
     
    <div class="gap-2">
        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Address</h2>
            <div class="row g-3">
                <div class="col-md-6">                    
                    <strong>Address</strong>
                    <div>{{ $information->address }}</div>        
                </div>
                <div class="col-md-6">                    
                    <strong>Address (MM)</strong>
                    <div>{{ $information->address_mm }}</div>        
                </div>
            </div>
        </div>

        <div class="bg-white px-4 py-5 rounded mb-2">
            <h2 class="mb-4 fw-bolder">Logo / Photos</h2>

            <div class="row g-3">    
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Logo:</strong>
                        <div class="featurePhotoBox w-50">
                            <img src="{{ asset('thumbnails/information-logos/'. $information->logo) }}" alt="logo">
                        </div>
                    </div>
                </div> 
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Wate Mark Image</strong>
                        <div class="featurePhotoBox w-50">
                            <img src="{{ asset('thumbnails/information-watermark-imgs/'. $information->watermark_img) }}" alt="logo">
                        </div>
                    </div>
                </div>             
                <div class="col-md-3">                    
                    <div class="form-group">
                        <strong>Default Photo:</strong>
                        <div class="featurePhotoBox w-50">
                            <img src="{{ asset('thumbnails/information-default-imgs/'. $information->default_img) }}" alt="default img">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Home Photo:</strong>
                        <div class="featurePhotoBox w-50">
                            <img src="{{ asset('thumbnails/information-home-imgs/'. $information->home_img) }}" alt="home img">
                        </div>
                    </div>
                </div>
                                
            </div>
        
        </div> 
    </div>

    <div id="zoom-modal" class="modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-body">
                <img id="zoomed-image" src="" alt="Zoomed Image">
            </div>
            </div>
        </div>
    </div>
@endsection