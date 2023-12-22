@extends('admin.layouts.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control shadow border-0" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="ri-calendar-todo-fill fs-13"></i>
                            </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="ri-refresh-line"></i>
                        </a>
                    </form>
                </div>
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
                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Customers</h5>
                            <h3 class="my-3">{{@$totalCustomers}}</h3>
                            <p class="mb-0 text-muted text-truncate">
                                @if(number_format(@$percentageDifferenceCust, 2) > 0)
                                <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                    {{number_format(@$percentageDifferenceCust, 2)}} %</span>
                                @else
                                <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                    {{number_format(@$percentageDifferenceCust, 2)}} %</span>
                                @endif
                                <span>Since last month</span>
                            </p>
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
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Total Orders</h5>
                            <h3 class="my-3">{{@$totalSalesOrder}}</h3>
                            <p class="mb-0 text-muted text-truncate">
                                <span class="badge bg-danger me-1"><i class="ri-arrow-down-line"></i>
                                    {{@$percentageDifference}} %</span>
                                <span>Since last month</span>
                            </p>
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
                            <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Total Products</h5>
                            <h3 class="my-3">{{@$totalProducts}}</h3>
                            <p class="mb-0 text-muted text-truncate">
                                <span class="badge bg-danger me-1"><i class="ri-lock-unlock-line"></i>
                                    {{@$productNonActive}}</span>
                                <span class="badge bg-success me-1"><i class="ri-lock-2-line"></i>
                                    {{@$productActive}}</span>
                            </p>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div> <!-- end row -->

</div>
@endsection
