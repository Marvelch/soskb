@extends('layouts.master')

@section('content')
<div class="osahan-help-ticket">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('edit.sales.orders',['id_transaction'=>$idOriginal])}}">
                <i class="icofont-rounded-left back-page"></i></a>
            <h6 class="fw-bold m-0 ms-3">Detail Sales Order</h6>
        </div>
    </div>
</div>
<div class="p-3">
    <form method="post">
        @csrf
        <div class="card mt-1">
            <div class="card-body">
                <div class="form-group mb-4">
                    <label for="">Pilih Product</label>
                    <select name="product_id" class="product" id="product" class="form-control form-control-sm"
                        style="width: 100%; text-transform:uppercase;" required>
                    </select>
                    @error('customer')
                        <p class="text-sm text-danger">*{{ $message }}</p]>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group mt-2 mb-4">
                            <label for="" class="text-sm">Jumlah (Qty)</label>
                            <input type="text" class="form-control qty form-control-sm" name="qty">
                        </div>
                    </div>
                    <div class="col">
                        <label for="" class="text-sm">Unit</label>
                        <select name="units" id="units" class="w-100 units form-control form-control-sm" style="margin-top: 9px;">
                            @foreach($units as $item)
                                <option value="{{$item->id}}">{{$item->unit}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 mt-2">
                    <button type="button" class="btn btn-add btn-primary w-100">Pilih</button>
                </div>
                <div id="cardContainer">
                    @foreach($products as $item)
                    <div class="col-md-6 mb-3">
                        <div class="card" id="{{$item->product_id}}">
                            <div class="card-body">
                                <div class="d-flex bd-highlight">
                                    <div class="bd-highlight">
                                        <span class="text-sm">Qty : {{@$item->qty}} | {{@$item->units->unit}}</span>
                                    </div>
                                    <div class="ms-auto bd-highlight" id="delete({{$item->product_id}})">
                                        <i class="icofont-trash"></i>
                                    </div>
                                </div>
                                <p class="card-text mt-1">Name: {{@$item->products->product_name}} | {{@$item->products->code}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="form-group mb-3 mt-2 reset-btn">
                    <a href="#" class="btn btn-danger btn-primary w-100">Hapus Semua</a>
                </div>
                <div class="form-group mb-3 mt-2 submit-btn">
                    <button type="button" class="btn btn-submit btn-primary w-100">Kirim</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $('.submit-btn').hide();
    $('.reset-btn').hide();

    var product_list = [];

    (function () {
        @foreach($products as $item)
            var products = {
                id: {!! json_encode($item->product_id) !!},
                qty: {!! json_encode($item->qty) !!},
                name: {!!json_encode($item->products->product_name) !!},
                unit_id: {!! json_encode($item->unit_id) !!},
                unit: {!! json_encode($item->units->unit) !!},
                code: {!! json_encode($item->products->code) !!}
            };

            product_list.push(products);
        @endforeach
    })();

    // Function to generate Bootstrap cards based on product_list
    function generateCards(product_list) {
        let cardContainer = $('#cardContainer');

        // Clear the existing content
        cardContainer.empty();

        // Iterate through the product_list and create cards for each item
        $.each(product_list, function (index, item) {
            let productNameCode = item.name; // Set initial productNameCode to item.name
            if (item.code) {
                productNameCode += " | " + item.code; // Concatenate item.code if it exists
            }

            let card = `
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex bd-highlight">
                                <div class="bd-highlight">
                                    <span class="text-sm">Qty : ${item.qty} | ${item.unit}</span>
                                </div>
                                <div class="ms-auto bd-highlight" id="delete(${item.id})">
                                    <i class="icofont-trash"></i>
                                </div>
                            </div>
                            <p class="card-text mt-1">Name: ${productNameCode}</p>
                        </div>
                    </div>
                </div>
            `;

            // Append each card to the cardContainer
            cardContainer.append(card);
        });
    }

    function appendSubmitButton(productList) {
        if (productList.length > 0) {
            // If product_list has values, append the submit button
            $('.submit-btn').show();
        } else {
            $('.submit-btn').hide();
        }
    }

    $('.btn-add').on('click', function () {
        let hasEmptyField = false;

        $('.product, .qty, .units').each(function () {
            if ($.trim($(this).val()) === '') {
                hasEmptyField = true;
                return false;
            }
        });

        if (hasEmptyField) {
            alert('Penginputan kolom tidak boleh kosong !');
        } else {
            const product_id = $('.product').val();
            const product_qty = $('.qty').val()
            const product_name = $('.product').text();
            const unit_id = $('#units').val();
            const unit = $('#units').find('option:selected').text();

            product_list.push({
                id: product_id,
                qty: product_qty,
                name: product_name,
                unit_id: unit_id,
                unit: unit
            });
        }

        if(product_list.length >= 2) {
            $('.reset-btn').hide();
        }

        generateCards(product_list);
        appendSubmitButton(product_list);

        // reset form input after push to product_list
        $('.product').val('');
        $('.product').text('');
        $('.qty').val('');
        $('.units').val('');
    });

    $(document).on('click', '[id^="delete("]', function () {
        let id = $(this).attr('id').match(/\(([^)]+)\)/)[1];

        // Find the index of the item with the matching ID in the product_list array
        let index = product_list.findIndex(item => item.id == id);

        if (index !== -1) {
            product_list.splice(index, 1); // Remove the item from product_list
        }

        if(product_list.length <= 1) {
            $('.reset-btn').show();
        }

        $('#' + id).closest('.col-md-6').remove(); // Remove the card element from the view

        generateCards(product_list);
        appendSubmitButton(product_list);
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

        // Perform an AJAX POST request
        $.ajax({
            type: 'POST',
            url: "{{ route('edit.product.temp.sales.order', ['id_transaction' => $idOriginal]) }}",
            data: {
                product_list: product_list // Send the product_list data to the server
            },
            success: function (response) {
                window.location.href = '/sales-order/edit/'+response;
            },
            error: function (xhr, status, error) {
                // Handle errors if the AJAX request fails
                console.error(error);
            }
        });
    });

    // searching products
    $('#product').select2({
        ajax: {
            url: '{{route("searching_product")}}',
            dataType: 'json',
            delay: 250,
            processResults: function (productData) {
                return {
                    results: $.map(productData, function (item) {
                        var productName = item.product_name+" | "+item.code;
                        return {
                            text: productName,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('.reset-btn').on('click',function() {
        $.ajax({
            url: "{{route('destory.temporary.product.sales.order')}}",
            type: "GET",
            cache: false,
            success:function(response){
                window.location.href = '/sales-order/product';
            },
            error:function(error) {
                window.location.href = '/sales-order/product';
            }
        });
    });
</script>
@endsection
