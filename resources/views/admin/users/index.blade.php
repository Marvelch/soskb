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
                        <li class="breadcrumb-item active">List Users</li>
                    </ol>
                </div>
                <!-- <h4 class="page-title">Add Customers</h4> -->
            </div>
        </div>
    </div>

    <div class="row">

        <!-- tasks panel -->
        <div class="collapse show mt-1" id="transactionList">
            <div class="row">
                <div class="col-md-9">
                    @foreach($users as $item)
                    <div id="transactions">
                        <div class="card">
                            <div class="card-body">
                                <!-- task -->
                                <div class="row justify-content-sm-between">
                                    <div class="col-md-1">
                                        <img src="https://cdn-icons-png.flaticon.com/512/599/599305.png" class="w-100"
                                            alt="" srcset="">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <a href="{{route('admin.users.edit',['id'=>Crypt::encryptString($item->id)])}}">
                                                <p class="fw-bold h5 text-primary text-muted text-uppercase"
                                                    style="padding-top: 5px;">
                                                    {{@$item->name}}
                                                </p>
                                            </a>
                                            <p class="form-check-label text-muted" style="font-size: 12px;">
                                                {{@$item->email}}</p>
                                        </div> <!-- end checkbox -->
                                    </div> <!-- end col -->
                                    <div class="col-sm-6">
                                        <div class="d-flex justify-content-between">
                                            <div class="mt-2">
                                                <ul class="list-inline fs-13 text-end">
                                                    <li class="list-inline-item">
                                                        <i class='ri-qr-code-line text-success fs-16'></i>
                                                        {{sprintf("ID-%05d", @$item->id)}}
                                                    </li>
                                                    <li class="list-inline-item ms-1 text-capitalize">
                                                        @if(@$item->positions->title)
                                                        <i class='ri-medal-2-fill text-success fs-16'></i>
                                                        {{strtolower(@$item->positions->title)}}
                                                        @endif
                                                    </li>
                                                    <li class="list-inline-item ms-1 text-capitalize">
                                                        @if(@$item->account_type)
                                                        <i class='ri-account-circle-line text-success fs-16'></i>
                                                        {{strtolower(@$item->account_type == 'USR' ? 'Basic' : 'Administrator')}}
                                                        @endif
                                                    </li>
                                                    <li class="list-inline-item ms-1 text-capitalize">
                                                        <i class='ri-edit-2-fill text-success fs-16'></i>
                                                        Edit
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> <!-- end .d-flex-->
                                    </div>
                                </div>
                                <!-- end task -->
                            </div> <!-- end card-body-->
                        </div> <!-- end card -->
                    </div>
                    @endforeach
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <i class="ri-filter-2-line fs-18 text-success me-1"></i>
                                <div class="w-100">
                                    <h5 class="mt-1 small">
                                        FILTER
                                    </h5>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <input type="text" id="sales" class="form-control form-control-sm"
                                    placeholder="Name Users">
                            </div>
                            <div class="form-group mt-2">
                                <button class="btn btn-filter btn-sm small btn-primary w-100">Searching</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end .collapse-->

    </div> <!-- end col -->

    {{ $users->links() }}

</div>
<!-- end row-->

</div> <!-- container -->
@push('jsscripts')
<script>
    $(document).ready(function () {
        $('.btn-filter').on('click', function (e) {
            e.preventDefault(); // Prevent default form submission behavior

            const salesValue = $('#sales').val();

            // Make an AJAX request to process the filter
            $.ajax({
                url: '{{route("admin.users.sales.searching")}}', // Replace with your route URL
                dataType: 'json',
                delay: 250,
                data: {
                    search: salesValue
                },
                success: function (response) {

                    const userData = response.userData;

                    $('[id^=transactions]').empty();

                    userData.forEach(function (item) {
                        let position;

                        if (item.position) {
                            position =
                                `<i class='ri-medal-2-fill text-success fs-16'></i>.${item.position}`;
                        }

                        const cardContent = `
                            <div id="transactions">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- task -->
                                        <div class="row justify-content-sm-between">
                                            <div class="col-md-1">
                                                <img src="https://cdn-icons-png.flaticon.com/512/599/599305.png" class="w-100"
                                                    alt="" srcset="">
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-check">
                                                <a href="/admin/users/edit/${item.idEncrypt}">
                                                    <p class="fw-bold h5 text-primary text-muted text-uppercase" style="padding-top: 5px;">
                                                        ${item.name}
                                                    </p>
                                                    </a>
                                                    <p class="form-check-label text-muted" style="font-size: 12px;">${item.email}</p>
                                                </div> <!-- end checkbox -->
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="d-flex justify-content-between">
                                                    <div class="mt-2">
                                                        <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item">
                                                                <i class='ri-qr-code-line text-success fs-16'></i>
                                                                ${"ID-" + ("00000" + item.id).slice(-5)}
                                                            </li>
                                                            <li class="list-inline-item ms-1 text-capitalize">
                                                                ${position}
                                                            </li>
                                                            <li class="list-inline-item ms-1 text-capitalize">
                                                                @if(@$item->regions->name)
                                                                <i class='ri-map-pin-user-fill text-success fs-16'></i>
                                                                {{strtolower(@$item->regions->name)}}
                                                                @endif
                                                            </li>
                                                            <li class="list-inline-item ms-1 text-capitalize">
                                                                <i class='ri-edit-2-fill text-success fs-16'></i>
                                                                Edit
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> <!-- end .d-flex-->
                                            </div>
                                        </div>
                                        <!-- end task -->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div>
                            `;
                        $('#transactions').append(cardContent);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    // Handle error if necessary
                }
            });
        });
    });

</script>
@endpush
@endsection
