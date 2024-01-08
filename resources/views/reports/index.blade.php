@extends('layouts.master')

@section('content')
<div class="osahan-promo">
    <div class="px-3 pt-3">
        <div class="d-flex align-items-center pb-3">
            <a class="fw-bold text-success text-decoration-none" href="home.html"><i
                    class="icofont-rounded-left back-page"></i></a>
        </div>
    </div>
    <a href="#" class="text-decoration-none text-white">
        <div class="bg-success p-3 text-white">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <div class="brand ms-2">
                            <h5 class="m-0">Sales Reports </h5>
                        </div>
                    </div>
                    <div class="pt-3">
                        <p class="btn btn-outline-light mb-0  text-capitalize"><i class="icofont-tag me-1"></i>
                            {{Auth::user()->name}}</p>
                    </div>
                </div>
                <div class="col-6 text-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/014/605/867/original/3d-report-paper-clipboard-note-paper-for-checklist-notes-3d-illustration-png.png"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </a>
    <div class="promo_detail">
        <div class="title p-3 bg-white shadow-sm">
            <h5 class="fw-bold text-success">Sales Report Dashboard</h5>
            <p class="small text-muted m-0">Available until {{date('d F Y',strtotime(now()))}}</p>
        </div>
        <div class="p-3">
            <div class="mb-0 mt-1">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="start" id="start" class="form-control form-control-sm"
                                value="{{date('Y-m-d',strtotime(now()))}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="end" id="end" class="form-control form-control-sm"
                                value="{{date('Y-m-d',strtotime(now()))}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-show btn-primary w-100 mt-4">Tampilkan</button>
            </div>
            <div id="appendSalesOrderDetail">
                <div class="p-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col text-center mt-3">
                                    <h1 class="fw-bold text-muted opacity-75"><img src="https://static.vecteezy.com/system/resources/previews/008/470/444/non_2x/3d-black-or-dark-mode-window-with-verified-icon-badge-free-png.png" class="w-50" alt="" srcset=""></h1>
                                </div>
                                <div class="col text-center mt-3">
                                    <p class="text-muted">Complated Transaction</p>
                                    <p class="h1 text-muted text-success"><span id="totalComplated"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Nama Produk</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody id="productData">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="appendSalesOrderDetailCustomer">
                <div class="p-3">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Customer</th>
                                    </tr>
                                </thead>
                                <tbody id="customerData">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#appendSalesOrderDetail').hide();
    $('#appendSalesOrderDetailCustomer').hide();

    $('.btn-show').on('click',function () {
        $('#totalComplated').empty();
        $('#appendSalesOrderDetail').show();
        $('#appendSalesOrderDetailCustomer').show();

        var productData = $('#productData');

        const startValue = $('#start').val();
        const endValue = $('#end').val();

        // Call complated transaction
        $.ajax({
            url: "{{ route('reports.data') }}",
            type: "GET",
            cache: false,
            data: {
                start: startValue,
                end: endValue
            },
            success: function (totalProductSalesOrderData) {
                $('#totalComplated').text(totalProductSalesOrderData);
            },
            error: function (error) {
                // Handle error if needed
            }
        });

        // Call data product
        $.ajax({
            url: "{{ route('reports.show') }}",
            type: "GET",
            cache: false,
            data: {
                start: startValue,
                end: endValue
            },
            success: function (response) {
                var productTableBody = $('#productData'); // Reference to tbody element

                productTableBody.empty(); // Clear existing content before appending new data

                $.each(response, function (index, item) {
                    let append = `
                        <tr>
                            <td class="small">${item.product_name}</td>
                            <td class="small text-center">${item.qty}</td>
                        </tr>
                    `;

                    productTableBody.append(append);
                });
            },
            error: function (error) {
                // Handle error if needed
            }
        });

    // Call data product
        $.ajax({
            url: "{{ route('reports.show.customer') }}",
            type: "GET",
            cache: false,
            data: {
                start: startValue,
                end: endValue
            },
            success: function (customerListName) {

                var cutomerTableBody = $('#customerData'); // Reference to tbody element

                cutomerTableBody.empty(); // Clear existing content before appending new data

                $.each(customerListName, function (index, item) {
                    let append = `
                        <tr>
                            <td class="small">${item}</td>
                        </tr>
                    `;

                    cutomerTableBody.append(append);
                });
            },
            error: function (error) {
                // Handle error if needed
            }
        });
    });
</script>
@endsection
