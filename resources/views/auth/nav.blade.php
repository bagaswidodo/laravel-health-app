{{--navigation--}}
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
          <a class="navbar-brand" href="{{ URL('pegawai') }}">Administrator Page</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
      @if(Auth::guest())
        <li><a href="{{url('/')}}">Frontend</a></li>
      @else
        <li>
            <a href="#" data-toggle="dropdown" aria-expanded="false">Logged user <span class="caret"></span></a>
        	 <ul class="dropdown-menu">
        	    <li><a href="#">Pengaturan Akun</a></li>
        	    <li class="divider"></li>
        	    <li><a href="#">Logout</a></li>
        	 </ul>
        </li>
      @endif
      </ul>
    </div>
  </nav>