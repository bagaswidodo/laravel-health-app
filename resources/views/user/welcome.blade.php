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

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('vendor/flatty/main.css') }}" rel="stylesheet">

    <!-- Fonts from Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>




    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
					<h1>Temukan Layanan Kesehatan Sekitar Anda </h1>
					<?php //echo form_open('health/find', array('class' => 'form-inline', 'role' => 'form')); ?>
					<!--<form class="form-inline" role="form">-->
					  <div class="form-group">
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
		<p class="pull-right"><small>Created by BlackTie.co - Attribution License 3.0 - Engine By 672011199.
			 //echo anchor('', 'About') . " | " . anchor('#', 'How To') . " | " .anchor('#','API')</small></p>
	</div><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  <script type="text/javascript" src="{{ asset('vendor/jquery/js/jquery-1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" type="text/css" media="all" />

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
            alert('Empty');
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

            }, showError);
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
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                x.innerHTML = alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = alert("An unknown error occurred.");
                break;
        }
    }


  </script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  </body>
</html>
