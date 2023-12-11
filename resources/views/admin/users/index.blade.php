@extends('admin.layouts.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-xxl-8">
            <!-- start page title -->
            <div class="page-title-box">
                <div class="page-title-right">
                    <!-- <div class="app-search">
                        <form>
                            <div class="mb-2 position-relative">
                                <input type="text" class="form-control border border-dark border-opacity-10" id="searchInput"
                                    placeholder="Search Customer...">
                                <span class="ri-search-line search-icon"></span>
                            </div>
                        </form>
                    </div> -->
                </div>
                <h4 class="page-title">
                    List Users
                </h4>
            </div>
            <!-- end page title -->

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
                            <div id="transactions"></div>
                            @foreach($users as $item)
                            <a href="{{route('admin.users.edit',['id'=>Crypt::encryptString($item->id)])}}"
                                id="transactions">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- task -->
                                        <div class="row justify-content-sm-between">
                                            <div class="col-md-1">
                                                <img src="https://cdn-icons-png.flaticon.com/512/599/599305.png"
                                                    class="w-100" alt="" srcset="">
                                            </div>
                                            <div class="col-sm-5 mb-sm-0">
                                                <div class="form-check">
                                                    <p class="fw-bold h5 text-muted text-uppercase">
                                                        {{@$item->name}}
                                                    </p>
                                                    <p class="form-check-label text-sm">{{@$item->email}}</p>
                                                </div> <!-- end checkbox -->
                                            </div> <!-- end col -->
                                            <div class="col-sm-6 mb-sm-0">
                                                <div class="d-flex justify-content-between">
                                                    <div class="mt-2">
                                                        <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item m-2">
                                                                <i class='ri-qr-code-line text-success fs-16 me-1'></i>
                                                                {{sprintf("ID-%05d", @$item->id)}}
                                                            </li>
                                                            <li class="list-inline-item ms-1 m-2 text-capitalize">
                                                                <i class='ri-shield-user-line text-success fs-16 me-1'></i>
                                                                {{@strtolower($item->positions->title)}}
                                                            </li>
                                                            <li class="list-inline-item ms-1 m-2 text-capitalize">
                                                                <i class='ri-map-pin-user-fill text-success fs-16 me-1'></i>
                                                                {{@strtolower($item->regions->name)}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> <!-- end .d-flex-->
                                            </div>
                                        </div>
                                        <!-- end task -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </a>
                            @endforeach
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <i class="ri-filter-2-line fs-18 text-success me-1"></i>
                                        <div class="w-100">
                                            <h5 class="mt-1 text-capitalize">
                                                FILTER
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="text" id="sales" class="form-control form-control-sm"
                                            placeholder="Searching...">
                                    </div>
                                    <div class="form-group mt-2">
                                        <button class="btn btn-filter btn-sm small btn-primary w-100">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end .collapse-->
            </div> <!-- end .mt-2-->

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
                    search : salesValue
                },
                success: function (response) {

                    const userData = response.userData;

                    $('[id^=transactions]').empty();

                    userData.forEach(function (item) {
                        let statusBadge;

                        if (item.account_type == 'ADM') {
                            statusBadge =
                                `<span class="badge bg-warning-subtle text-primary p-1">ADMIN</span>`;
                        } else {
                            statusBadge =
                                `<span class="badge bg-danger-subtle text-danger p-1">SALES</span>`;
                        }

                        // const encryptedIdTransaction =
                        //     '{{ Crypt::encryptString($item->id) }}';

                        const cardContent = `
                                <div class="card">
                                    <div class="card-body">
                                        <!-- task -->
                                        <div class="row justify-content-sm-between">
                                            <div class="col-md-1">
                                                <img src="https://cdn-icons-png.flaticon.com/512/599/599305.png"
                                                    class="w-100" alt="" srcset="">
                                            </div>
                                            <div class="col-sm-5 mb-sm-0">
                                                <div class="form-check">
                                                    <p class="fw-bold h5 text-muted text-uppercase">
                                                        ${item.name}
                                                    </p>
                                                    <p class="form-check-label text-sm">${item.email}</p>
                                                </div> <!-- end checkbox -->
                                            </div> <!-- end col -->
                                            <div class="col-sm-6 mb-sm-0">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item">
                                                                <i class='ri-qr-code-line text-success fs-16 me-1'></i>
                                                                ${"ID-" + ("00000" + item.id).slice(-5)}
                                                            </li>
                                                            <li class="list-inline-item ms-1 text-capitalize">
                                                                <i class='ri-shield-user-line text-success fs-16 me-1'></i>
                                                                // kosong
                                                            </li>
                                                            <li class="list-inline-item ms-1 text-capitalize">
                                                                <i class='ri-map-pin-user-fill text-success fs-16 me-1'></i>
                                                                {{@strtolower($item->regions->name)}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> <!-- end .d-flex-->
                                            </div>
                                        </div>
                                        <!-- end task -->

                                    </div> <!-- end card-body-->
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
