<!DOCTYPE html>
<html lang="en">
@include('tamplate.head')

<body class="fixed-bottom-padding">
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
        </label>
        <em>Enable Dark Mode!</em>
    </div>
    <!-- sign in -->
    <div class="osahan-signin">
        <div class="border-bottom p-3 d-flex align-items-center">
            <a class="fw-bold text-success text-decoration-none" href="{{route('setup')}}"><i
                    class="icofont-rounded-left back-page"></i></a>
        </div>
        <div class="p-3">
            <img src="{{asset('./img/logo-transparent.png')}}" class="w-100 mb-3" alt="" srcset="">
             <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Email</label>
                    <input id="email" placeholder="Enter Email" type="email" class="form-control @error('email') is-invalid @enderror"
                        aria-describedby="emailHelp" name="email" value="{{ old('email') }}" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success btn-lg rounded w-100">Login</button>
            </form>
        </div>
    </div>
    </div>
    @include('tamplate.footer')
</body>

</html>
