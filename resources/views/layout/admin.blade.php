<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>APP </title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
  </head>
  <body>

  @include('admin.nav')


  <div class="container">

    @yield('content')
    </div>

    <script src="{{ asset('vendor/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <link rel="stylesheet" href=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.css') }}"/>
    <script type="text/javascript" src=" {{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

    {{--gulp/elixir next--}}
    <script>
        //to show modal
        $('#flash-overlay-modal').modal();

   // $('div.alert').delay(3000).slideUp(300);
    </script>

    @yield('footer')
    <div class="container">
    <hr/>
    &copy; 2015. GarengStudio
    </div>
  </body>
</html>
