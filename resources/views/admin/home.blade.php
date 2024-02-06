@extends('admin.layouts.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title text-capitalize">Hi, {{Auth::user()->name}}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="bg-white rounded shadow">
                <div class="p-3">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center text-center">
                            <img src="{{asset('./admin/images/user.webp')}}" alt="Your Image"
                                class="rounded-circle img-thumbnail rounded-black-border"
                                style="border: 2px solid #fff; border-radius: 10px; width: 50%;">
                            <div class="form-group mt-2">
                                {{@$users}} <span class="small">orang</span>
                                <p class="text-muted" style="font-size: 10px;">Total Pengguna</p>
                            </div>
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col">
                                        <span class="badge bg-primary me-1" title="Active"
                                            style="font-size: 14px; border-radius: 3px;"><i
                                                class="ri-arrow-up-circle-line"></i> {{@$users}} </span>
                                        <span class="badge bg-dark me-1" title="Inactive"
                                            style="font-size: 14px; border-radius: 3px;"><i
                                                class="ri-arrow-down-circle-line"></i> 0 </span>
                                        <p class="text-muted text-capitalize mt-3" style="font-size: 9px;">Terlampir
                                            total pengguna</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="w-75 mt-1 btn btn-sm btn-primary fw-bold"
                                    style="font-size: 11px;">Tampilkan</button>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center text-center">
                            <img src="{{asset('./admin/images/store.webp')}}" alt="Your Image"
                                class="rounded-circle img-thumbnail rounded-black-border"
                                style="border: 2px solid #fff; border-radius: 10px; width: 50%;">
                            <div class="form-group mt-2">
                                {{@$totalCustomers}} <span class="small">toko</span>
                                <p class="text-muted" style="font-size: 10px;">Total Pelanggan</p>
                            </div>
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col">
                                        <span class="badge bg-primary me-1" title="Active"
                                            style="font-size: 14px; border-radius: 3px;"><i
                                                class="ri-arrow-up-circle-line"></i> {{@$tatalCustomerActive}} </span>
                                        <span class="badge bg-dark me-1" title="Inactive"
                                            style="font-size: 14px; border-radius: 3px;"><i
                                                class="ri-arrow-down-circle-line"></i> 0 </span>
                                        <p class="text-muted text-capitalize mt-3" style="font-size: 9px;">Terlampir total
                                            pelanggan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="w-75 mt-1 btn btn-sm btn-primary fw-bold"
                                    style="font-size: 11px;">Tampilkan</button>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
                </div>
                <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center text-center">
                            <img src="{{asset('./admin/images/product.png')}}" alt="Your Image"
                                class="rounded-circle img-thumbnail rounded-black-border"
                                style="border: 2px solid #fff; border-radius: 10px; width: 50%;">
                            <div class="form-group mt-2">
                                {{@$totalProducts}} <span class="small">barang</span>
                                <p class="text-muted" style="font-size: 10px;">Total barang</p>
                            </div>
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col">
                                        <span class="badge bg-primary me-1" title="Active"
                                            style="font-size: 14px; border-radius: 3px;"><i
                                                class="ri-arrow-up-circle-line"></i> {{@$totalProductsActive}} </span>
                                        <span class="badge bg-dark me-1" title="Inactive"
                                            style="font-size: 14px; border-radius: 3px;"><i
                                                class="ri-arrow-down-circle-line"></i> {{@$totalProductsInactive}} </span>
                                        <p class="text-muted text-capitalize mt-3" style="font-size: 9px;">Terlampir total
                                            barang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="w-75 mt-1 btn btn-sm btn-primary fw-bold"
                                    style="font-size: 11px;">Tampilkan</button>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}

@endsection
