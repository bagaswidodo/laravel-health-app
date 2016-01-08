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
		<?php 

		$icon = array('glyphicon-plus','glyphicon-home','glyphicon-bed','glyphicon-user','glyphicon-user','glyphicon-user',
			'glyphicon-record');

		$i = 1;
		$tipe = [1 => 'Rumah sakit',
					2 => 'Klinik',
					3 => 'Puskesmas',
					4 => 'Dokter Umum',
					5 => 'Dokter Spesialis',
					6 => 'Dokter gigi',
					7 => 'Bidan'];

		foreach ($tipe as $v) {
		?>
			<li>
				<a href="#" onclick="filter('{{ $i }}')">
					<i class="glyphicon {{ $icon[$i-1] }}" ></i>{{ $v }}
				</a>
			</li>
		
		<?php
			 $i++;
		}

		?>
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