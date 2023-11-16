<!DOCTYPE html>
<html lang="en">
  @include('tamplate.head')
  <body>
    <!-- Osahan Index -->
    <div class="osahan-index">
      <div
        class="bg-success d-flex align-items-center justify-content-center vh-100"
      >
        <a href="{{route('setup')}}"
          ><img class="index-osahan-logo" src="{{asset('./img/logo.svg')}}" alt="" />
        </a>
      </div>
    </div>
    @include('tamplate.footer')
  </body>
</html>
