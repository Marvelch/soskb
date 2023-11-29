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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item active">Set Sales</li>
                    </ol>
                </div>
                <h4 class="page-title">Set Sales</h4>
            </div>
        </div>
    </div>

    <form action="" method="post">
        @method('PUT')
        @csrf
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
                                    <i class="ri-qr-code-line fs-18 text-success me-1"></i>
                                    <div class="w-100">
                                        <h5 class="mt-1 text-capitalize">
                                            {{@$products->code}}
                                        </h5>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div>
                            <!-- end col -->

                            <div class="col-md-5">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted">Product Name</p>
                                <div class="d-flex align-items-start">
                                    <i class="ri-box-2-line fs-18 text-success me-1"></i>
                                    <div class="w-100">
                                        <h5 class="mt-1">
                                            {{@$products->product_name}}
                                        </h5>
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>

                            <div class="col-md-4">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted">Status</p>
                                <div class="d-flex align-items-start">
                                    <i class="ri-settings-3-line fs-18 text-success me-1"></i>
                                    <div class="w-100">
                                        <h5 class="mt-1 text-uppercase">
                                            @if(@$products->status)
                                                Active
                                            @else
                                                Non Active
                                            @endif
                                        </h5>
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

                <div class="card">
                    <div class="card-body">
                        <p class="text-muted small">Mohon diperhatikan bahwa produk {{@$products->product_name}} hanya akan muncul pada sales yang terinput pada kolom berikut :</p>
                        <div class="d-flex align-items-start mt-3">
                            <div class="w-100">
                                <div class="form-group">
                                    <label for="" class="small">Pilih Sales</label>
                                    <select class="js-example-basic-multiple form-control form-control-sm" name="states[]" multiple="multiple">
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- end .border-->
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="w-100">
                                <div class="form-group">

                                </div>
                                <div class="border rounded mt-2">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-4 col-lg-5 disabled">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none text-muted" data-bs-toggle="dropdown"
                                aria-expanded="false" disabled>
                                <i class="ri-more-fill fs-18"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class='ri-attachment-line me-1'></i>Attachment
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class='ri-edit-box-line me-1'></i>Edit
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class='ri-file-copy-2-line me-1'></i>Mark as Duplicate
                                </a>
                                <div class="dropdown-divider"></div>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item text-danger">
                                    <i class='ri-delete-bin-line me-1'></i>Delete
                                </a>
                            </div>
                            <!-- end dropdown menu-->
                        </div>
                        <!-- end dropdown-->

                        <h5 class="card-title fs-16 mb-3">Relation</h5>

                        <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone"
                            data-previews-container="#file-previews"
                            data-upload-preview-template="#uploadPreviewTemplate">
                            <div class="fallback">
                                <!-- <input name="file" type="file" /> -->
                            </div>

                            <div class="dz-message needsclick">
                                <i class="fs-36 text-muted ri-upload-cloud-line"></i>
                                <h4>Drop files here or click to upload.</h4>
                            </div>
                        </form>

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

                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end row -->

</div> <!-- container -->
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
