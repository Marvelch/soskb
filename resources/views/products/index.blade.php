@extends('layouts.master')

@section('content')
<div class="osahan-help-ticket">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('home')}}">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">Product List</h6>
        </div>
    </div>
</div>
<div class="osahan-order">
    <div class="order-body px-3 pt-3">
        <div class="mb-3">
            <!-- Search input field -->
            <input type="text" class="form-control w-40" id="searchInput" placeholder="Cari Produk">
        </div>
        @foreach($productData as $item)
        <div class="pb-3 osahan-order-detail">
            <a class="text-decoration-none text-dark">
                <div class="p-3 rounded shadow-sm bg-white">
                    <div class="d-flex align-items-center mb-3">
                        @if( @$item['status'] == 't' OR @$item['status'] == 1)
                        <p class="bg-success text-white py-1 px-2 mb-0 rounded small">Active</p>
                        @else
                        <p class="bg-danger text-white py-1 px-2 mb-0 rounded small">Not active</p>
                        @endif
                        <p class="text-muted ms-auto small mb-0"><i class="icofont-clock-time"></i> {{ date('d/m/Y',strtotime(@$item['created_at'])) }}</p>
                    </div>
                    <div class="d-flex">
                        <p class="text-muted m-0">{{ @$item['product_name'] }}<br>
                            <span class="text-dark fw-bold">{{ @$item['code'] }}</span>
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
                var productName = $(this).find('.text-muted:first-child').text().toLowerCase();
                var productCode = $(this).find('.fw-bold').text().toLowerCase();
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
