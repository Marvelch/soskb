@extends('layouts.master')

@section('content')
<div class="osahan-order">
    <div class="order-menu">
        <h5 class="fw-bold p-3 d-flex align-items-center">History Transaction<a class="toggle ms-auto" href="#"></h5>
    </div>
    <div class="order-body px-3 pt-3">
        @foreach($transactions as $item)
        <div class="pb-3">
            <a href="{{route('show_transaction',['id'=>Crypt::encryptString($item->id_transaction)])}}" class="text-decoration-none text-dark">
                <div class="p-3 rounded shadow-sm bg-white">
                    <div class="d-flex align-items-center mb-3">
                        @if(@$item->status == 1)
                        <p class="bg-warning text-white py-1 px-2 mb-0 rounded small">On Process</p>
                        @elseif(@$item->status == 2)
                        <p class="bg-primary text-white py-1 px-2 mb-0 rounded small">Completed</p>
                        @else
                        <p class="bg-danger text-white py-1 px-2 mb-0 rounded small">Canceled</p>
                        @endif
                        <!-- <p class="text-muted ms-auto small mb-0"><i class="icofont-clock-time"></i> {{date('d/m/Y',strtotime(@$item->created_at))}} | {{@$item->customer_number}}</p> -->
                    </div>
                    <div class="d-flex">
                        <p class="text-dark m-0 fw-bold">{{@$item->customers->name}}<br>
                            <span class="text-muted">{{@$item->users->name}} - {{@date('d/m/Y',strtotime($item->so_date))}}</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
