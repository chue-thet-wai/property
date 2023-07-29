@extends('layouts.navbar')
@section('cardtitle')
<h4>Agent Management</h4>
@endsection

@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
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
    {!! Form::model($information,array('method'=>'PATCH','enctype'=>'multipart/form-data','route'=>['informations.update',$information->id])) !!}
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
            <h2>Main Agency Information</h2>
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Name <span class="required">*</span></strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Logo</strong>
                    {!! Form::file('logo', array('placeholder' => 'Logo','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Header</strong>
                    {!! Form::text('header', null, array('placeholder' => 'Header','class' => 'form-control mt-2')) !!}
                </div>
            </div> 
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Footer</strong>
                    {!! Form::text('footer', null, array('placeholder' => 'Footer','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Water Mark Text</strong>
                    {!! Form::text('watermark_txt', null, array('placeholder' => 'Wate Mark Text','class' => 'form-control mt-2')) !!}
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Water Mark Image</strong>
                    {!! Form::file('watermark_img', array('placeholder' => 'Water Mark Img','class' => 'form-control mt-2')) !!}
                    
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Default Property Image</strong>
                    {!! Form::file('default_img', array('placeholder' => 'Default Img','class' => 'form-control mt-2')) !!}
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-6">
                <div class="form-group">
                    <strong>Home Image</strong>
                    {!! Form::file('home_img', array('placeholder' => 'Home Img','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>About Us</strong>
                    {!! Form::textarea('about_us', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>About Us (MM)</strong>
                    {!! Form::textarea('about_us_mm', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Content</strong>
                    {!! Form::textarea('content', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Content (MM)</strong>
                    {!! Form::textarea('content_mm', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
            <h2>Contact Information</h2>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Phone</strong>
                    {!! Form::text('contact', null, array('class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Website</strong>
                    {!! Form::text('website', null, array('class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Viber</strong>
                    {!! Form::text('viber', null, array('class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Whatsapp</strong>
                    {!! Form::text('whatsapp', null, array('class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Facebook</strong>
                    {!! Form::text('facebook', null, array('class' => 'form-control mt-2')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Send Message</strong>
                    {!! Form::text('send_message', null, array('class' => 'form-control mt-2')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
            <h2>Address</h2>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Address</strong>
                    {!! Form::textarea('address', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Address (MM)</strong>
                    {!! Form::textarea('address_mm', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white px-4 py-5 rounded mb-2">
        <div class="row g-3">
            <h2>Other Informations</h2>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Footer Information</strong>
                    {!! Form::textarea('footer_info', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Developer Information</strong>
                    {!! Form::textarea('developer_info', null, array('class' => 'form-control mt-2','rows' => 4)) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 py-4">
        <a class="btn btn-primary px-4 py-2" href="{{ route('agents.index') }}"> Back</a>
    <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
    </div>
    {!! Form::close() !!}

@endsection