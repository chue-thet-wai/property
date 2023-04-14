@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('properties.index')}}">{{ config('app.name') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>    
      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto ">
          <!-- <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('home') ? 'active' : '' }}"  aria-current="page" href="{{route('home')}}">Home</a>
          </li> -->
          
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('properties.*') ? 'active' : '' }}" href="{{route('properties.index')}}">Properties</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index')}}">Roles & Permissions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('posts.*') ? 'active' : '' }}" href="#">Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="#">Customer Enquiry</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('sales.*') ? 'active' : '' }}" href="#">Sale ( Sell / Rent )</a>            
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('systemlogs.*') ? 'active' : '' }}" href="#">System Log (staff performance log)</a>            
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('banners.*') ? 'active' : '' }}" href="{{ route('banners.index' )}}">Banners</a>     
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="#">Profile</a>     
          </li>
        </ul>
      </div>
    </div>
    </nav>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="container">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
                  @yield('cardbody')                        
              </div>
            </div>
        </div>
    </div>
@endsection