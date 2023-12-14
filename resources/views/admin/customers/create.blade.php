@extends('admin.layouts.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
                <!-- <h4 class="page-title">Add Customers</h4> -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <form action="{{route('admin.customers.store')}}" method="post">
                @csrf
                <!-- project card -->
                <div class="card d-block">
                    <div class="card-body mb-3">

                        <!-- end form-check-->
                        <div class="clearfix"></div>

                        <div class="row m-2">
                            <div class="col-md-12">
                                <h4 class="text-muted">Add Customers</h4>
                                <p class="small text-muted">Perhatikan poses penginputan <u>customer</u> untuk mengisi
                                    semua
                                    kolom sesuai kebutuhan sales dan laporan akhir.</p>
                                <!-- assignee -->
                                <p class="mt-2 mb-1 text-muted mt-4 small">Customer Name</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <input type="text" name="name" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div>
                            <!-- end col -->

                            <div class="col-md-3 mt-2">
                                <!-- assignee -->
                                <p class="mt-2 mb-1 text-muted small">CN ERP / Accurate</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <input type="text" name="customer_number" class="form-control form-control-sm"
                                            required>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div>
                            <!-- end col -->

                            <div class="col-md-9 mt-2">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Address</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <input type="text" name="address" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>

                            <div class="col-md-4 mt-2">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Customer Group</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <select name="customer_type_id" id="customer"
                                            class="form-control form-control-sm" required>
                                            @foreach($customerData as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <!-- <p class="text-danger" style="font-size: 9px; margin-top: 5px;">Penulisan Nama Group : Customer Group - Wilayah </p> -->
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>
                            <!-- end col -->

                            <div class="col-md-4 mt-2">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Sub Customer Group</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <select name="sub_customer_type_id" id="subCustomer"
                                            class="form-control form-control-sm" required>
                                        </select>
                                        <!-- <p class="text-danger" style="font-size: 9px; margin-top: 5px;">Penulisan Nama Group : Customer Group - Wilayah </p> -->
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>
                            <!-- end col -->

                            <div class="col-md-4 mt-2">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Select Region</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <select name="region_id" id="region" class="form-control form-control-sm"
                                            required>
                                            @foreach($regionData as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <!-- <p class="text-danger" style="font-size: 9px; margin-top: 5px;">Penulisan Nama Group : Customer Group - Wilayah </p> -->
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>

                            <div class="col-md-4 mt-2">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Select City</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <select name="city_id" id="city" class="form-control form-control-sm" required>
                                        </select>
                                        <!-- <p class="text-danger" style="font-size: 9px; margin-top: 5px;">Penulisan Nama Group : Customer Group - Wilayah </p> -->
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>
                            <!-- end col -->
                        </div>

                        <!-- end row -->

                        <!-- end sub tasks/checklists -->
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->

                <!-- project card -->
                <div class="card d-block">
                    <div class="card-body">
                        <!-- end file preview template -->
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                        <!-- end sub tasks/checklists -->
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->

        </div>
        <div class="col-xl-4 col-lg-7">
            <div class="card d-block">
                <div class="card-body">
                    <div class="form-group mt-2">
                        <label for="" class="text-sm small mb-2">Check Existing Data</label>
                        <select name="" id="employee" class="form-control form-control-sm text-muted text-capitalize">

                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button class="btn add btn-primary btn-sm mt-2"><i
                                class="ri-arrow-left-right-line"></i></button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- end row -->

</div> <!-- container -->
<script>
    $('document').ready(function () {

        $('#customer').on('change click', function () {
            var customerValue = $('#customer').find(':selected').val();

            $('#subCustomer').val(null);

            if (customerValue) {
                $('#subCustomer').select2({
                    ajax: {
                        url: '{{route("admin.sub.customers.type.searching")}}',
                        dataType: 'json',
                        delay: 250,
                        data: {
                            customer: customerValue
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                })
            }
        });

        $('#region').on('change click', function () {
            var regionValue = $('#region').find(':selected').val();

            $('#city').val(null);

            if (regionValue) {
                $('#city').select2({
                    ajax: {
                        url: '{{route("admin.city.searching")}}',
                        dataType: 'json',
                        delay: 250,
                        data: {
                            region: regionValue
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.city_name,
                                        id: item.id
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                })
            }
        });
    });

</script>

@endsection
