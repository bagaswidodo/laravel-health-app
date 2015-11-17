<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>APP </title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
  </head>
  <body>

  @include('auth.nav')


  <div class="container">

    @yield('content')
    </div>

    <script src="{{ asset('vendor/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    @yield('footer')
    <div class="container">
    <hr/>
    &copy; 2015. GarengStudio
    </div>
  </body>
</html>
