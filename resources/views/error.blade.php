<!DOCTYPE html>
<html lang="en">
@include('tamplate.head')

<body>
    <!-- Osahan Index -->
    <div class="osahan-index">
        <div class="bg-success d-flex align-items-center justify-content-center vh-100">
            <div class="row">
                <div class="col-md-12 d-flex align-items-center justify-content-center ">
                    <a href="{{route('setup_general')}}"><img class="index-osahan-logo"
                            src="{{asset('./img/logo.png')}}" alt="" />
                    </a>
                </div>
                <div class="col-md-12 text-center mt-3">
                    <h6 class="text-white">Only Mobile Devices Allowed</h6>
                </div>
            </div>

        </div>
    </div>
    @include('tamplate.footer')
</body>

</html>
