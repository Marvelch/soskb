<!DOCTYPE html>
<html lang="en">
@include('tamplate.head')

<body class="background-setup fixed-bottom-padding d-flex justify-content-center text-center">
    <!-- fixed bottom -->
    <div class="form-group" style="position: absolute; top: 30%;">
        <img src="{{asset('./img/logo-transparent.png')}}" class="logo" alt="" srcset="" style="width: 90%;">
        <p class="small text-muted sub-title">
            Sales Order Management Service
        </p>
    </div>
    <div class="card-setup fixed-bottom fixed-bottom-auto shadow px-4 pt-4 text-center d-grid gap-2">
        <!-- <a href="{{route('login')}}" class="btn btn-light btn-block rounded btn-lg btn-google">
         <i class="icofont-google-plus text-danger me-2"></i> Login
         </a> -->
        <div class="m-2">
            <div class="form-group">
                <a href="{{route('login')}}">
                    <div class="card mb-3" style="border-radius: 10px;">
                        <div class="card-body bg-success" style="border-radius: 10px;">
                            <div class="d-flex bd-highlight text-white">
                                <div class="me-auto bd-highlight">Login</span></div>
                                <div class="bd-highlight"><i class="icofont-arrow-right"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="form-group text-center">
                OR Login With
            </div>
            <div class="form-group mt-3" data-bs-toggle="modal" data-bs-target="#whatsappModal">
                <div class="card mb-4" style="border-radius: 10px;">
                    <div class="card-body bg-success" style="border-radius: 10px;">
                        <div class="d-flex bd-highlight text-white">
                            <div class="me-auto bd-highlight"><img
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/WhatsApp_icon.png/598px-WhatsApp_icon.png"
                                    alt="" srcset="" style="width: 20px;"> <span
                                    style="margin-left: 7px;">Whatsapp</span></div>
                            <div class="bd-highlight"><i class="icofont-arrow-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('tamplate.footer')
    <!-- Modal -->
    <div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body text-start">
                    <img src="https://www.sinch.com/sites/default/files/styles/large_hq/public/image/2021-07/Illustration_mobile_whatsapp.png.webp"
                        class="w-100" alt="" srcset="">
                    <div class="form-group pt-4">
                        <label for="">Nomor Telpon</label>
                        <input type="text" class="form-control form-control-sm shadow">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Whatsapp Activation</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
