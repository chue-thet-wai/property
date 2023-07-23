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
            <a class="nav-link mx-2 {{ request()->routeIs('invoices.*') ? 'active' : '' }}" href="{{route('invoices.index')}}">Invoice</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{route('customers.index')}}">Customers Enquiry</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('owners.*') ? 'active' : '' }}" href="{{route('owners.index')}}">Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('agents.*') ? 'active' : '' }}" href="{{ route('agents.index') }}">Agents</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index')}}">Roles & Permissions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 {{ request()->routeIs('systemlogs.*') ? 'active' : '' }}" href="#">System Log (staff performance log)</a>            
          </li>
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