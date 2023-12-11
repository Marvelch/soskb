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
                            <a href="{{route('admin.customers.set.sales',['id'=>Crypt::encryptString($item->id)])}}"
                                id="transactions">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- task -->
                                        <div class="row justify-content-sm-between">
                                            <div class="col-sm-6 mb-sm-0">
                                                <div class="form-check">
                                                    <p class="fw-bold h5 text-muted text-uppercase">
                                                        {{@$item->name}}
                                                    </p>
                                                    <p class="form-check-label text-sm small"><i class="ri-qr-code-line text-success"></i> #{{@$item->customer_number}} <i class="ri-map-pin-range-line text-success"></i>{{@$item->address}}</p>
                                                </div> <!-- end checkbox -->
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="d-flex justify-content-between">
                                                    <div id="tooltip-container">
                                                        @if($item->status == 1)
                                                        <p class="form-check-label small text-capitalize"><span
                                                                class="badge bg-success-subtle text-success p-1">Active</span>
                                                        </p>
                                                        @else
                                                        <p class="form-check-label small text-capitalize"><span
                                                                class="badge bg-danger-subtle text-danger p-1">Non
                                                                Active</span>
                                                        </p>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item ms-1 text-capitalize">
                                                                <i class='ri-user-settings-line fs-16 me-1'></i>
                                                                SET SALES
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> <!-- end .d-flex-->
                                            </div> <!-- end col -->
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
                                        <input type="text" id="customer" class="form-control form-control-sm"
                                            placeholder="Searching...">
                                    </div>
                                    <div class="form-group mt-2">
                                        <select name="" id="status_customer" class="form-control form-control-sm">
                                            <option value="1">Active</option>
                                            <option value="0">Non Active</option>
                                        </select>
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
                url: '/admin/products/searching/', // Replace with your route URL
                method: 'GET',
                data: {
                    status: statusValue,
                    product: customerValue,
                    // Include other parameters here if needed
                },
                success: function (response) {

                    console.log(response);
                    // Update card content with fetched data
                    const productData = response.productData;

                    // Clear existing card content before appending new data
                    $('[id^=transactions]').empty();

                    productData.forEach(function (item) {
                        let statusBadge;

                        if (item.status == 1) {
                            statusBadge =
                                `<span class="badge bg-warning-subtle text-primary p-1">Active</span>`;
                        } else {
                            statusBadge =
                                `<span class="badge bg-danger-subtle text-danger p-1">Non Active</span>`;
                        }

                        const encryptedIdTransaction = '{{ Crypt::encryptString(@$item->id) }}';

                        const cardContent = `
                                <a href="/admin/products//set-sales//${encryptedIdTransaction}">
                                    <div class="card">
                                    <div class="card-body">
                                        <!-- task -->
                                        <div class="row justify-content-sm-between">
                                            <div class="col-sm-6 mb-sm-0">
                                                <div class="form-check">
                                                    <p class="fw-bold h5 text-muted text-uppercase">
                                                        ${item.product_name}
                                                    </p>
                                                    <p class="form-check-label text-sm">#{{@$item->code}}</p>
                                                </div> <!-- end checkbox -->
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-check-label text-muted small text-capitalize">
                                                        ${statusBadge}
                                                    </div>
                                                    <div>
                                                        <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item ms-1 text-capitalize">
                                                                <i class='ri-user-settings-line fs-16 me-1'></i>
                                                                SET SALES
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> <!-- end .d-flex-->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end task -->

                                    </div> <!-- end card-body-->
                                </div>
                                </a>
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
