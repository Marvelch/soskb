@extends('layouts.master')

@section('content')
<div class="osahan-status">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('on_progress_transaction')}}">
                <i class="icofont-rounded-left back-page"></i></a>
            <span class="fw-bold ms-3 h6 mb-0">History Transaction</span>
        </div>
    </div>
    <!-- status complete -->
    <div class="p-3 status-order bg-white border-bottom d-flex align-items-center">
        <p class="m-0"><i class="icofont-ui-calendar"></i> <span
                style="margin-left: 10px;">{{date('d F',strtotime(@$transactions->so_date))}},
                {{date('Y',strtotime(@$transactions->so_date))}}</span></p>
        <a disabled class="text-success ms-auto text-decoration-none">#{{@$transactions->id_transaction}}</a>
    </div>
    <div class="p-3 border-bottom">
        <h6 class="fw-bold">Order Status</h6>
        <div class="tracking-wrap">
            @if($transactions->status == 1)
            <div class="my-1 step active">
                <span class="icon text-success"><i class="icofont-check"></i></span>
                <span class="text small"> On Progress </span>
            </div>
            @elseif($transactions->status == 2)
            <!-- step.// -->
            <div class="my-1 step active">
                <span class="icon text-success"><i class="icofont-check"></i></span>
                <span class="text small"> On Progress </span>
            </div>
            <!-- step.// -->
            <div class="my-1 step">
                <span class="icon text-success"><i class="icofont-check"></i></span>
                <span class="text small"> Completed </span>
            </div>
            @elseif($transactions->status == 3)
            <!-- step.// -->
            <div class="my-1 step active">
                <span class="icon text-success"><i class="icofont-check"></i></span>
                <span class="text small"> On Progress </span>
            </div>
            <!-- step.// -->
            <div class="my-1 step">
                <span class="icon text-success"><i class="icofont-check"></i></span>
                <span class="text small"> Canceled </span>
            </div>
            @else
            <!-- step.// -->
            <div class="my-1 step">
                <span class="icon text-success"><i class="icofont-check"></i></span>
                <span class="text small">Error</span>
            </div>
            <!-- step.// -->
            @endif
        </div>
    </div>
    <!-- Destination -->
    <div class="p-3 border-bottom bg-white">
        <h6 class="fw-bold">Customers</h6>
        <p class="m-0 small">{{@$transactions->customers->name}}</p>
        <p class="m-0 text-muted text-capitalize" style="font-size: 10px;">{{strtolower(@$transactions->customers->address)}}</p>
    </div>
    <div class="p-3 border-bottom">
        <p class="fw-bold small mb-1">Information : {{@$transactions->information}}</p>
    </div>
    <!-- total price -->
    <!-- Destination -->
    <div class="p-3 border-bottom bg-white">
        <div class="d-flex align-items-center mb-2">
            <div class="row">
                <div class="col-12">
                    <h6 class="fw-bold mb-1">Detail Transaction</h6>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactionDetails as $item)
                            <tr style="font-size: 10px;">
                                <td>{{@$item->products->product_name}}</td>
                                <td>{{@$item->qty}}</td>
                                <td>{{@$item->units->unit}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
