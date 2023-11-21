<!DOCTYPE html>
<html lang="en">
   @include('tamplate.head')
   <body class="fixed-bottom-padding">
        @include('sweetalert::alert')
        @yield('content')
        @include('layouts.menu')
        @include('layouts.nav')
        @include('tamplate.footer')
   </body>
</html>
