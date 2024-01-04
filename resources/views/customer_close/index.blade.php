@extends('layouts.master')

@section('content')
<div class="osahan-help-ticket">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('home')}}">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">Close Customers</h6>
        </div>
    </div>
</div>
<div class="osahan-order">
    <div class="order-body p-3">
        <div class="mb-3">
            <!-- Search input field -->
            <input type="text" class="form-control w-40" id="searchInput" placeholder="Customer Name">
        </div>
        <div class="pb-3">
            @foreach($salesOrderData as $item)
                <div class="p-3 rounded shadow-sm bg-white osahan-order-detail">
                    <div class="d-flex align-items-center mb-3">
                        <p class="text-white py-1 px-2 rounded small m-0 text-capitalize">
                            <span class="text-dark fw-bold">{{@$item->name}}</p>
                        <p class="text-muted ms-auto small m-0"></p>#{{@$item->customer_number}}</p>
                    </div>
                    <div class="d-flex">
                        <p class="text-muted m-0 ml-4 px-2 small text-capitalize"><i class="icofont-location-pin text-success"></i> {{strtolower(@$item->address)}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#searchInput').on('keyup', function () {
            var searchValue = $('#searchInput').val().toLowerCase();
            $('.osahan-order-detail').each(function () {
                var productName = $(this).find('.fw-bold').text().toLowerCase();
                var productCode = $(this).find('.text-muted:first-child').text().toLowerCase();
                if (productName.includes(searchValue) || productCode.includes(searchValue)) {
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
