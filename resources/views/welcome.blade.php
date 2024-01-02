<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Include your necessary CSS and meta tags -->
  @include('tamplate.head')
  <style>
    .osahan-index {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #28a745; /* You can change this to your desired background color */
    }

    .index-osahan-logo {
      /* Add your styles for the logo if needed */
    }
  </style>
</head>
<body>
  <!-- Osahan Index -->
  <div class="osahan-index">
    <a href="{{route('setup_general')}}">
      <img class="index-osahan-logo" src="{{asset('./img/logo.png')}}" alt="" />
    </a>
  </div>
  @include('tamplate.footer')
</body>
</html>
