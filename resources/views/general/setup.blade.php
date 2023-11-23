<!DOCTYPE html>
<html lang="en">
   @include('tamplate.head')
   <body class="background-setup fixed-bottom-padding">
      <!-- Account Setup -->
      <div class="osahan-account-setup">
         <a class="p-4 text-white font-weight-bold d-flex align-items-center h4 text-decoration-none" href="{{route('home')}}">
         <img class="as-osahan-logo" src="{{asset('img/logo.png')}}">
         </a>
      </div>
      <!-- fixed bottom -->
      <div class="fixed-bottom fixed-bottom-auto px-4 pt-4 text-center d-grid gap-2">
         <!-- <a href="{{route('login')}}" class="btn btn-light btn-block rounded btn-lg btn-google">
         <i class="icofont-google-plus text-danger me-2"></i> Login
         </a> -->
         <a href="{{route('login')}}" class="btn btn-success rounded btn-block btn-lg">
         Login
         </a>
         <a href="signin.html" class="text-white btn btn-sm btn-block text-decoration-none mb-2">
            <!-- kosong -->
         </a>
      </div>
      @include('tamplate.footer')
   </body>
</html>
