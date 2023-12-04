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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Structure Organization</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
                <h4 class="page-title">General</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- project card -->
            <div class="card d-block">
                <div class="card-body">

                    <div class="form-group mt-2">
                        <label for="" class="text-sm small">Nama Jabatan <i class="ri-information-line"
                                data-bs-toggle="popover" title="Info"
                                data-bs-content="Tingkatan jabatan akan disesuaikan seperti pada list position
                        pada bagian atas adalah jabatan tertinggi untuk structure organization pada perusahaan"></i></label>
                        <input type="text" id="position" class="form-control form-control-sm mt-2">
                    </div>
                    <div class="form-group d-flex justify-content-end mb-2">
                        <button class="btn btn-sm btn-primary mt-3" id="add"><i class="ri-add-circle-fill"></i></button>
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
                    <div class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone"
                        data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                        <div class="fallback">
                            <!-- <input name="file" type="file" /> -->
                        </div>
                        <div id="content"></div>
                        <div class="form-group d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm" id="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

</div> <!-- container -->
<script>
    $('#submit').hide();

    var listPositions = [];

    $(document).on('click', '#submit', function () {
        // Prevent the default form submission
        event.preventDefault();

        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Set the CSRF token in the headers of your AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Perform an AJAX POST request
        $.ajax({
            type: 'POST',
            url: '{{ route("admin_store_structure_general") }}',
            data: {
                positions: listPositions // Send the product_list data to the server
            },
            success: function (response) {
                // window.location.href = '/admin/generals/structure';
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Handle errors if the AJAX request fails
                console.error(error);
            }
        });
    });

    $('#add').on('click', function () {
        const positionValue = $('#position').val();

        listPositions.push(positionValue);

        $('#position').val(null);

        $('#content').empty();

        listPositions.forEach(function($item){
        const content = `
                        <div class="card" draggable="true">
                            <div class="card-body text-capitalize">
                                <div class="d-flex bd-highlight">
                                    <div class="bd-highlight"><i class="ri-arrow-up-down-fill"></i> </div>
                                    <div class="bd-highlight" style="margin-left: 10px;"> ${$item}</div>
                                    <div class="ms-auto bd-highlight"><i class="ri-close-circle-fill"></i></div>
                                </div>
                            </div>
                        </div>
                    `;

        $('#content').append(content);

        });

        if(listPositions.length > 0) {
            $('#submit').show();
        }else{
            $('#submit').hide();
        }
    });

</script>
@endsection
