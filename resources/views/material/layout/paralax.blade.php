<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Frontend - Homepage</title>

  <!-- CSS  -->
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
  <link href="{{ asset('/css/material.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  
  <link rel="stylesheet" href="{{ asset('/font/material-icon/material-icons.css') }}">
  <style>
  /*for typing animation*/
    .typed-cursor{
    opacity: 1;
    -webkit-animation: blink 0.7s infinite;
    -moz-animation: blink 0.7s infinite;
    animation: blink 0.7s infinite;
}
@keyframes blink{
    0% { opacity:1; }
    50% { opacity:0; }
    100% { opacity:1; }
}
@-webkit-keyframes blink{
    0% { opacity:1; }
    50% { opacity:0; }
    100% { opacity:1; }
}
@-moz-keyframes blink{
    0% { opacity:1; }
    50% { opacity:0; }
    100% { opacity:1; }
}


  </style>
</head>
<body>
  @include('material.nav')

  @yield('content')
  <!-- end container -->
<footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
      <div class="row">
        <div class="col s6">UI oleh <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a></div>
        <div class="col s6 right-align">
          Engine by Laravel
        <!-- How To | About | API -->
        </div>
      </div>
      </div>

    </div>
  </footer>


  <!--  Scripts-->
  <!-- <script src="{{ asset('vendor/jquery/js/jquery.min.js') }}"></script> -->
  <script src="{{ asset('js/frontend.js') }}"></script>
  <script src="{{ asset('vendor/typed/typed.min.js') }}"></script>
  <script src="{{ asset('js/material.js')}}"></script>
  <script>  
  $(function(){
        $(".element").typed({
            strings: ["Rumah Sakit","Puskesmas","Klinik", "Dokter Umum", "Dokter Gigi", "Layanan Kesehatan"],
            typeSpeed: 0
        });
    });
  </script>

  @yield('coding')


</body>