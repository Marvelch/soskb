<!DOCTYPE html>
<html lang="en">
@include('tamplate.head')

<body class="fixed-bottom-padding">
    <!-- sign in -->
    <div class="osahan-signin">
        <div class="border-bottom p-3 d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('setup_general')}}"><i
                    class="icofont-rounded-left back-page"></i></a>
        </div>
        <div class="p-3">
            <div class="d-flex justify-content-center">
                <img src="https://static.vecteezy.com/system/resources/previews/005/647/961/non_2x/illustration-isometric-concept-personal-account-security-process-free-vector.jpg" class="w-100" alt="" srcset="">
            </div>
             <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3 mt-3">
                    <label for="exampleInputEmail1">Email</label>
                    <input id="email" type="email" class="form-control mt-1 @error('email') is-invalid @enderror"
                        aria-describedby="emailHelp" name="email" value="{{ old('email') }}" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input id="password" type="password" class="form-control mt-1 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success btn-lg rounded w-100 mt-3">Login</button>
                <div class="form-group text-center mt-5">
                    <p class="small text-muted" style="font-size: 10px;">Powered by Information Technology</p>
                </div>
            </form>
        </div>
    </div>
    </div>
    @include('tamplate.footer')
</body>

</html>
