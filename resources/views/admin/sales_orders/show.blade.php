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
                <!-- <h4 class="page-title">
                    Daftar Transaksi
                </h4> -->
            </div>
            <!-- end page title -->

            <!-- tasks panel -->
            <div class="mt-5">
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
                            @foreach($transactions as $item)
                            <a
                                href="{{route('admin.detail.transaction',['id'=>Crypt::encryptString($item->id_transaction)])}}" id="transactions">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- task -->
                                        <div class="row justify-content-sm-between">
                                            <div class="col-sm-6 mb-sm-0">
                                                <div class="form-check">
                                                    <p class="fw-bold h5 text-muted text-uppercase">
                                                        {{@$item->customers->name}}
                                                    </p>
                                                    <p class="form-check-label text-sm">#{{@$item->id_transaction}}</p>
                                                </div> <!-- end checkbox -->
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="d-flex justify-content-between">
                                                    <div id="tooltip-container">
                                                        @if($item->status == 1)
                                                        <p class="form-check-label small text-capitalize"><span
                                                                class="badge bg-success-subtle text-success p-1">On
                                                                Progress</span></p>
                                                        @elseif($item->status == 2)
                                                        <p class="form-check-label small text-capitalize"><span
                                                                class="badge bg-primary-subtle text-primary p-1">Completed</span>
                                                        </p>
                                                        @elseif($item->status == 3)
                                                        <p class="form-check-label small text-capitalize"><span
                                                                class="badge bg-danger-subtle text-danger p-1">Canceled</span>
                                                        </p>
                                                        @elseif($item->status == 4)
                                                        <p class="form-check-label small text-capitalize"><span
                                                                class="badge bg-warning-subtle text-warning p-1">Delivered</span>
                                                        </p>
                                                        @elseif($item->status == 5)
                                                        <p class="form-check-label small text-capitalize"><span
                                                                class="badge bg-info-subtle text-info p-1">Warehouse Processing</span>
                                                        </p>
                                                        @else
                                                        <p class="form-check-label small text-capitalize"><span
                                                                class="badge bg-danger-subtle text-danger p-1">Error</span>
                                                        </p>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item">
                                                                <i class='ri-timer-line fs-16 me-1'></i>
                                                                {{@date('d-m-Y h:m A',strtotime($item->created_at))}}
                                                            </li>
                                                            <li class="list-inline-item ms-1 text-capitalize">
                                                                <i class='ri-user-follow-line fs-16 me-1'></i>
                                                                {{@strtolower($item->users->name)}}
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
                                    <div class="form-group">
                                        <input type="text" id="customers" class="form-control form-control-sm"
                                            placeholder="Searching Customer Name" style="font-size: 12px;">
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mt-2">
                                            <input type="date" name="" id="start" class="form-control form-control-sm"
                                                value="{{@date('Y-m-d',strtotime(now()))}}" style="font-size: 12px;">
                                        </div>
                                        <div class="col-6 mt-2">
                                            <input type="date" name="" id="end" class="form-control form-control-sm small"
                                                value="{{@date('Y-m-d',strtotime(now()))}}" style="font-size: 12px;">
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <select name="" id="status_so" class="form-control form-control-sm small" style="font-size: 12px;">
                                            <option value="1">On Progress</option>
                                            <option value="2">Completed</option>
                                            <option value="3">Cancelled</option>
                                            <option value="4">Delivered</option>
                                            <option value="5">Warehouse Processing</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button class="btn btn-filter btn-sm small btn-primary w-100"><i class="ri-search-2-line"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end .collapse-->
            </div> <!-- end .mt-2-->

        </div> <!-- end col -->

        {{ $transactions->links() }}

    </div>
    <!-- end row-->

</div> <!-- container -->
@push('jsscripts')
    <script>
        $(document).ready(function() {
            $('.btn-filter').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission behavior

                const customersValue = $('#customers').val();
                const startValue = $('#start').val();
                const endValue = $('#end').val();
                const statusValue = $('#status_so').val();

                // Make an AJAX request to process the filter
                $.ajax({
                    url: "{{route('admin.searching.transaction')}}", // Replace with your route URL
                    method: 'GET',
                    data: {
                        status: statusValue,
                        customer: customersValue,
                        start: startValue,
                        end: endValue,
                        // Include other parameters here if needed
                    },
                    success: function(response) {

                        // Update card content with fetched data
                        const salesOrderData = response.salesOrderData;

                        // Clear existing card content before appending new data
                        $('[id^=transactions]').empty();

                        // Iterate through each sales order item and create card elements
                        salesOrderData.forEach(function(item) {
                            let statusBadge;

                            if (item.status == 1) {
                                statusBadge = `<span class="badge bg-success-subtle text-success p-1">On Progress</span>`;
                            } else if (item.status == 2) {
                                statusBadge = `<span class="badge bg-primary-subtle text-primary p-1">Completed</span>`;
                            } else if (item.status == 3) {
                                statusBadge = `<span class="badge bg-danger-subtle text-danger p-1">Canceled</span>`;
                            } else if (item.status == 4) {
                                statusBadge = `<span class="badge bg-warning-subtle text-warning p-1">Delivered</span>`;
                            } else if (item.status == 5) {
                                statusBadge = `<span class="badge bg-info-subtle text-info p-1">Warehouse Processing</span>`;
                            } else {
                                statusBadge = `<span class="badge bg-danger-subtle text-danger p-1">Erro</span>`;
                            }

                            const encryptedIdTransaction = '{{ Crypt::encryptString(@$item->id_transaction) }}';

                            const cardContent = `
                                <a href="/admin/sales-orders/detail/${encryptedIdTransaction}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row justify-content-sm-between">
                                                <div class="col-sm-6 mb-sm-0">
                                                    <div class="form-check">
                                                        <p class="fw-bold h5 text-muted text-uppercase">
                                                            ${item.customer_name}
                                                        </p>
                                                        <p class="form-check-label text-sm text-muted">#${item.id_transaction}</p>
                                                        <!-- Add other item details here -->
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="d-flex justify-content-between">
                                                    <div class="form-check-label text-muted small text-capitalize">
                                                        ${statusBadge}
                                                    </div>
                                                    <div>
                                                        <ul class="list-inline fs-13 text-end">
                                                            <li class="list-inline-item text-muted">
                                                                <i class='ri-timer-line text-muted fs-16 me-1'></i>
                                                                ${item.so_date}
                                                            </li>
                                                            <li class="list-inline-item ms-1 text-capitalize text-muted">
                                                                <i class='ri-user-follow-line text-muted fs-16 me-1'></i>
                                                                ${item.created_by}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            `;

                            // Append the card content to the card container
                            $('#transactions').append(cardContent);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Handle error if necessary
                    }
                });
            });
        });
    </script>
@endpush
@endsection
