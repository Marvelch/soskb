@extends('layouts.master')

@section('content')
<div class="osahan-order">
    <div class="order-menu">
        <h5 class="fw-bold p-3 d-flex align-items-center">Customer List</h5>
    </div>
    <div class="order-body px-3 pt-3">
        <div class="mb-3">
            <!-- Search input field -->
            <input type="text" class="form-control w-40" id="searchInput" placeholder="Cari Produk">
        </div>
        @foreach($customers as $item)
        <div class="pb-3 osahan-order-detail">
            <a class="text-decoration-none text-dark">
                <div class="p-3 rounded shadow-sm bg-white">
                    <div class="d-flex align-items-center mb-3">
                        @if(@$item->status == 't' OR @$item->status == 1)
                        <p class="bg-success text-white py-1 px-2 mb-0 rounded small">Active</p>
                        @else
                        <p class="bg-danger text-white py-1 px-2 mb-0 rounded small">Not active</p>
                        @endif
                        <p class="text-muted ms-auto small mb-0"><i class="icofont-clock-time"></i> {{date('d-m-Y',strtotime(@$item->created_at))}} | {{@$item->customer_number}}</p>
                    </div>
                    <div class="d-flex">
                        <p class="text-dark m-0 fw-bold">{{@$item->name}}<br>
                            <span class="text-muted">{{@$item->address}}</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            var searchValue = $('#searchInput').val().toLowerCase();
            $('.osahan-order-detail').each(function () {
                var customerName = $(this).find('.text-muted:first-child').text().toLowerCase();
                var customerCode = $(this).find('.fw-bold').text().toLowerCase();
                if (customerName.includes(searchValue) || customerCode.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });

</script>
@endpush
@endsection
