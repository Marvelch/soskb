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
                <h4 class="page-title">Edit User</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-8">

            <!-- tasks panel -->
            <div class="mt-2">
                <!-- <div class="row">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-1 bd-highlight mt-1"><i class="ri-search-line"></i></div>
                        <div class="p-1 bd-highlight"><input type="date" name="" id="" class="form-control form-control-sm" value="{{@date('Y-m-d',strtotime(now()))}}">
                        </div>
                        <div class="p-1 bd-highlight"><input type="date" name="" id="" class="form-control form-control-sm" value="{{@date('Y-m-d',strtotime(now()))}}">
                        </div>
                    </div>
                </div> -->
                <div class="collapse show mt-1" id="transactionList">
                    <div class="row">
                        <div class="col-md-9">
                            <form action="{{route('admin.users.update',['id'=>Crypt::encryptString($users->id)])}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-sm small text-muted mb-3">Perubahaan akun pengguna akan
                                            mempengaruhi
                                            laporan akhir dari setiap pengguna (sales).</p>
                                        <div class="row">
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
                                                        password. Hanya dapat melakukan perubahaan password.</p>
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
                                            <div class="col-6" id="customer">
                                                <div class="form-group">
                                                    <label for="" class="small mb-1">Customer Group</label>
                                                    <select name="customer"
                                                        class="customer form-control form-control-sm mt-1">
                                                        @foreach($customerTypes as $item)
                                                        <option value="{{$item->id}}">
                                                            {{@$item->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6" id="subcustomer">
                                                <div class="form-group">
                                                    <label for="" class="small mb-1">Sub Customer Group</label>
                                                    <select name="subcustomer"
                                                        class="subcustomer form-control mt-1 form-control-sm mt-1 text-capitalize">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="" class="small">Pilih Wilayah</label>
                                                    <select name="region" id="region"
                                                        class="form-control form-control-sm mt-1 text-capitalize">
                                                        @foreach($regions as $item)
                                                        <option value="{{$item->id}}"
                                                            {{$item->id == $users->region_id ? 'selected' : ''}}>
                                                            {{@strtolower($item->name)}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-2">
                                    <div class="card-body d-flex justify-content-end">
                                        <button type="submit" class="btn-submit btn btn-sm btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
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
    const position = $('#position option:selected').text();

    if (position.toLowerCase().replace(/\s/g, '') == 'sales' || position.toLowerCase().replace(/\s/g, '') == 'spv' ||
        position.toLowerCase().replace(/\s/g, '') == 'supervisor') {
        $('#customer').show();
        $('#subcustomer').show();
    } else {
        $('#customer').hide();
        $('#subcustomer').hide();
    }

    $('#position').on('change', function () {
        const valPosition = $(this).find('option:selected').text();

        if (valPosition.toLowerCase().replace(/\s/g, '') == 'sales' || valPosition.toLowerCase().replace(/\s/g,
                '') == 'spv' || valPosition.toLowerCase().replace(/\s/g, '') == 'supervisor') {
            $('#customer').show();
            $('#subcustomer').show();
        } else {
            $('#customer').hide();
            $('#subcustomer').hide();
        }
    });

    // searching products
    $('.customer').on('change click', function () {
        $('.subcustomer').val(null);

        var customer_id = $(this).find('option:selected').val();

        $('.subcustomer').select2({
            ajax: {
                url: '{{route("admin.users.sub.customers.searching")}}',
                dataType: 'json',
                delay: 250,
                data: {
                    customer_id: customer_id
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

</script>
@endpush
@endsection
