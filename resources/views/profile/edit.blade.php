@extends('layouts.master')

@section('content')
<div class="osahan-profle">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="my_account.html">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">Profile</h6>
        </div>
    </div>
</div>
<div id="edit_profile">
    <div class="p-4 profile text-center border-bottom">
        <img src="{{asset('img/logo.png')}}" class="w-25 img-fluid rounded-pill">
        <h6 class="fw-bold m-0 mt-2">{{Auth::user()->name}}</h6>
        <p class="small text-muted m-0">{{Auth::user()->email}}</p>
    </div>
    <div class="p-3">
        <form action="{{route('update.profile')}}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group mb-3">
                <label for="exampleInputName1">Full Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName1" value="{{@Auth::user()->name}}">
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputNumber1">Mobile Number</label>
                <input type="number" name="phone" class="form-control" id="exampleInputNumber1" value="{{@Auth::user()->phone}}" required>
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->email}}" readonly>
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="text-center d-grid mt-5">
                <button type="submit" class="btn btn-success btn-lg">Save Changes</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
