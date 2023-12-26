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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">

            <!-- tasks panel -->
            <div class="mt-2">
                <div class="collapse show">
                    <div class="row">
                        <div class="col-md-9">
                            <form action="{{route('admin.users.update',['id'=>Crypt::encryptString($users->id)])}}"
                                method="post">
                                @method('PUT')
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="text-muted"><i class="ri-edit-2-fill text-success"></i> Edit Users
                                        </h4>
                                        <p class="text-sm small text-muted mb-3">Baca juga untuk syarat dan ketentuan
                                            sebelum melakukan perubahaan informasi pengguna</p> -->
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="" class="small">Nama Lengkap</label>
                                                    <input type="text" class="form-control form-control-sm mt-1"
                                                        value="{{$users->name}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="" class="small">Email</label>
                                                    <input type="text" class="form-control form-control-sm mt-1"
                                                        value="{{$users->email}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="" class="small">Password</label>
                                                    <input type="text" name="password"
                                                        class="form-control form-control-sm mt-1">
                                                    <p class="text-danger" style="font-size: 10px;">Tidak bisa melihat
                                                        password pengguna</p>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="" class="small">Pilih Posisi / Jabatan</label>
                                                    <select name="position" class="form-control form-control-sm mt-1"
                                                        id="position">
                                                        {{@$item->unique}}
                                                        @foreach($positions as $item)
                                                        <option value="{{$item->unique}}"
                                                            {{$item->unique == $users->position_unique ? 'selected' : ''}}>
                                                            {{$item->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="m-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="small mb-1">Pilih Customer Group <span
                                                            class="text-danger">*</span></label>
                                                    <select name="customer_type_id" id="customerGroup"
                                                        class="form-control form-control-sm text-capitalize" required>
                                                        @foreach($customerTypes as $item)
                                                        <option value="{{$item->id}}"
                                                            {{@$item->id == @$users->customers->customergroup->id ? 'selected' : '' }}>
                                                            {{strtolower(@$item->name)}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" class="small mb-1">Pilih Sub Customer Group</label>
                                                    <select name="sub_customer_type_id" id="subCustomerGroup"
                                                        class="form-control form-control-sm text-capitalize">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-2" id="newMarketingArea">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless" id="dynamic_field">
                                                        <tr>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="" class="small mb-1">Pilih Pulau <span
                                                                            class="text-danger">*</span></label>
                                                                    <select name="island[]" id="1"
                                                                        class="form-control form-control-sm">
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="" class="small mb-1">Pilih
                                                                        Provinsi</label>
                                                                    <select name="region_id[]" id="100"
                                                                        class="form-control form-control-sm">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="" class="small mb-1">Pilih Kota</label>
                                                                    <select name="city_id[]" id="200"
                                                                        class="form-control form-control-sm">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <button class="btn btn-sm btn-primary"
                                                                        style="margin-top: 25px;" type="button"
                                                                        name="add" id="add"><i
                                                                            class="ri-add-circle-line"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-2" id="existingMarketingArea">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        @foreach($marketingArea as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <label for="" class="small mb-1">Pilih Pulau<span
                                                                                class="text-danger">*</span></label>
                                                                        <select
                                                                            class="form-control form-control-sm" readonly>
                                                                            <option value="{{$item->islands->id}}">{{$item->islands->island_name}}</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <label for="" class="small mb-1">Pilih
                                                                            Provinsi</label>
                                                                        <select
                                                                            class="form-control form-control-sm">
                                                                            <option value="{{@$item->regions->id}}">{{@$item->regions->region_name}}</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <label for="" class="small mb-1">Pilih Kota</label>
                                                                        <select
                                                                            class="form-control form-control-sm">
                                                                            <option value="{{@$item->citys->id}}">{{@$item->citys->city_name}}</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <a href="{{route('admin.marketing.area.destroy',['id'=>Crypt::encryptString($item->id)])}}" class="btn btn-sm btn-danger btn_remove"
                                                                            style="margin-top: 25px;" type="button"
                                                                            name="add" id="add"><i class="ri-close-circle-line"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-2">
                                    <div class="card-body d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn-submit btn btn-sm btn-primary btn-save m-1" id="btn-save"><i class="ri-save-3-line"></i> Save Location</button>
                                        <button type="button"
                                            class="btn-submit btn btn-sm btn-primary btn-edit m-1" id="btn-check"><i class="ri-map-pin-user-fill"></i> Existing Location</button>
                                        <button type="button"
                                            class="btn-submit btn btn-sm btn-primary btn-edit m-1" id="btn-add"><i class="ri-file-list-3-line"></i> New Entry</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <img src="https://img.freepik.com/premium-vector/warning-attention-illustration-vector_690904-59.jpg"
                                        class="w-100" alt="" srcset="">
                                    <div class="form-group">
                                        <ul class="small">
                                            <li>Kolom bertanda merah bersifat mendatory untuk diinput</li>
                                            <li>Kolom provinsi dan kota boleh kosong, tapi pemilihan pulau tidak boleh
                                                kosong.</li>
                                            <li>Pastikan setting lokasi sales sesuai dengan lokasi customers.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end .collapse-->
            </div> <!-- end .mt-2-->

        </div> <!-- end col -->

    </div>
    <!-- end row-->

</div> <!-- container -->
@push('jsscripts')
<script>

    $('#btn-save').hide();

    if(<?php echo json_encode($marketingArea) ?>.length > 0) {
        $('#existingMarketingArea').show();
        $('#newMarketingArea').hide();
        $('#btn-check').hide();
        $('#btn-add').show();
    }else{
        $('#newMarketingArea').show();
        $('#existingMarketingArea').hide();
        $('#btn-check').show();
        $('#btn-add').hide();
    }

    $('#btn-add').on('click',function() {
        $('#existingMarketingArea').hide(800).css('display', 'block').css('opacity', '1');
        $('#newMarketingArea').show(800).css('display', 'block').css('opacity', '1');
        $('#btn-save').show(800).css('display', 'block').css('opacity', '1');
        $('#btn-check').show(800).css('display', 'block').css('opacity', '1');
        $('#btn-add').hide(800).css('display', 'block').css('opacity', '1');
    });

    $('#btn-check').on('click',function() {
        $('#existingMarketingArea').show(800).css('display', 'block').css('opacity', '1');
        $('#newMarketingArea').hide(800).css('display', 'block').css('opacity', '1');
        $('#btn-check').hide(800).css('display', 'block').css('opacity', '1');
        $('#btn-save').hide(800).css('display', 'block').css('opacity', '1');
        $('#btn-add').show(800).css('display', 'block').css('opacity', '1');
    });

    $(document).ready(function () {
        var subCustomerOption = new Option( <?php echo json_encode(@$users->subCustomers->subCustomergroup->id ? $users->subCustomers->subCustomergroup->name : '') ?>
            , <?php echo json_encode(@$users->subCustomers->subCustomergroup->id) ?> , false, false);

        $('#subCustomerGroup').append(subCustomerOption).trigger('change');

        $("#customerGroup").on('change click', function () {
            const customer_group_id = $(this).find('option:selected').val();
            $("#subCustomerGroup").val(null);
            $("#subCustomerGroup").select2({
                ajax: {
                    url: "{{ route('admin.searching.sub.customer.group.searching') }}",
                    dataType: "json",
                    delay: 250,
                    data: {
                        customer_group_id: customer_group_id
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });


        $("#1").select2({
            ajax: {
                url: "{{ route('admin.searching.island.searching') }}",
                dataType: "json",
                allowClear: true,
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.island_name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $("#1").change(function () {
            const island_id = $(this).find('option:selected').val();
            $("#100").select2({
                ajax: {
                    url: "{{ route('admin.searching.region.searching') }}",
                    dataType: "json",
                    allowClear: true,
                    delay: 250,
                    data: {
                        island_id: island_id
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.region_name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).on('change', function() {
                if ($(this).val() === '') {
                    $(this).val(null).trigger('change');
                }
            });
        });

        $("#100").change(function () {
            const region_id = $(this).find('option:selected').val();

            $("#200").select2({
                ajax: {
                    url: "{{ route('admin.searching.city.searching') }}",
                    dataType: "json",
                    delay: 250,
                    allowClear: true,
                    data: {
                        region_id: region_id
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.city_name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).on('change', function() {
                if ($(this).val() === '') {
                    $(this).val(null).trigger('change');
                }
            });
        });

        // Append after adding
        var i = 1;
        var n = 100;
        var x = 200;
        $('#add').click(function () {
            i++;
            n = n + 1;
            x = x + 1;
            var newRow = '<tr id="row' + i + '">' +
                '<td>' +
                '<div class="form-group">' +
                '<label for="" class="small">Pilih Pulau <span class="text-danger">*</span></label>' +
                '<select name="island[]" id="' + i + '" class="form-control mt-1 form-control-sm" required>' +
                '<option value=""></option>' +
                '</select>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<label for="" class="small">Pilih Provinsi</label>' +
                '<select name="region_id[]" id="' + n + '" class="form-control mt-1 form-control-sm">' +
                '<option value=""></option>' +
                '</select>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<label for="" class="small">Pilih Kota</label>' +
                '<select name="city_id[]" id="' + x + '" class="form-control mt-1 form-control-sm">' +
                '<option value=""></option>' +
                '</select>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-group">' +
                '<button class="btn btn-sm btn-danger btn_remove" style="margin-top: 25px;" type="button" name="remove" id="' +
                i + '"><i class="ri-close-circle-line"></i></button>' +
                '</div>' +
                '</td>' +
                '</tr>';

            $('#dynamic_field').append(newRow);

            // Initialize select2 after adding the row
            $("#" + i).select2({
                ajax: {
                    url: "{{ route('admin.searching.island.searching') }}",
                    dataType: "json",
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.island_name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $("#" + i).change(function () {
                const island_id = $(this).find('option:selected').val();

                $("#" + n).select2({
                    ajax: {
                        url: "{{ route('admin.searching.region.searching') }}",
                        dataType: "json",
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term,
                                island_id: island_id
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.region_name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                }).on('change', function() {
                    if ($(this).val() === '') {
                        $(this).val(null).trigger('change');
                    }
                });
            });

            $("#" + n).change(function () {
                const region_id = $(this).find('option:selected').val();

                $("#" + x).select2({
                    ajax: {
                        url: "{{ route('admin.searching.city.searching') }}",
                        dataType: "json",
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term,
                                region_id: region_id
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.city_name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true,
                    }
                }).on('change', function() {
                    if ($(this).val() === '') {
                        $(this).val(null).trigger('change');
                    }
                });
            });

            if(i > 1 && n > 100 && x > 200) {
                $('#btn-check').hide();
                $('#btn-save').show(800).css('display', 'block').css('opacity', '1');
            }
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id).remove();
            i--;
            console.log(i)

            if(i === 1) {
                $('#btn-check').show(800).css('display', 'block').css('opacity', '1');
                $('#btn-save').show(800).css('display', 'block').css('opacity', '1');
            }
        });
    });

</script>
@endpush
@endsection
