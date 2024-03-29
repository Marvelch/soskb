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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
                <h4 class="page-title">Detail Transaksi</h4>
            </div>
        </div>
    </div>

    <form action="{{route('admin.update.transaction',['id'=>Crypt::encryptString($transactions->id_transaction)])}}" method="post">
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
                            <div class="col-md-4">
                                <!-- assignee -->
                                <p class="mt-2 mb-1 text-muted text-capitalize">request from</p>
                                <div class="d-flex align-items-start">
                                    <i class="ri-user-follow-line fs-18 text-success me-1"></i>
                                    <div class="w-100">
                                        <h5 class="mt-1 text-capitalize">
                                            {{@strtolower($transactions->users->name)}}
                                        </h5>
                                    </div>
                                </div>
                                <!-- end assignee -->
                            </div>
                            <!-- end col -->

                            <div class="col-md-3">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted">Customer</p>
                                <div class="d-flex align-items-start">
                                    <i class="ri-briefcase-line fs-18 text-success me-1"></i>
                                    <div class="w-100">
                                        <h5 class="mt-1">
                                            {{@$transactions->customers->name}}
                                        </h5>
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>

                            <div class="col-md-3">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted">SO Date</p>
                                <div class="d-flex align-items-start">
                                    <i class="ri-calendar-todo-line fs-18 text-success me-1"></i>
                                    <div class="w-100">
                                        <h5 class="mt-1">
                                            {{@date('d-m-Y H:i A',strtotime($transactions->created_at))}}
                                        </h5>
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>

                             <div class="col-md-2">
                                <!-- start due date -->
                                <p class="mt-2 mb-1 text-muted">Send Date</p>
                                <div class="d-flex align-items-start">
                                    <i class="ri-calendar-todo-line fs-18 text-success me-1"></i>
                                    <div class="w-100">
                                        <h5 class="mt-1">
                                            {{date('d-m-Y',strtotime(@$transactions->send_date))}}
                                        </h5>
                                    </div>
                                </div>
                                <!-- end due date -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <h5 class="mt-3">Description:</h5>

                        <p class="text-muted mb-4">
                            {{@$transactions->information}}
                        </p>

                        <!-- end sub tasks/checklists -->
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="w-100">
                                <div class="card mb-1 shadow-none border" style="height: 40px;">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto text-center" style="width: 130px; margin-top: -15px;">
                                                <div class="avatar-sm w-100 fw-bold" style="height: 20px;">
                                                    KODE
                                                </div>
                                            </div>
                                            <div class="col ps-0 text-center fw-bold" style="margin-top: -15px;">
                                                <a href="javascript:void(0);"
                                                    class="text-muted text-sm fw-bold">NAMA BARANG</a>
                                            </div>
                                            <div class="col-auto text-center fw-bold" style="margin-top: -13px;">
                                                <!-- Button -->
                                                <a href="javascript:void(0);" class="btn btn-link fs-16 text-muted fw-bold" >
                                                    QTY
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($transactionDetails as $item)
                                <div class="card mb-1 shadow-none border" style="height: 40px;">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto" style="width: 130px; margin-top: -17px;">
                                                <div class="avatar-sm w-100" style="height: 20px;">
                                                    <a href="javascript:void(0);" class="avatar-title bg-primary-subtle text-primary rounded" id="product_code_{{ $item->products->id }}" onClick="copyProductCode('{{ $item->products->id }}')">
                                                        {{@$item->products->code}}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col ps-0" style="margin-top: -17px;">
                                                <a href="javascript:void(0);" class="text-muted text-sm fw-bold" id="product_{{ $item->products->id }}" onClick="copyProductName('{{ $item->products->id }}')">
                                                    {{ $item->products->product_name }}
                                                </a>
                                            </div>
                                            <div class="col-auto" style="margin-top: -15px;">
                                                <!-- Button -->
                                                <a href="javascript:void(0);" class="btn btn-link fs-16 text-muted" >
                                                    <i class="ri-shopping-bag-line fs-18 text-success me-1"></i>
                                                    {{@$item->qty}} {{@$item->units->unit}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
                                    <select name="status" id="" class="form-control form-contro-sm">
                                        <option value="2" {{ $transactions->status == 2 ? 'selected' : '' }}>Completed</option>
                                        <option value="3" {{ $transactions->status == 3 ? 'selected' : '' }}>Canceled</option>
                                        <option value="4" {{ $transactions->status == 4 ? 'selected' : '' }}>Delivered</option>
                                        <option value="5" {{ $transactions->status == 5 ? 'selected' : '' }}>Warehouse Processing</option>
                                    </select>
                                </div>
                                <div class="border rounded mt-2">
                                    <form action="#" class="comment-area-box">
                                        <textarea name="note" rows="3" class="form-control border-0 resize-none" {{ $transactions->status == 4 || $transactions->status == 3 ? 'disabled' : '' }}>{{@$transactions->note}}</textarea>
                                        <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="#" class="btn btn-sm px-1 btn-light"><i
                                                        class='ri-upload-line'></i></a>
                                                <a href="#" class="btn btn-sm px-1 btn-light"><i
                                                        class='ri-at-line'></i></a>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success" {{ $transactions->status == 4 || $transactions->status == 3 ? 'disabled' : '' }}>
                                                <i class="ri-send-plane-2 me-1"></i>Submit
                                            </button>
                                        </div>
                                    </form>
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

                        <h5 class="card-title fs-16 mb-3">Attachments</h5>

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
@push('jsscripts')
<script>
    function copyProductName(id) {
        const productName = document.getElementById('product_' + id).innerText;

        // Buat elemen textarea untuk menyimpan teks yang akan disalin
        const tempTextArea = document.createElement('textarea');
        tempTextArea.value = productName;

        // Sisipkan elemen textarea ke dalam dokumen
        document.body.appendChild(tempTextArea);

        // Pilih dan salin teks dari elemen textarea ke clipboard
        tempTextArea.select();
        document.execCommand('copy');

        // Hapus elemen textarea setelah teks tercopy
        document.body.removeChild(tempTextArea);
    }

    function copyProductCode(id) {
        const productCode = document.getElementById('product_code_' + id).innerText;

        // Buat elemen textarea untuk menyimpan teks yang akan disalin
        const tempTextArea = document.createElement('textarea');
        tempTextArea.value = productCode;

        // Sisipkan elemen textarea ke dalam dokumen
        document.body.appendChild(tempTextArea);

        // Pilih dan salin teks dari elemen textarea ke clipboard
        tempTextArea.select();
        document.execCommand('copy');

        // Hapus elemen textarea setelah teks tercopy
        document.body.removeChild(tempTextArea);
    }
</script>

@endpush
@endsection
