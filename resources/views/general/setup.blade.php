<!DOCTYPE html>
<html lang="en">
@include('tamplate.head')

<body class="background-setup fixed-bottom-padding d-flex justify-content-center text-center">
    <!-- fixed bottom -->
    <div class="form-group setup">
        <img src="{{asset('./img/logo-transparent.png')}}" class="logo" alt="" srcset="">
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
                <a href="{{route('login')}}" class="btn bg-success btn-block mb-4 btn-lg" style="border-radius: 10px;">
                    Login
                </a>
            </div>
        </div>
    </div>
    @include('tamplate.footer')
</body>

</html>
