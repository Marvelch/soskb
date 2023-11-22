@extends('layouts.master')

@section('content')
<div class="osahan-help-ticket">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('home')}}">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">Sales Order</h6>
            <a class="toggle ms-auto" href="#"><i class="icofont-navigation-menu "></i></a>
        </div>
    </div>
</div>
<div class="p-3">
    <form action="{{route('store_sales_orders')}}" method="post">
        @csrf
        <a href="{{route('index_sales_orders_customer')}}">
            <div class="row mb-1">
                @if($customers)
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex bd-highlight">
                                <div class="flex-grow-1 bd-highlight fw-bold text-muted"><span style="position: fixed; padding-top: 3px;">{{$customers->customers->name}} - {{$customers->customers->customer_number}}</span></div>
                                <div class="bd-highlight"><i class="fa-solid fa-chevron-right mt-2 text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex bd-highlight">
                                <div class="flex-grow-1 bd-highlight fw-bold text-muted">Pilih Customer</div>
                                <div class="bd-highlight"><i class="fa-solid fa-chevron-right mt-2 text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </a>
        <a href="{{ @$customers ? route('index_sales_orders_product') : '' }}" @if(!$customers) disabled @endif>
            <div class="row">
                @if(count($products) > 0)
                @foreach($products as $item)
                <div style="padding-left: 8px;">
                    <div class="card m-1">
                        <div class="card-body">
                            <div class="col fw-bold text-muted">
                                {{$item->products->product_name}} - Qty : {{$item->qty}} {{$item->units->unit}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex bd-highlight">
                                <div class="flex-grow-1 bd-highlight fw-bold text-muted">Tambah Produk</div>
                                <div class="bd-highlight"><i class="fa-solid fa-chevron-right mt-2 text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </a>
        <div class="card mt-1">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="exampleInputName1">Dibuat Oleh </label>
                            <input type="text" class="form-control" id="exampleInputName1"
                                value="{{Auth::user()->name}}" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="exampleInputName1">Tanggal SO</label>
                            <input name="so_date" type="date" class="form-control"
                                value="{{date('Y-m-d',strtotime(now()))}}">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <textarea name="information" id="" cols="30" rows="2" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            @if($products && $customers)
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </div>
            @endif
        </div>
    </form>
</div>
@endsection
