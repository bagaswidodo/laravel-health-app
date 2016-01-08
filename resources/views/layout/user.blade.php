<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>APP </title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.css') }}">

  </head>
  <body>
  {{--navigation--}}
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
          <a class="navbar-brand" href="{{ URL('/') }}">Sehat</a>
      </div>
         <div class="navbar-form-alt col-md-8" style="margin-top:10px">
        			     <form class="form-group" method="post" action="lookup">
        			        <div class="input-group">
        			           <input type="text" class="form-control inputAB" id="lokasi" name="loc" placeholder="Search">
        			           <input type="hidden" class="form-control inputAB" id="koordinat" name="latlng" placeholder="Search">

        			           <span class="input-group-btn">
        					    <button class="btn btn-success" id="temukan" type="button">Cari</button>
        					    <button class="btn btn-info" id="temukan_geo" type="button">Temukan Saya</button>
        			           </span>
        			        </div>
        			     </form>
        			  </div>



      <ul class="nav navbar-nav navbar-right">
        @if(Auth::guest())
        <li><a href="{{url('auth/login')}}">Login</a></li>
        @else
        <li>
            <a href="#" data-toggle="dropdown" aria-expanded="false">Akun <span class="caret"></span></a>
        	  <ul class="dropdown-menu">
        	    <li><a href="#">Action</a></li>
        	    <li><a href="#">Another action</a></li>
        	    <li><a href="#">Something else here</a></li>
        	    <li class="divider"></li>
        	    <li><a href="#">Separated link</a></li>
        	  </ul>
        </li>
        @endif
      </ul>
    </div>
  </nav>


  <div class="container">

    @yield('content')
    </div>

    <script src="{{ asset('vendor/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script> 
    <script src="{{ asset('vendor/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>


    @yield('scripts')
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
