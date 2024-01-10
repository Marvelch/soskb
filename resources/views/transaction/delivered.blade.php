@extends('layouts.master')

@section('content')
<div class="osahan-help-ticket">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('home')}}">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">Transactions</h6>
        </div>
    </div>
</div>
<div class="osahan-order">
    <div class="order-menu mt-4">
        <div class="row m-0 text-center">
            <div class="col pb-2 border-bottom">
                <a href="{{route('on_progress_transaction')}}" class="text-muted text-decoration-none">On Progress</a>
            </div>
            <div class="col pb-2 border-bottom">
                <a href="{{route('complete_transaction')}}" class="text-muted text-decoration-none ">Completed</a>
            </div>
            <div class="col pb-2 border-bottom">
                <a href="{{route('canceled_transaction')}}" class="text-muted text-decoration-none">Canceled</a>
            </div>
            <div class="col pb-2 border-success border-bottom">
                <a href="{{route('delivered_transaction')}}" class="text-success fw-bold text-decoration-none">Delivered</a>
            </div>
        </div>
    </div>
    <div class="order-body p-3">
        <div class="pb-3">

        </div>
    </div>
</div>
@endsection
