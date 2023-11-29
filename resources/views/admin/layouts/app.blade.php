<!DOCTYPE html>
<html lang="en" data-layout="topnav" data-menu-color="brand">

@include('admin.layouts.head')

<body>
    @include('sweetalert::alert')
    <!-- Begin page -->
    <div class="wrapper">

        @include('admin.layouts.topbar')
        @include('admin.layouts.horizontal-nav')

        <div class="content-page">
        <div class="content">
        @yield('content')

        </div>
    <!-- content -->

        @include('admin.layouts.footer')

    </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @stack('jsscripts')

    <!-- Vendor js -->
    <script src="{{asset('admin/js/vendor.min.js')}}"></script>

    <!-- Daterangepicker js -->
    <script src="{{asset('admin/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admin/vendor/daterangepicker/daterangepicker.js')}}"></script>

    <!-- Apex Charts js -->
    <script src="{{asset('admin/vendor/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector Map js -->
    <script src="{{asset('admin/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('admin/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>

    <!-- Dashboard App js -->
    <script src="{{asset('admin/js/pages/demo.dashboard.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('admin/js/app.min.js')}}"></script>

    <link href="{{asset('admin/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('admin/js/select2.min.js')}}"></script>

</body>

</html>
