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

    <div class="row row-cols-1 row-cols-xxl-5 row-cols-lg-3 row-cols-md-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{asset('./admin/images/user.webp')}}" class="w-100" alt="">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-muted fw-normal mt-0 text-uppercase fw-bold" title="Number of Orders">Users</h5>
                                    <h3 class="my-3">{{@$users}} <span class="small">orang</span></h3>
                                    <span class="badge bg-danger me-1" title="Non Active"><i class="ri-arrow-up-circle-line"></i> 0 </span>
                                    <span class="badge bg-success me-1" title="Active"><i class="ri-arrow-down-circle-fill"></i>{{@$users}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->


        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{asset('./admin/images/store.webp')}}" class="w-100" alt="">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-muted fw-normal mt-0 text-uppercase fw-bold" title="Number of Orders">Customer</h5>
                                    <h3 class="my-3">{{@$totalCustomers}}</h3>
                                    <p class="mb-0 text-muted text-truncate">
                                        @if(number_format(@$percentageDifferenceCust, 2) > 0)
                                            <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                {{number_format(@$percentageDifferenceCust, 2)}} %</span>
                                            <span class="small">Since last month</span>
                                        @else
                                            <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                {{number_format(@$percentageDifferenceCust, 2)}} %</span>
                                            <span class="small">Since last month</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{asset('./admin/images/customer.webp')}}" class="w-100" alt="">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-muted fw-normal mt-0 text-uppercase fw-bold" title="Number of Orders">Sales Order</h5>
                                    <h3 class="my-3">{{@$totalSalesOrder}}</h3>
                                    <p class="mb-0 text-muted text-truncate">
                                        @if(number_format(@$percentageDifferenceCust, 2) > 0)
                                            <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                                {{@$percentageDifference}} %</span>
                                            <span class="small">Since last month</span>
                                        @else
                                            <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                                {{@$percentageDifference}} %</span>
                                            <span class="small">Since last month</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{asset('./admin/images/product.png')}}" class="w-100" alt="">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-muted fw-normal mt-0 text-uppercase fw-bold" title="Number of Orders">Product</h5>
                                    <h3 class="my-3">{{@$totalProducts}}</h3>
                                    <p class="mb-0 text-muted text-truncate">
                                        <span class="badge bg-danger me-1" title="Non Active"><i class="ri-arrow-up-circle-line"></i>
                                            {{@$productNonActive}}</span>
                                        <span class="badge bg-success me-1" title="Active"><i class="ri-arrow-down-circle-fill"></i>
                                            {{@$productActive}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div> <!-- end row -->

</div>
@endsection
