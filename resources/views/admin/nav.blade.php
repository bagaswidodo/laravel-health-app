{{--navigation--}}
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
          <a class="navbar-brand" href="{{ URL('#') }}">Administrator Page</a>
      </div>
      <ul class="nav navbar-nav">
          <li><a href="{{ URL('dashboard') }}">Dashboard</a></li>
          <li><a href="{{ url('faskes') }}">Layanan Kesehatan</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
      @if(Auth::guest())
        <li><a href="{{url('/')}}">Frontend</a></li>
      @else
        <li>
            <a href="#" data-toggle="dropdown" aria-expanded="false">Halo,
                <strong>{{ ucfirst(Auth::user()->nama_user) }} </strong> <span class="caret"></span>
            </a>
        	 <ul class="dropdown-menu">
        	    <li><a href="#">Pengaturan Akun</a></li>
        	    <li class="divider"></li>
        	    <li><a href="/auth/logout">Logout</a></li>
        	 </ul>
        </li>
      @endif
      </ul>
    </div>
  </nav>