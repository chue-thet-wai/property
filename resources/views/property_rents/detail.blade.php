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

    <div class="card">
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
                <a class="btn btn-primary px-4 py-2" href="{{ route('property_rents.index') }}"> Back</a>
            </div>
        </div>
        </div>
    </div>
@endsection