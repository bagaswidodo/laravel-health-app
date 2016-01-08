@extends('layout.user')

@section('content')
    <h1>Nearby Home <small>({{ $location }})</small></h1>
    <?php $latlng = explode(",",$location); ?>

    <!-- radius tool -->
    <div class="row">


			<div class="col-md-6">
				<div class="alert alert-dismissible alert-success" id="notif">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  Ditemukan sebanyak <strong><span id="jumlah_faskes">{{  count($nearby) }}</span></strong> 
				  Layanan kesehatan dalam radius
				  <strong><span id="radius">{{ $distance }} </span>KM </strong>
				  dalam waktu <strong><span id="waktu">{{  $waktu }} </span>detik </strong>
				</div>
				<div class="alert alert-dismissible alert-warning" id="warn" style="display:none">
				</div>
			</div>
			<div class="col-md-6" id="control">
				<div class="pull-right">
				<div class="btn-group">
				    <a href="#" id="btn1" class="btn btn-default">1 KM</a>
				    <a href="#" id="btn2" class="btn btn-default">2 KM</a>
				    <a href="#" id="btn3" class="btn btn-default">3 KM</a>
				  </div>
				<input type="checkbox" checked data-toggle="toggle" data-on="Buka" data-off="Semua"
    				data-onstyle="success" data-offstyle="danger" id="toggle-event">
				</div>
			</div>

			<input type="hidden" class="form-control" id="jarak">
			<input type="hidden" class="form-control" id="all">
		</div>


    <div id="faskes">
    	<template id="nearby">
	        <!-- info box -->
	        <div class="list-group">
		        <a href="{{url() }}/poi/detail/{{$location}}/@{{id_faskes}}" class="list-group-item">
		        	<h4 class="list-group-item-heading">@{{ nama_faskes }}</h4>
		        	<small>@{{jam_buka}}  - @{{jam_istirahat}}</small>
		        	<span class="pull-right">@{{ jarak }} KM</span>
		        	<p class="list-group-item-text">@{{ alamat }}</p>
		        </a>
	        </div>
		</template>


    @foreach($nearby as $n)
			        <!-- info box -->
			        <div class="list-group">
				        <a href="{{url('poi/detail/'. $location . '/' . $n->faskes_id) }}" class="list-group-item">
				        	<h4 class="list-group-item-heading">{{ $n->nama_faskes }}</h4>
				        	{{--<small>{{$n->jam_buka}}  - {{$n->jam_istirahat}}</small>--}}
				        	<span class="pull-right">{{ $n->jarak }} KM</span>
				        	<p class="list-group-item-text">{{ $n->alamat }}</p>
				        </a>
			        </div>
    @endforeach
    </div>

    @include('layout.bottom_nav')


@stop


@section('scripts')
<script src="{{ asset('vendor/mustache/mustache.min.js') }}"></script>
<script>
$(document).ready(function() {
// Create two variable with the names of the months and days in an array
var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
var dayNames= ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"]

// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year   
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
	// Create a newDate() object and extract the seconds of the current time on the visitor's
	var seconds = new Date().getSeconds();
	// Add a leading zero to seconds value
	$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
	},1000);
	
setInterval( function() {
	// Create a newDate() object and extract the minutes of the current time on the visitor's
	var minutes = new Date().getMinutes();
	// Add a leading zero to the minutes value
	$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
	
setInterval( function() {
	// Create a newDate() object and extract the hours of the current time on the visitor's
	var hours = new Date().getHours();
	// Add a leading zero to the hours value
	$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);	
});	

var str = "{{ $location }}";
var latlng = str.split(",");

var alamat = "{{ url() }}/nearby/haversine/active/"+latlng[0] + "/" + latlng[1];
var alamat_all = "{{ url() }}/nearby/haversine/"+latlng[0] + "/" + latlng[1];
function cekStatus()
{
	//cek status
	var method = $('#all').val();
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

//AJAX
//ajax request get nearby faskes
function getNearby(restUrl)
{

		console.log(restUrl);
		$.ajax({
          type:'GET',
          url:restUrl,
          success:function(users)
          {
          		// JSON.stringify(users);
          		var locations =  users;
           		
          		
	            // $nearby.html("");
	            $('#faskes').html("");
	          
	            //write to  nearby faskes

	            var hasil  = locations['data'];

	            if( $(hasil).toArray().length == 0)
	            {
	            	
	            	$("#warn").show();
	            	$("#warn").html("Faskes Tipe Tersebut tidak ditemukan");
	            	$("#notif").hide();
	            	$("#control").hide();
	            }else{
	            	$("#notif").show();
	            	$("#control").show();
	            	$("#warn").hide();
	            	$('#waktu').html(locations['waktu']);
	          		$("#jumlah_faskes").html(locations['data'].length);
	           		$("#radius").html(locations['distance']);
	                $.each(hasil, function(i, location){
	                    addLocation(location);	
	                    //console.log(location);
	                 });//end each
            	}

          },
          error:function(){
              alert('oops something wrong');
          },

     });

}
// end xhttp


//distance control
var distance = $('#jarak').val();

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
$('#toggle-event').change(function() {
	//  $('#console-event').html('Toggle: ' + $(this).prop('checked'))
	var c = $(this).prop('checked');
	var jarak = $('#jarak').val();
	
	var ws;
	if(c == true)
	{
		$('#all').val('false');
		ws = cekStatus() + "/" + jarak;
		getNearby(ws);
	}
	else {
		$('#all').val('true');
		ws = cekStatus() + "/" + jarak;

		getNearby(ws);
	  	
	}
	console.log(ws);

});


// mustache
//ketika XMLHttpRequest done !
var nearbyTemplate = $('#nearby').html();			
var $nearby = $('#faskes');
function addLocation(nearby)
{
	$nearby.append(Mustache.render(nearbyTemplate, nearby));
}

//filter per faskes
function filter(id_tipe)
{
	jarak = $('#jarak').val();
	
	if(jarak == "")
	{
		jarak = 1;
	}


	ws = cekStatus() + "/" + jarak + "/filter/" + id_tipe;
	getNearby(ws);

}
    </script>
@stop