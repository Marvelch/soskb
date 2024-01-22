@extends('layouts.master')

@section('content')
<div class="osahan-help-ticket">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('home')}}">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">History Transaction</h6>
        </div>
    </div>
</div>
<div class="p-3">
    <form action="{{route('update.sales.orders',['id_transaction'=>$id])}}" method="post">
        @method('PUT')
        @csrf
        <a href="{{route('edit.customer.sales.orders',['id_transaction'=>$id])}}">
            <div class="row mb-1">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex bd-highlight">
                                <div class="flex-grow-1 bd-highlight text-muted text-capitalize" style="align-items: center; display: flex;">{{$customerTempData->customers->name}} - {{$customerTempData->customers->customer_number}}</div>
                                <div class="bd-highlight"><i class="fa-solid fa-chevron-right mt-2 text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{route('edit.product.sales.orders',['id_transaction'=>$id])}}">
            <div class="row">
                @foreach($productTempData as $item)
                <div style="padding-left: 8px;">
                    <div class="card m-1">
                        <div class="card-body">
                            <div class="col text-muted" style="font-size: 11px;">
                                {{$item->products->product_name}} - Qty : {{$item->qty}} {{$item->units->unit}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </a>
        <div class="card mt-1">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="exampleInputName1">Tanggal Kirim </label>
                            <input name="send_date" type="date" class="form-control"
                                value="{{date('Y-m-d',strtotime($salesOrderData->send_date))}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="exampleInputName1">Tanggal SO</label>
                            <input name="so_date" type="date" class="form-control"
                                value="{{date('Y-m-d',strtotime($salesOrderData->so_date))}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <textarea name="information" id="" cols="30" rows="2" class="form-control">{{$salesOrderData->information}}</textarea>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            @if($customerTempData && $productTempData)
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </div>
            @endif
        </div>
    </form>
</div>
@endsection
