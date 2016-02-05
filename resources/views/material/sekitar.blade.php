@extends('material.layout.paralax')

@section('content')	
    <!-- fab button -->

   <div class="fixed-action-btn vertical" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
      <i class="large material-icons" title="Filter Pencarian">home</i>
    </a>
    <ul>
      <li><a class="btn-floating yellow darken-1" title="rumah sakit" onclick="filter(1)"><i class="material-icons">business</i></a></li>
      <li><a class="btn-floating red" title="klinik"><i class="material-icons" onclick="filter(2)">home</i></a></li>
      <li><a class="btn-floating green" title="Dokter Umum"><i class="material-icons" onclick="filter(4)">contacts</i></a></li>
      <li><a class="btn-floating blue"><i class="material-icons" onclick="filter(6)">perm_identity</i></a></li>
      <!-- <li><a class="btn-floating blue"><i class="material-icons">search</i></a></li> -->
    </ul>
  </div>



  <!-- container -->
  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m12" >
         <h1>Sekitar</h1>
         <p id="geocode"></p>
         <hr>
         <!-- Switch -->
         <div id="control">
         	<div class="col s6 m6">
	            <div class="switch" >
	              <label>
	                Semua
	                <input type="checkbox" checked="checked" id="switcher">
	                <span class="lever"></span>
	                Buka
	              </label>
	            </div>
            </div>
            <input type="hidden" id="jarak">
            <input type="hidden" id="status">
			
			<div class="col s6 m6">
	           	<a class="waves-effect waves-light btn" id="btn1">1 KM</a>
				<a class="waves-effect waves-light btn" id="btn2">2 KM</a>
				<a class="waves-effect waves-light btn" id="btn3">3 KM</a>
			</div>
		</div>


            <!-- end switch -->
            <div class="row"><br><br></div>

           <div class="preloader-wrapper big active" style="display:none" id="preloader">
		      <div class="spinner-layer spinner-blue">
		        <div class="circle-clipper left">
		          <div class="circle"></div>
		        </div><div class="gap-patch">
		          <div class="circle"></div>
		        </div><div class="circle-clipper right">
		          <div class="circle"></div>
		        </div>
		      </div>
	      </div>

			<!-- faskes -->
				<ul class="collection" id="laykes">
				</ul>

				<div id="faskes">
	         	<ul class="collection">
	         	@foreach($nearby as $n)
	            <li class="collection-item avatar">
	              <a href="{{url('material/detail')}}/{{ $location }}/{{$n->faskes_id}}">
	                <i class="material-icons circle">home</i>
	                <span class="title">{{ $n->nama_faskes }}</span><br>
	                <small>{{ $n->alamat }}</small> <br>
	                <p>{{ number_format($n->jarak,4) }} KM</p>
	              </a>
	              <!-- <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a> -->
	            </li>
	            @endforeach
	           </ul>
				</div>
			<!-- faskes -->
        </div>
    </div>
  </div>
  </div>
  <!-- end container -->
@stop

<?php 
$latlng = explode(",",$location);
?>
@section('coding')
<!-- gmap geocode -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script>
$(document).ready(function(){
        geocodeLocation();
});
	function geocodeLocation(){

    var geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng({{$latlng[0]}}, {{$latlng[1]}});
    geocoder.geocode({'latLng': latlng}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      // $('#alamat').val(results[0].formatted_address);
      //console.log(results[0].formatted_address);
      $('#geocode').html(results[0].formatted_address);
    } else {
      alert('Geocoder failed due to: ' + status);
    }


  });

  return false;
}
</script>
<script>
var distance = $('#jarak').val();
var alamat_all = "{{ url() }}/api/nearby/haversine/{{ $latlng[0] }}/{{ $latlng[1]}}";
var alamat = "{{ url() }}/api/nearby/haversine/active/{{ $latlng[0] }}/{{ $latlng[1]}}";

$('#btn1').click(function(){
	$('#jarak').val(1);
	ws = cekStatus() + "/1";
	getNearby(ws);

});
$('#btn2').click(function(){
	$('#jarak').val(2);
	ws = cekStatus() + "/2";
	getNearby(ws);
});
$('#btn3').click(function(){
	$('#jarak').val(3);
	ws = cekStatus() + "/3";
	getNearby(ws);
});


//bug
$('#switcher').change(function() {
	var c = $(this).prop('checked');
	var jarak = $('#jarak').val();

	var ws;
	if(c == true)
	{
		$('#status').val('false');
		ws = cekStatus() + "/" + jarak;
		getNearby(ws);
	}
	else {
		$('#status').val('true');
		ws = cekStatus() + "/" + jarak;
		getNearby(ws);  	
	}

});

function filter(id_tipe)
{
	jarak = $('#jarak').val();
	console.log(id_tipe);
	if(jarak == "")
	{
		jarak = 1;
	}
	ws = cekStatus() + "/" + jarak + "/filter/" + id_tipe;
	getNearby(ws);
}


function cekStatus()
{
	//cek status
	var method = $('#status').val();
	var alamats;
	if(method == "")
	{
		alamats = alamat ;
	}
	else
	{
		if(method == "true")
		{
			alamats = alamat_all ;
		}
		else
		{
			alamats = alamat;
			
		}
	}

	return alamats;

}

function getNearby(restUrl)
{
	$.ajax({
	    type:'GET',
	    url: restUrl,
	    beforeSend: function() {
		     $('#preloader').show();
		},
		complete: function(){
		     $('#preloader').hide();
		},
	  	success:function(locations)
        {
        	$('#laykes').html("");
        	$('#faskes').html("");
        		// console.log(locations.data.length);
        		if(locations.data.length == 0){

        		}else{

        			$.each(locations.data, function(i, location){
	        		 $('#laykes').append(
	        		 	"<li class='collection-item avatar'>" 
	        		 	+ "<a href='{{url('material/detail')}}/{{ $location }}/"+location.faskes_id+"'><i class='material-icons circle'>home</i>"
	        		 	+ "<span class='title'>" + location.nama_faskes + "</span><br>"
	        		 	+ "<small>" + location.alamat + "</small>"
	        		 	+ "<p>" + location.jarak.toFixed(4) + " KM</p>"
	        		 	+ "</a>"
	        		 	+ "</li>");
	                    // console.log(location);
	                 });//end each
        		}	 
        },
        error:function(){
             alert('oops something wrong');
        },
	});
}
</script>

@stop