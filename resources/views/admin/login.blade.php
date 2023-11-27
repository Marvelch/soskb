<html>
@include('./admin/layouts.head')
<body class="authentication-bg pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">

            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="index.php" class="logo-dark">
                        <span><img src="{{asset('admin/images/logo-transparent.png')}}" alt="dark logo" height="22"></span>
                    </a>
                    <a href="index.php" class="logo-light">
                        <span><img src="{{asset('admin/images/logo-transparent.png')}}" alt="logo" height="22"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-0">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access account.</p>

                    <!-- form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control mt-1 @error('email') is-invalid @enderror" name="email" id="email" type="email" required value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <a href="auth-recoverpw-2.php" class="text-muted float-end"><small>Forgot your password?</small></a>
                            <label for="password" class="form-label">Password</label>
                            <input  name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" required="" autocomplete="current-password">
                             @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button type="submit" class="btn btn-primary"><i class="ri-login-box-line"></i> Log In </button>
                        </div>
                    </form>
                    <!-- end form-->
                </div>

            </div> <!-- end .card-body -->
        </div>
        <!-- end auth-fluid-form-box-->

    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
