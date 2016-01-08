<!-- bottom nav -->
	<!-- centered menu -->
	<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<!-- container -->
	<div class="container">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
	  </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
           <li>
           	<a href="{{ url('nearby/' . $location) }}"><i class="glyphicon glyphicon-home" ></i> Kembali ke Pencarian</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
          	<!-- <li>Weather</li> -->
          	<li>
				<span id="hours"></span>
             	<span id="point">:</span>
              	<span id="min"></span>
              	<span id="point">:</span>
              	<span id="sec"></span>
              	<div id="Date"></div>
             </li>
          </ul>
	  </div><!-- /.navbar-collapse -->
	  </div><!-- container -->
	</nav>
	<!-- bottom nav -->