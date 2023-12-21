@extends('admin.layouts.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-xxl-8">
            <!-- start page title -->
            <div class="page-title-box">
                <div class="page-title-right">
                    <div class="app-search">
                        <form>
                            <div class="mb-2 position-relative">
                                <a class="btn btn-primary small" href="{{route('admin.customers.create')}}"><i class="ri-add-circle-line"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
                <h4 class="page-title">
                    List Customers
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
                            @foreach($customers as $item)
                                <div class="card" id="transactions">
                                    <div class="card-body">
                                        <!-- task -->
                                        <div class="row justify-content-sm-between">
                                            <div class="col-sm-8 mb-sm-0">
                                                <div class="form-check">
                                                    <a href="{{route('admin.customers.set.sales',['id'=>Crypt::encryptString($item->id)])}}">
                                                    <p class="fw-bold h5 pt-1 text-muted text-uppercase">
                                                        {{@$item->name}}
                                                    </p>
                                                    </a>
                                                    <p class="form-check-label text-sm small mt-2"><i
                                                            class="ri-qr-code-line text-success"></i>
                                                        {{@$item->customer_number}} <i
                                                            class="ri-map-pin-range-line text-success"></i>{{@$item->address}}
                                                    </p>
                                                </div> <!-- end checkbox -->
                                            </div> <!-- end col -->
                                            <div class="col-sm-4">
                                                <div class="d-flex justify-content-between">
                                                    <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item m-1">
                                                                <i class='ri-calendar-todo-fill text-success fs-16 me-1'></i>
                                                                {{date('d-m-Y',strtotime(@$item->created_at))}}
                                                            </li>
                                                            <li class="list-inline-item ms-1 m-2 text-capitalize">
                                                                <i class='ri-rotate-lock-fill text-success fs-16 me-1'></i>
                                                                @if($item->status == 1)
                                                                Active
                                                                @else
                                                                Non Active
                                                                @endif
                                                            </li>
                                                            <li class="list-inline-item ms-1 m-2 text-capitalize" style="text-decoration: none;">
                                                                <a href="{{route('admin.customers.edit',['id'=>Crypt::encryptString($item->id)])}}">
                                                                    <i class='ri-edit-2-fill text-success fs-16 me-1'></i>
                                                                    <span style="color: #7f80a7;">Edit</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                </div> <!-- end .d-flex-->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end task -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            @endforeach
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <i class="ri-filter-2-line fs-18 text-success me-1"></i>
                                        <div class="w-100">
                                            <h5 class="mt-1 text-capitalize small">
                                                FILTER
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="text" id="customer" class="form-control form-control-sm"
                                            placeholder="Customer Name">
                                    </div>
                                    <div class="form-group mt-2">
                                        <select name="" id="status_customer" class="form-control form-control-sm">
                                            <option value="1">Active</option>
                                            <option value="0">Non Active</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button class="btn btn-filter btn-sm small btn-primary w-100 text-capitalize">Searching</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end .collapse-->
            </div> <!-- end .mt-2-->

        </div> <!-- end col -->

        {{ $customers->links() }}

    </div>
    <!-- end row-->

</div> <!-- container -->
@push('jsscripts')
<script>
    $(document).ready(function () {
        $('.btn-filter').on('click', function (e) {
            e.preventDefault(); // Prevent default form submission behavior

            const customerValue = $('#customer').val();
            const statusValue = $('#status_customer').val();

            // Make an AJAX request to process the filter
            $.ajax({
                url: '/admin/customers/searching-customers/', // Replace with your route URL
                method: 'GET',
                data: {
                    status: statusValue,
                    customer: customerValue,
                    // Include other parameters here if needed
                },
                success: function (response) {

                    const customerData = response.customerData;

                    console.log(customerData);

                    $('[id^=transactions]').empty();

                    customerData.forEach(function (item) {
                        let statusBadge;

                        if (item.status == 1) {
                            statusBadge = `Active`;
                        } else {
                            statusBadge = 'Non Active'
                        }

                        const date = new Date(item.created_at);

                        const formattedDate = ("0" + date.getDate()).slice(-2) + '-' +
                                            ("0" + (date.getMonth() + 1)).slice(-2) + '-' +
                                            date.getFullYear();

                        const cardContent = `
                                <div class="card" id="transactions">
                                    <div class="card-body">
                                        <!-- task -->
                                        <div class="row justify-content-sm-between">
                                            <div class="col-sm-8 mb-sm-0">
                                                <div class="form-check">
                                                    <a href="/admin/customers/set-sales/${item.id}">
                                                    <p class="fw-bold h5 pt-1 text-muted text-uppercase">
                                                        ${item.name}
                                                    </p>
                                                    </a>
                                                    <p class="form-check-label text-sm small mt-2"><i
                                                            class="ri-qr-code-line text-success"></i>
                                                        ${item.customer_number} <i
                                                            class="ri-map-pin-range-line text-success"></i>${item.address}
                                                    </p>
                                                </div> <!-- end checkbox -->
                                            </div> <!-- end col -->
                                            <div class="col-sm-4">
                                                <div class="d-flex justify-content-between">
                                                    <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item m-1">
                                                                <i class='ri-calendar-todo-fill text-success fs-16 me-1'></i>
                                                                ${formattedDate}
                                                            </li>
                                                            <li class="list-inline-item ms-1 m-2 text-capitalize">
                                                                <i class='ri-rotate-lock-fill text-success fs-16 me-1'></i>
                                                                ${statusBadge}
                                                            </li>
                                                            <li class="list-inline-item ms-1 m-2 text-capitalize">
                                                                <a href="/admin/customers/edit/${item.idEncrypt}">
                                                                    <i class='ri-edit-2-fill text-success fs-16 me-1'></i>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                </div> <!-- end .d-flex-->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end task -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
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
