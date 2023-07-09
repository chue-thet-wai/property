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
          <!-- <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('properties.*') ? 'active' : '' }}" href="{{route('properties.index')}}">Properties</a>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Property
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item {{ request()->routeIs('properties.*') ? 'active' : '' }}" href="{{route('properties.index')}}">Sale</a></li>
              <li><a class="dropdown-item" href="{{ route('property_rents.index') }}">Rent</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{route('customers.index')}}">Customers Enquiry</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('owners.*') ? 'active' : '' }}" href="{{route('owners.index')}}">Owners</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index')}}">Roles & Permissions</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('posts.*') ? 'active' : '' }}" href="#">Post</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('sales.*') ? 'active' : '' }}" href="#">Sale ( Sell / Rent )</a>            
          </li> -->
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('systemlogs.*') ? 'active' : '' }}" href="#">System Log (staff performance log)</a>            
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('banners.*') ? 'active' : '' }}" href="{{ route('banners.index' )}}">Banners</a>     
          </li> -->
          <!-- <li class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown button
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Setup
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="{{ route('divisions.index') }}">Division</a></li>
              <li><a class="dropdown-item" href="{{ route('townships.index') }}">Township</a></li>
              <li><a class="dropdown-item" href="{{ route('wards.index') }}">Ward</a></li>
              <li><a class="dropdown-item" href="{{ route('tenures.index') }}">Tenure Property</a></li>
              <li><a class="dropdown-item" href="{{ route('property_types.index') }}">Property Type</a></li>
              <li><a class="dropdown-item" href="{{ route('floors.index') }}">Floor</a></li>
            </ul>
          </li>
          
          <li class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              Profile
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="{{route('profile.index')}}">My Account</a></li>
              <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </a>     
              </li>
            </ul>
          </li>    
          
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                      <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a>
                    @endif
                @endforeach
              </div>
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