@extends('layouts.master')

@section('content')
<div class="osahan-account">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <h5 class="fw-bold m-0">My Account</h5>
        </div>
    </div>
    <div class="p-4 profile text-center border-bottom">
        <img src="{{asset('img/logo.png')}}" class="w-25 img-fluid rounded-pill">
        <h6 class="fw-bold m-0 mt-2">{{Auth::user()->name}}</h6>
        <p class="small text-muted">{{Auth::user()->email}}</p>
        <a disabled class="btn btn-success btn-sm"><i class="icofont-pencil-alt-5"></i> Edit Profile</a>
    </div>
    <div class="account-sections">
        <ul class="list-group">
            <!-- <a href="promos.html" class="text-decoration-none text-dark">
                <li class="border-bottom bg-white d-flex align-items-center p-3">
                    <i class="icofont-sale-discount osahan-icofont bg-success"></i>Promos
                    <span class="badge badge-success p-1 badge-pill ms-auto"><i class="icofont-simple-right"></i></span>
                </li>
            </a>
            <a href="my_address.html" class="text-decoration-none text-dark">
                <li class="border-bottom bg-white d-flex align-items-center p-3">
                    <i class="icofont-address-book osahan-icofont bg-dark"></i>My Address
                    <span class="badge badge-success p-1 badge-pill ms-auto"><i class="icofont-simple-right"></i></span>
                </li>
            </a> -->
            <a disabled class="text-decoration-none text-dark">
                <li class="border-bottom bg-white d-flex align-items-center p-3">
                    <i class="icofont-info-circle osahan-icofont bg-primary"></i>Terms, Privacy & Policy
                    <span class="badge badge-success p-1 badge-pill ms-auto"><i class="icofont-simple-right"></i></span>
                </li>
            </a>
            <a disabledclass="text-decoration-none text-dark">
                <li class="border-bottom bg-white d-flex align-items-center p-3">
                    <i class="icofont-phone osahan-icofont bg-warning"></i>Help & Support
                    <span class="badge badge-success p-1 badge-pill ms-auto"><i class="icofont-simple-right"></i></span>
                </li>
            </a>
            <a href="{{ route('logout') }}" class="text-decoration-none text-dark">
                <li class="border-bottom bg-white d-flex  align-items-center p-3">
                    <i class="icofont-lock osahan-icofont bg-danger"></i> Logout
                </li>
            </a>
        </ul>
    </div>
</div>
@endsection
