
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>@yield('titulo')</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset("vendor/bootstrap/css/bootstrap.min.css") }}">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset("assets/css/fontawesome.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/templatemo-digimedia-v3.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/animated.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/owl.css") }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    @yield('css')
  </head>
<body>
  @include('layouts.portal.spiner')
  @yield('contenido')
  



  <!-- Scripts -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/animation.js') }}"></script>
  <script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
  @yield('js')
  

</body>
</html>