@extends('material.layout.paralax')

@section('content')
  <!-- container -->
  <div class="container">
    <div class="section">
      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m12">
         <h1>{{ $f->nama_faskes }}</h1>
         <h5>{{ $f->alamat }}</h5>
         <hr>
           <!-- tabs -->
          <div class="row">
              <div class="col s12">
                <ul class="tabs teal">
                  <li class="tab col s4"><a href="#test1" class="active teal-text text-lighten-5">Jadwal Layanan</a></li>
                 @if($f->tipe_id == 1 || $f->tipe_id == 2)
                  <li class="tab col s4"><a href="#test2" class="teal-text text-lighten-5">Dokter</a></li>
                  @endif
                  <li class="tab col s4"><a href="#test3" class="teal-text text-lighten-5">Rute </a></li>
                </ul>
              </div>
                  <div id="test1" class="col s12">
                  	<table>
                  	<?php 
                  	$day = [0 => "senin", 
                  	1=> "selasa",
                  	2=> "rabu",
                  	3=> "kamis",
                  	4=> "jumat",
                  	5=> "sabtu",
                  	6=> "minggu"];
                  	?>
                  		<thead>
                  			<tr>
                  				<td>Hari</td>
                  				<td>Jam Layanan</td>
                  			</tr>
                  		</thead>
                  		<tbody>
  							@foreach($works as $w)
	                  		<tr>
	                  			<td>{{ $day[$w->hari] }}</td>
	                  			@if($w->jam_buka == "00:00:00" && $w->jam_tutup == "24:00:00")
	                  			<td>IGD 24 Jam</td>
	                  			@elseif($w->jam_mulai_istirahat != "00:00:00")
								<td>
									{{ $w->jam_buka }} - {{ $w->jam_mulai_istirahat }}<br />
									{{ $w->jam_selesai_istirahat }} - {{ $w->jam_tutup }}
								</td>
	                  			@else
	                  			<td>{{ $w->jam_buka }} - {{ $w->jam_tutup }}</td>
	                  			@endif
	                  		</tr>
	                  		@endforeach
                  		</tbody>
                  	</table>                	
                  </div>
				@if($f->tipe_id == 1 || $f->tipe_id == 2)
                  <div id="test2" class="col s12">
                  	<ul class="collection">
                  	@foreach($f->dokter()->get() as $d)
				    <li class="collection-item avatar">
				      <i class="material-icons circle">contacts</i>
				      <span class="title">{{ $d->nama }}</span><br>
				      <button class="btn waves-effect waves-light" onclick="ambilJadwal({{ $d->dokter_id }})">Lihat Jadwal</button>
				    </li>
				    @endforeach
                  </div>
                  @endif
                   <div id="test3" class="col s12">
                   	<p>
                   		<?php 
                   		$latlng = explode(",",$location);
                   		?>
			    		<a class="btn btn-primary btn-lg" onclick="rute({{$latlng[0]}},{{$latlng[1]}})">
			    		Tampilkan Rute</a>
		    		</p>
					<div class="row">
						<div class="col s6 m6">
							<!-- routing map -->
							<div id="map" style="height:200px"></div>
						</div>
						<div class="col s6 m6">
							<!-- node to node -->
							<div id="panel"></div>
						</div>
					</div>
                   </div>           
            </div>
          <!-- end tabs -->
        </div>
    </div>
  </div>
  </div>
  <!-- modal jadwal praktek dokter -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4 id="nama_dokter">Modal Header</h4>
      <table id="schedule">
      	<tr>
      		<td>Hari</td>
      		<td>Jam Praktek</td>
      	</tr>
      </table>
      <p id="id_dokter"></p>
      <!-- preloader -->
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
      <!-- end preloader -->
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
    </div>
  </div>
  <!-- end modal -->
@stop

@section('coding')
<script>
var lat={{$latlng[0]}};
var lng ={{$latlng[1]}};
$(document).ready(function(){
	$('ul.tabs').tabs('select_tab', 'tab_id');
});
function ambilJadwal(dokterID)
{
	$('#modal1').openModal();
	var restUrl = '{{ url() }}/api/dokter/praktek/' + dokterID;
	$.ajax({
		type:'GET',
	    url: restUrl,
	    beforeSend: function() {
		     $('#preloader').show();
		},
		complete: function(){
		     $('#preloader').hide();
		},
	  	success:function(jadwal)
        {
        	$('#nama_dokter').html(jadwal.nama_dokter);
			$('#schedule').html("");
        	var weekdays = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        	$.each(jadwal.data, function(i, j){
                  $('#schedule').append("<tr><td>"
                  	+ weekdays[j.hari] 
                  	+ "</td><td>" 
                  	+ j.jam_mulai + "-" + j.jam_selesai
                  	+"</td></tr>");
             });
        },
        error:function(){
        	alert('Ooops, Something wrong');
    	}
	});
}
</script>
<!-- map route -->
<!-- gmap -->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	<script src="{{ asset('js/tools/gmap.js') }}"></script>
	<script type="text/javascript">
	function rute(lat,lng)
	{
		awal = lat + "," + lng;
		destLat = {{$f->latitude}} ;
		destLng = {{$f->longitude}};
		tujuan = destLat + "," + destLng;
		routing(awal , tujuan);
	}
	</script>
	<!-- end gmap -->
@stop