@extends('layouts.master')

@section('content')
<div class="osahan-help-ticket">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('show_transaction',['id'=>$idOriginal])}}">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">Pilih Customer</h6>
        </div>
    </div>
</div>
<div class="p-3">
    <form action="{{route('update.customer.sales.orders',['id_transaction'=>$idOriginal])}}" method="post">
        @method('PUT')
        @csrf
        <div class="card mt-1">
            <div class="card-body">
                <select name="customer_id" class="customer" id="customer" class="form-control form-control-sm" name="customer"
                    style="width: 100%; text-transform:uppercase;" required>
                </select>
                @error('customer')
                <p class="text-sm text-danger">*{{ $message }}</p]>
                    @enderror
                    <div class="form-group mb-3 mt-2">
                        <button type="submit" class="btn btn-primary w-100">Pilih</button>
                    </div>
            </div>
        </div>
    </form>
</div>
<script>
    $('#customer').select2({
        ajax: {
            url: '{{route("searching_customer")}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

</script>
@endsection
