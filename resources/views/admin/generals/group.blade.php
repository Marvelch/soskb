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
                                <div class="w-100 mt-1">
                                    <select name="" id="chairman"
                                        class="form-control form-control-sm mt-1 text-muted text-capitalize">
                                    </select>
                                </div>
                            </div>
                            <!-- end due date -->
                        </div>

                        <div class="col-md-4">
                            <!-- start due date -->
                            <p class="mt-2 mb-1 text-muted">Nama Group</p>
                            <div class="d-flex align-items-start">
                                <div class="w-100 mt-1">
                                    <input type="text" id="note" class="form-control form-control-sm">
                                    <p class="text-danger" style="font-size: 9px; margin-top: 5px;">Penulisan Nama Group : Customer Group - Wilayah </p>
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

                    <div id="contentListEmployee"></div>

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
                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-submit btn-sm btn-primary">Simpan</button>
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
                        <label for="" class="text-sm small mb-2">Pilih Karyawan</label>
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
    </div>
</div>
<!-- end row -->

</div> <!-- container -->
<script>
    const listEmployee = [];

    $('.btn-submit').hide();

    $('document').ready(function () {
        $('#chairman').select2({
            ajax: {
                url: '{{route("admin.users.chairman.searching")}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                customer: item.customer_type_id,
                                position: item.position_unique,
                                region: item.region_id,
                                text: item.name,
                                id: item.id
                            };
                        })
                    };
                },
                cache: true
            }
        });

        $('#chairman').on('change', function () {
            var chairmanValue = $('#chairman').find(':selected').val();

            if (chairmanValue) {
                $('#employee').select2({
                    ajax: {
                        url: function (params) {
                            var id = chairmanValue; // Replace this with the actual ID value
                            return '{{ route("admin_group_searching_employee_general", ["id" => ":id"]) }}'
                                .replace(':id', id) + '?search=' + params.term;
                        },
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        title: item.title,
                                        email: item.email,
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
    });

    // Function to remove duplicates based on 'position' and 'employee'
    function removeDuplicates(arr) {
        let seen = new Set();
        return arr.filter(obj => {
            const key = obj.id + '-' + obj.employee;
            return seen.has(key) ? false : seen.add(key);
        });
    }

    $('.add').on('click', function () {

        var selectedOption = $('#employee').select2('data'); // selectedOption.email

        if (selectedOption) {

            $('#contentListEmployee').empty();

            $('#chairman').prop('disabled', true);

            if ($('#employee').val() == null) {
                listEmployee = null;
                alert('Pilih Karyawan !')
            } else {
                    selectedOption.forEach(function (obj, index) {
                        listData = {
                            id: obj.id,
                            text: obj.text,
                            email: obj.email,
                            title: obj.title
                        }

                        listEmployee.push(listData);
                    });

                if (listEmployee.length > 0) {
                    $('.btn-submit').show();
                } else {
                    $('.btn-submit').hide();
                }

                console.log(listEmployee);

                var uniqueArray = removeDuplicates(listEmployee);

                uniqueArray.forEach(function (obj, index) {
                    const contentList = `
                            <div class="card">
                                <div class="card-body shadow">
                                    <!-- task -->
                                    <div class="row justify-content-sm-between">
                                        <div class="col-md-2">
                                            <img src="https://cdn-icons-png.flaticon.com/512/599/599305.png" class="w-75"
                                                alt="" srcset="">
                                        </div>
                                        <div class="col-sm-6 mb-sm-0">
                                            <div class="form-check">
                                                <p class="fw-bold h5 text-muted text-uppercase">
                                                    ${obj.text}
                                                </p>
                                                <p class="small text-lowercase"><span><i class='ri-medal-fill text-success fs-16 me-1'></i>${obj.title}</span> <span style="margin-left: 12px;"><i class='ri-mail-send-fill text-success fs-16 me-1'></i>${obj.email}</span></p>
                                            </div> <!-- end checkbox -->
                                        </div> <!-- end col -->
                                        <div class="col-sm-4 mb-sm-0">
                                            <div class="d-flex justify-content-end">
                                                <ul class="list-inline fs-13 text-end">
                                                    <li class="list-inline-item ms-1 m-2 text-capitalize text-right">
                                                        <i class='ri-delete-back-line text-success fs-16 me-1'></i>
                                                    </li>
                                                </ul>
                                            </div> <!-- end .d-flex-->
                                        </div>
                                    </div>
                                    <!-- end task -->

                                </div> <!-- end card-body-->
                            </div>
                        `;
                    $('#contentListEmployee').append(contentList);
                });
            }
        }
    });

    $(document).on('click', '.btn-submit', function () {
        // Prevent the default form submission
        event.preventDefault();

        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Set the CSRF token in the headers of your AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        var chairman = $('#chairman option:selected').val();

        var note = $('#note').val();

        var uniquestoreArray = removeDuplicates(listEmployee);

        $.ajax({
            type: 'POST',
            url: '{{route("admin.store.group")}}',
            data: {
                chairman: chairman,
                note: note,
                listEmployee: uniquestoreArray
            },
            success: function (response) {
                window.location.href = "{{ route('admin_group_general') }}";
            },
            error: function (xhr, status, error) {
                window.location.href = "{{ route('admin_group_general') }}";
            }
        })
    });

</script>

@endsection
