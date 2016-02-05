<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>Aplikasi Pencarian Layanan Kesehatan Terdekat</title>
    <link rel="stylesheet" type="text/css" href="css/frontend.css">
    <!-- Bootstrap core CSS -->
    <!-- <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <!-- <link href="{{ asset('vendor/flatty/main.css') }}" rel="stylesheet"> -->

    <!-- Fonts from Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b>SEHAT</b></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('faskes') }}">Backend</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div id="headerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h2>Temukan <span class="element"></span> Sekitar Anda </h2>
					<?php //echo form_open('health/find', array('class' => 'form-inline', 'role' => 'form')); ?>
					<!--<form class="form-inline" role="form">-->
					  <div class="form-group">
            <span class="alert alert-danger" id="kesalahan" style="display:none"></span>
					    <input type="text" class="form-control" id="lokasi" name="lokasi"
              placeholder="Lokasi . . ." required>
					   <input class="form-control" type="hidden" id="koordinat"></input>
            </div>
            
					  <?php
					//echo anchor('welcome/locations','<button type="submit" class="btn btn-warning btn-lg">Temukan</button>');
					  ?>
					  <button type="button" class="btn btn-warning btn-lg" id="temukan">Temukan</button>
					  <button type="button" class="btn btn-warning btn-lg" id="temukan_geo">Temukan Geo</button>
					</form>
				</div><!-- /col-lg-6 -->
				<div class="col-lg-6">
					<img class="img-responsive" src="{{ asset('vendor/flatty/ipad-hand.png') }}" alt="">
				</div><!-- /col-lg-6 -->

			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->





	<div class="container">
		<hr />
		  <p class="pull-right">
       <small>Theme by BlackTie.co - code  672011199.
         <a href="{{url('#')}}">About</a> | 
         <a href="{{url('#')}}">How To</a> | 
  			 <a href="{{url('#')}}">API</a> | 
       </small>
      </p>
	</div><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  <script src="js/frontend.js"></script>
  <script src="{{ asset('js/lib/typed.min.js') }}"></script>
  <!-- <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" type="text/css" media="all" /> -->

    <script type='text/javascript'>
        $(this).ready( function() {
        $("#lokasi").autocomplete({
          minLength: 1,
          source:
          function(req, add){
              $.ajax({
              url: "lokasi",
                dataType: 'json',
                type: 'GET',
                data: req,
                success:

                function(data){
                console.log(data);

                    if(data.response ==true){
                      add(data.message);

                    }
                },
                });
          },
         select:
          function(event, ui) {
            $("#koordinat").val( ui.item.id );
          },
      });
    });


    var path = 'nearby';
    $('#temukan').click(function(){
        var koordinat = $('#koordinat').val();
        console.log(koordinat);

        if(koordinat == "")
        {
            // alert('Empty');
            $('#kesalahan').show();
            $('#kesalahan').html('Anda belum memilih lokasi')
        }
        else
        {
           window.location = path + "/" + koordinat;
        }

    });


    $('#temukan_geo').click(function(){
        //var koordinat = $('#koordinat').val();

        //begin geo function
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function showPosition(position)
            {
              koordinat = position.coords.latitude + "," + position.coords.longitude;
              window.location = path + "/" + koordinat;

            }, showError, {timeout: 5000});
        } else {
            alert("Geolocation is not supported by this browser.");
            history.back();
        }
        //end geo function



    });//end temukan geo click function


    //additional function
    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("Pengguna tidak mengijinkan mengakses lokasi");
            break;
            case error.POSITION_UNAVAILABLE:
                alert("Lokasi informasi tidak tersedia.");
                // x.innerHTML = alert("Location information is unavailable.");
            break;
            case error.TIMEOUT:
                alert("Permintaan lokasi pengguna telah habis");
                // x.innerHTML = alert("The request to get user location timed out.");
            break;
            case error.UNKNOWN_ERROR:
                alert("Ooops, Sepertinya terjadi kesalahan");
                // x.innerHTML = alert("An unknown error occurred.");
            break;
        }
    }


  </script>
  <script>
  $(function(){
        $(".element").typed({
            strings: ["Rumah Sakit","Puskesmas","Klinik", "Dokter Umum", "Dokter Gigi", "Layanan Kesehatan"],
            typeSpeed: 0
        });
    });
  </script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  </body>
</html>
