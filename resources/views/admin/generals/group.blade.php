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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Group</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
                <h4 class="page-title">Management Group</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">

            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">

                    <!-- end form-check-->
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-3">
                            <!-- assignee -->
                            <p class="mt-2 mb-1 text-muted text-capitalize">Unique Code</p>
                            <div class="d-flex align-items-start">
                                <i class="ri-qr-code-line fs-18 text-success me-1 mt-1"></i>
                                <div class="w-100 mt-1">
                                    <h5 class="mt-1 text-capitalize">
                                        {{@$codes}}
                                    </h5>
                                </div>
                            </div>
                            <!-- end assignee -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-5">
                            <!-- start due date -->
                            <p class="mt-2 mb-1 text-muted">Pilih Ketua Group</p>
                            <div class="d-flex align-items-start">
                                <div class="w-100">
                                    <h5 class="mt-1">
                                        <select name="" id="" class="form-control form-control-sm">
                                            @foreach($users as $item)
                                            <option value="">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </h5>
                                </div>
                            </div>
                            <!-- end due date -->
                        </div>

                        <div class="col-md-4">
                            <!-- start due date -->
                            <p class="mt-2 mb-1 text-muted">Note</p>
                            <div class="d-flex align-items-start">
                                <div class="w-100 mt-1">
                                    <input type="text" class="form-control form-control-sm">
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

                    <!-- end form-check-->
                    <div class="clearfix"></div>



                    <!-- Preview -->
                    <div class="dropzone-previews mt-3" id="file-previews"></div>

                    <!-- file preview template -->
                    <div class="d-none" id="uploadPreviewTemplate">
                        <div class="card mb-1 mb-0 shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="" />
                                    </div>
                                    <div class="col ps-0">
                                        <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                        <p class="mb-0" data-dz-size></p>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Button -->
                                        <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                            <i class="ri-close-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end file preview template -->

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
                        <label for="" class="text-sm small">Pilih Jabatan</label>
                        <select name="" id="" class="form-control form-control-sm mt-1">
                            <option value="">Manager</option>
                            <option value="">SPV</option>
                            <option value="">Sales</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="text-sm small">Pilih Karyawan</label>
                        <select name="" id="" class="form-control form-control-sm mt-1">
                            @foreach($users as $item)
                            <option value="">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm mt-2"><i class="ri-add-circle-fill"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

</div> <!-- container -->
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });

</script>
@endsection
