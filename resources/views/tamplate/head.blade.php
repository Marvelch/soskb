<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logo.svg">
    <title>OS SKB</title>

    <!-- Jquery -->
    <script src="{{asset('./js/jquery-3.7.0.js')}}"></script>
    <!-- Select2 -->
    <link href="{{asset('./css/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('./js/select2.min.js')}}"></script>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('./vendor/slick/slick.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('./vendor/slick/slick-theme.min.css')}}"/>
    <!-- Icofont Icon-->
    <link href="{{asset('./vendor/icons/icofont.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('./vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('./css/style.css')}}" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="{{asset('./vendor/sidebar/demo.css')}}" rel="stylesheet">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Noto+Sans:wght@300&family=Nunito&family=Open+Sans&family=Oswald&family=Poppins&family=Quicksand:wght@500&family=Roboto+Condensed&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto Condensed', sans-serif;
            background-color: white;
        }

        body.background-setup {
        /* Ensure the background covers the entire viewport */
        background-size: cover;

        /* Center the background image */
        background-position: center;

        /* Set the background to fixed to ensure it stays in place while scrolling */
        background-attachment: fixed;

        /* Apply the background image using the Blade templating asset function */
        /* background-image: url('{{ asset('img/products.svg') }}'); */
        }
    </style>
</head>
