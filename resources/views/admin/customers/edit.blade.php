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
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <!-- <h4 class="page-title">Add Customers</h4> -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <form action="{{route('admin.customers.update',['id'=>Crypt::encryptString($customerDataUsers->id)])}}"
                method="post">
                @method('PUT')
                @csrf
                <!-- project card -->
                <div class="card d-block">
                    <div class="card-body mb-3">

                        <!-- end form-check-->
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class=""><i class="ri-edit-2-fill text-success"></i> Edit Customers</h4>
                                <p class="small text-muted">Tentukan alamat lengkap dan koordinat customer pada layanan sales orders</p>
                                <!-- assignee -->
                                <p class="mt-2 mb-1 text-muted mt-4 small">Customer Name</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <input type="text" name="name" class="form-control form-control-sm"
                                            value="{{$customerDataUsers->name}}" required>
                                        @error('name')
                                        <p class="text-danger small">{{ $message }}</p>
                                        @enderror
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
                                            value="{{$customerDataUsers->customer_number}}" required>
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
                                        <input type="text" name="address" class="form-control form-control-sm"
                                            value="{{$customerDataUsers->address}}" required>
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

                <div class="card b-block">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Customer Group</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <select name="customer_type_id" id="customer"
                                            class="form-control form-control-sm" required>
                                            @foreach($customerData as $item)
                                            <option value="{{@$item->id}}"
                                                {{@$item->id == @$customerDataUsers->customerType->id ? 'selected' : ''}}>
                                                {{@$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <!-- <p class="text-danger" style="font-size: 9px; margin-top: 5px;">Penulisan Nama Group : Customer Group - Wilayah </p> -->
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>
                            <!-- end col -->

                            <div class="col-md-4">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Sub Customer Group</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <select name="sub_customer_type_id" id="subCustomer"
                                            class="form-control form-control-sm">
                                        </select>
                                        <!-- <p class="text-danger" style="font-size: 9px; margin-top: 5px;">Penulisan Nama Group : Customer Group - Wilayah </p> -->
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>
                            <!-- end col -->
                        </div>
                    </div>
                </div>

                <div class="card d-block">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Select Island</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <select name="island_id" id="island" class="form-control form-control-sm" required>
                                            @foreach($islandData as $item)
                                            <option value="{{@$item->id}}"
                                                {{@$item->id == $customerDataUsers->island_id ? 'selected' : ''}}>
                                                {{@$item->island_name}}</option>
                                            @endforeach
                                        </select>
                                        <!-- <p class="text-danger" style="font-size: 9px; margin-top: 5px;">Penulisan Nama Group : Customer Group - Wilayah </p> -->
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>

                            <div class="col-md-4">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted small">Select Region</p>
                                <div class="d-flex align-items-start">
                                    <div class="w-100">
                                        <select name="region_id" id="region" class="form-control form-control-sm" required>
                                        </select>
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>

                            <div class="col-md-4">
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
                        </div>
                    </div>
                </div>

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
                    <div class="form-group">
                        <img src="https://globalradio.co.id/uploads/news/google%20maps.png" class="w-100" alt="" srcset="">
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="button" class="btn add btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                class="ri-arrow-left-right-line"></i></button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body text-capitalize">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <img src="https://img.freepik.com/premium-vector/update-flat-purple-update-notification-vector-illustration_748571-1384.jpg" class="w-50" alt="" srcset="">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end row -->
</div> <!-- container -->
<script>
    $('document').ready(function () {

        var subCustomerOption = new Option(<?php echo json_encode(@$customerDataUsers->subCustomerType->name ? $customerDataUsers->subCustomerType->name : '') ?>, <?php echo json_encode(@$customerDataUsers->subCustomerType->id) ?>, false, false);
        $('#subCustomer').append(subCustomerOption).trigger('change');

        var regionOption = new Option(<?php echo json_encode(@$customerDataUsers->region->region_name ? $customerDataUsers->region->region_name : '') ?>, <?php echo json_encode(@$customerDataUsers->region->id) ?>, false, false);
        $('#region').append(regionOption).trigger('change');

        var cityOption = new Option(<?php echo json_encode(@$customerDataUsers->city->city_name ? $customerDataUsers->city->city_name : '') ?>, <?php echo json_encode(@$customerDataUsers->city->id) ?>, false, false);
        $('#city').append(cityOption).trigger('change');

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

        $('#island').on('change click', function () {
            var islandValue = $('#island').find(':selected').val();

            $('#region').empty();
            $('#city').empty();

            if (islandValue) {
                $('#region').select2({
                    ajax: {
                        url: '{{route("admin.region.searching")}}',
                        dataType: 'json',
                        delay: 250,
                        data: {
                            island: islandValue
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.region_name,
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
