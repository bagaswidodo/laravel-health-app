@extends('layout.admin')

@section('content')
    <h1>Administrator Page</h1>
    <div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Akurasi Geolocation</div>
			  <div class="panel-body">
			  <!-- modal-config -->
			  <!-- Large modal -->
				Lokasi anda : {!! Form::text('lokasi',null,['class'=>'form-control','id'=>'lokasi']) !!}
				<input class="form-control" type="hidden" id="koordinat"></input>
						<button id="temukan_geo" class="btn btn-default">Temukan By Geolocation</button>
						<button id="temukan" class="btn btn-default" 
						type="button">
						Temukan </button>
				<!-- modals -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				  <div class="modal-dialog modal-lg">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Detail Geolocation</h4>
				      </div>
				      <div class="modal-body">
				        <!-- <h3>Akurasi Geolocation</h3> -->
							  	<table>
							  		<tr>
							  			<td>Lokasi anda</td>
							  			<td>: <span id="terpilih"></span></td>
							  		</tr>
							  		<tr>
							  			<td>Akurasi HTML 5 Geolocation</td>
							  			<td>: <span id="geo_accuracy"></span></td>
							  		</tr>
							  		<tr>
							  			<td>lokasi anda</td>
							  			<td>: <input type="text" id="latlng" value="-7.324965417312912,110.50479793548584"></td>
							  		</tr>
							  	</table>
				      </div><!-- modal-body -->
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
				      </div>
				    </div><!-- modal content -->
				  </div>
				</div>
			  <!-- end modal config --> 
			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Date and Time</div>
				<div class="panel-body">
					<h4><span id="tanggal"></span></h4>
					<h1><span id="hours"></span>:<span id="min"></span>:<span id="sec"></span></h1>
				</div>
			</div>
		</div>
    </div>
    <!-- row result -->
	<div class="row" style="display:none" id="result">
		<div class="col md-6">
			<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Euclidean result
					<!-- <button class="btn btn-info">Visualisasikan</button> -->
					
				</div>
				<div class="panel-body">
					<div id="loader" style="display:none">
						<img src="{{ asset('images/loading.gif') }}" alt="loading">
						Menghitung. . . 
					</div>
					<div class="nearby"  id="nearby" style="height:150px;overflow-y:scroll;">
						<table class="table table-bordered table-striped" id="euclidean">
							<tr>
								<td>No</td>
								<td>Nama faskes</td>
								<td>Jarak</td>
							</tr>
							
				       </table> 
					</div>
				</div><!-- panel body -->
				<div class="panel-footer">
					<table>
						<tr>
							<td>Waktu Eksekusi query</td>
							<td>:<span id="euclideantime"></span> detik</td>
						</tr>
						<!-- <tr>
							<td>Memory Terpakai</td>
							<td>:<span id="euclideanmemory"></span></td>
						</tr> -->
						<tr>
							<td>Jumlah faskes</td>
							<td>:<span id="euclideanfaskes"></span></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col md-6">
			<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Haversine Result
					<!-- <button class="btn btn-info">Visualisasikan</button> -->
				</div>
				<div class="panel-body">
					<div class="nearby"  id="nearby" style="height:150px;overflow-y:scroll;">	
							<div id="loaderh" style="display:none">
								<img src="{{ asset('images/loading.gif') }}" alt="loading">
								Menghitung. . . 
							</div>
							<table class="table table-bordered table-striped" id="haversine">
								<tr>
									<td>No</td>
									<td>Nama faskes</td>
									<td>Jarak</td>
								</tr>
					       </table> 

				       
					</div>
				</div><!-- panel body -->
				<div class="panel-footer">
					<table>
						<tr>
							<td>Waktu Eksekusi query</td>
							<td>:<span id="haversinetime"></span> detik</td>
						</tr>
						<tr>
							<td>Jumlah faskes</td>
							<td>:<span id="haversinefaskes"></span></td>
						</tr>
					</table>
				</div>
			</div>
			</div>
		</div>
	</div>
	</div>
    <!-- end row result -->

    <!-- gismodal -->
 <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"> -->
<!--  <button type="button" class="btn btn-primary btn-lg" id="gis"> 
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!-- <h4 class="modal-title" id="myModalLabel">Visualisasi Data</h4> -->
      </div>
      <div class="modal-body">
      <div class="right"></div>
      	<div class="btn-group" role="group" aria-label="distance-group">
      		<button type="button" class="btn btn-default">1 KM</button>
			<button type="button" class="btn btn-default">2 KM</button>
		    <button type="button" class="btn btn-default">3 KM</button>
      	</div>
      <div class="row">
      		<div class="col-md-6">
      			<div id="map" style="height:400px"></div>
      		</div>
      		<div class="col-md-6">
      			<h3>Data</h3>
      			<div class="nearby"  id="nearbyVisualize" style="height:150px;overflow-y:scroll;">	
					<table class="table table-bordered table-striped" id="visualizeData">
						<tr>
							<td>No</td>
							<td>Nama faskes</td>
							<td>Jarak</td>
						</tr>
						@for($i=0;$i<20;$i++)
						<tr>
							<td>No</td>
							<td>Nama faskes</td>
							<td>Jarak</td>
						</tr>
						@endfor
			       </table>    
				</div>
      		</div>
      </div>
        	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop


@section('footer')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
<script>
var lat = -7.33;
var lng = 110.5;
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('vendor/mustache/mustache.min.js') }}"></script>
<script src="{{ asset('js/benchmark.js') }}"></script>
<script src="{{ asset('js/geolocation.js') }}"></script>
<script src="{{ asset('js/tools/gmap.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@stop