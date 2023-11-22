@extends('layouts.master')

@section('content')
<div class="osahan-order">
    <div class="order-menu">
        <h5 class="fw-bold p-3 d-flex align-items-center">Transactions</h5>
        <div class="row m-0 text-center">
            <div class="col pb-2 border-bottom">
                <a href="{{route('on_progress_transaction')}}" class="text-muted text-decoration-none">On Progress</a>
            </div>
            <div class="col pb-2 border-bottom">
                <a href="{{route('complete_transaction')}}" class="text-muted text-decoration-none ">Completed</a>
            </div>
            <div class="col pb-2 border-success border-bottom">
                <a href="{{route('canceled_transaction')}}" class="text-success fw-bold text-decoration-none">Canceled</a>
            </div>
        </div>
    </div>
    <div class="order-body p-3">
        <div class="pb-3">
            @foreach($canceled as $item)
            <a href="{{route('show_transaction',['id'=>Crypt::encryptString($item->id_transaction)])}}" class="text-decoration-none text-dark">
                <div class="p-3 rounded shadow-sm bg-white">
                    <div class="d-flex align-items-center mb-3">
                        <p class="bg-danger text-white py-1 px-2 rounded small m-0">Canceled</p>
                        <p class="text-muted ms-auto small m-0"><i class="icofont-clock-time"></i> {{date('d/m/Y',strtotime($item->so_date))}}</p>
                    </div>
                    <div class="d-flex">
                        <p class="text-muted m-0">Transaction. ID<br>
                            <span class="text-dark fw-bold">#{{@$item->id_transaction}}</span>
                        </p>
                        <p class="text-muted m-0 ms-auto">Customer<br>
                            <span class="text-dark fw-bold">{{@$item->customers->name}}</span>
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
