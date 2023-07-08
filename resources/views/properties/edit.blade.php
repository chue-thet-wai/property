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
        
        {!! Form::model($response['property'], array('method' => 'PATCH','route' => ['properties.update', $response['property']->id],'enctype'=>'multipart/form-data')) !!}
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Title: <span class="required">*</span></strong>
                    {!! Form::text('title', null, array('placeholder' => 'Type Title','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Category: <span class="required">*</span></strong>
                    {!! Form::select('category', $categories, null, array('placeholder' => 'Choose...','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Property Type: <span class="required">*</span></strong>
                    {!! Form::select('protype', $protypes,null, array('placeholder' => 'Choose...','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Squarefeet: <span class="required">*</span></strong>
                    {!! Form::text('squarefeet', null, array('placeholder' => 'Type Squarefeet','class' => 'form-control')) !!}
                </div>
            </div>        
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Price: <span class="required">*</span></strong>
                    {!! Form::number('price', null, array('placeholder' => 'Type Price','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Story: <span class="required">*</span></strong>
                    {!! Form::text('story', null, array('placeholder' => 'Type Story','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Bedroom: <span class="required">*</span></strong>
                    {!! Form::number('bedroom', null, array('placeholder' => 'Type Bedroom','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Bathroom: <span class="required">*</span></strong>
                    {!! Form::number('bathroom', null, array('placeholder' => 'Type Bathroom','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Feature: <span class="required">*</span></strong>
                    {!! Form::select('feature', $features, null, ['placeholder'=>'Choose...','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Outside/Inside Space: <span class="required">*</span></strong>
                    {!! Form::text('outinspace', null, array('placeholder' => 'Type Space','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Amenities: <span class="required">*</span></strong>
                    {!! Form::text('amenities', null, array('placeholder' => 'Type Amenities','class' => 'form-control')) !!}
                </div>
            </div>  
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Available Date: <span class="required">*</span></strong>
                    {!! Form::date('availabledate', null, array('placeholder' => '','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Property Name: <span class="required">*</span></strong>
                    {!! Form::text('proname', null, array('placeholder' => 'Type Property Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Floor Area: <span class="required">*</span></strong>
                    {!! Form::text('area', null, array('placeholder' => 'Type Area','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Condition: <span class="required">*</span></strong>
                    {!! Form::text('condition', null, array('placeholder' => 'Type Condition','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Developer: <span class="required">*</span></strong>
                    {!! Form::text('developer', null, array('placeholder' => 'Type Developer','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Tenure: <span class="required">*</span></strong>
                    {!! Form::text('tenure', null, array('placeholder' => 'Type Tenure','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Builtyear: <span class="required">*</span></strong>
                    {!! Form::number('builtyear', null, array('placeholder' => 'Type Builtyear','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Location: <span class="required">*</span></strong>
                    {!! Form::text('location', null, array('placeholder' => 'Type Location','class' => 'form-control','id'=>'location')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Postalcode: <span class="required">*</span></strong>
                    {!! Form::text('postalcode', null, array('placeholder' => 'Type Postalcode','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Address: <span class="required">*</span></strong>
                    {!! Form::textarea('address', null, array('placeholder' => 'Type Address','class' => 'form-control')) !!}
                </div>
            </div>        
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Accessories:</strong>
                    {!! Form::textarea('accessories', null, array('placeholder' => 'Type Accessories','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Decoration:</strong>
                    {!! Form::textarea('decoration', null, array('placeholder' => 'Type Decoration','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Description:</strong>
                    {!! Form::textarea('description', null, array('placeholder' => 'Type description','class' => 'form-control')) !!}
                </div>
            </div> 
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Images:</strong>
                    <input 
                        type="file" 
                        name="images[]" 
                        id="inputImage"
                        multiple 
                        class="form-control">
                </div>
            </div>  
            <div class="row member-preview my-4">
            </div>   
            <div class="row my-4">
                @foreach($response['images'] as $row)
                    <div class="col-sm-2 col-xs-2 col-md-2 imagePreview">                        
                        <img src="{{ asset('property_images/'.$row->image) }}" />    
                        <span class="img-delete" data-id="{{$row->id}}"><i class="fa-solid fa-circle-xmark"></i></span>                    
                    </div>
                @endforeach
            </div>     
            <div class="col-xs-12 col-sm-12 col-md-12 py-4">
                <a class="btn btn-primary" href="{{ route('properties.index') }}"> Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    @endsection