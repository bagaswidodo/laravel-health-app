<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>APP </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend.css') }}">
  </head>
  <body>

  @include('admin.nav')


  <div class="container">

    @yield('content')
    </div>

    <script src="{{ asset('js/backend.js') }}"></script>
    <script>
        //to show modal
        // $('#flash-overlay-modal').modal();
        // $('div.alert').delay(3000).slideUp(300);
    </script>

    @yield('footer')
    <div class="container">
    <hr/>
    &copy; 2015. GarengStudio
    </div>
  </body>
</html>
