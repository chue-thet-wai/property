@extends('layouts.navbar')
@section('cardbody')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @foreach(Session::get('images') as $image)
            <img src="images/{{ $image['name'] }}" width="300px">
        @endforeach
    @endif

    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
  
            <div class="mb-3">                
                <label class="form-label" for="inputImage">Select Images:</label>
                <input 
                    type="file" 
                    name="images[]" 
                    id="inputImage"
                    multiple 
                    class="form-control @error('images') is-invalid @enderror">
  
                @error('images')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div id="drag-drop-area"></div>
   
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
       
        </form>       
    
@endsection


