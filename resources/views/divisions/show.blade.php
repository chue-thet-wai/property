@extends('layouts.navbar')
@section('cardbody')
    <div class="show_table">
        <div class="card">
            
            <div class="card-body">
                <div class="card-title">
                    {{$division->division}}
                </div>
                <div class="row">
                    @foreach($division->township as $township)
                        <div class="col-sm-12 col-md-3 col-lg-3">{{$township->township}}</div>
                    @endforeach
                </div>                
            </div>
        </div>
    </div>
@endsection