@extends('layouts.master')

@section('content')
<div class="osahan-help-ticket">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="help_support.html">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">Sales Order</h6>
            <a class="toggle ms-auto" href="#"><i class="icofont-navigation-menu "></i></a>
        </div>
    </div>
</div>
<div class="p-3">
    <form>
        <a href="{{route('index_sales_orders_customer')}}">
        <div class="card mt-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-8 fw-bold text-muted">
                        <h6 class="mt-1">Pilih Customer</h6>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <i class="fa-solid fa-chevron-right mt-2 text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
        <a href="{{ @$customers ? url('home') : '' }}" @if(!$customers) disabled @endif>
            <div class="card mt-1">
            <div class="card-body">
                <div class="row">
                    <div class="col-8 fw-bold text-muted">
                        <h6 class="mt-1">Tambah Produk</h6>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <i class="fa-solid fa-chevron-right mt-2 text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
        </a>
        <div class="card mt-1">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="exampleInputName1">Pilih Sales</label>
                            <input type="text" class="form-control" id="exampleInputName1" value="{{Auth::user()->name}}" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="exampleInputName1">Tanggal SO</label>
                            <input type="date" class="form-control" value="{{date('Y-m-d',strtotime(now()))}}">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <textarea name="" id="" cols="30" rows="2" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
