{!! Form::hidden('user_id',Auth::user()->user_id) !!}
<div class="row">
  {{--leftsection--}}
  <div class="col-md-6">
    {{--namaFaskes--}}
    <div class="form-group">
            {!! Form::label('nama_faskes', 'Nama Faskes : ') !!}
            {!! Form::text('nama_faskes',null,['class'=>'form-control']) !!}
    </div>
    {{--alamat faskes--}}
     <div class="form-group">
        {!! Form::label('alamat', 'Alamat : ') !!}
        {!! Form::textarea('alamat',null,['class'=>'form-control']) !!}
     </div>
     <button type="button" class="btn btn-default" onclick="geocodeLocation()">
        <span class="fa fa-compass"></span>Geocode Saya
     </button>
       <div class="form-group">
            {!! Form::label('web', 'Alamat Website : ') !!}
            {!! Form::text('web',null,['class'=>'form-control','placeholder'=>'http://www.example.com','id'=>'web']) !!}
            </div>  
      </div>

    {{--rightsection--}}
    <div class="col-md-6">
      <div class="form-group">
          <label>Lokasi</label>
          <!-- <small>Validasi ini</small> -->
          <div class="row">
            <div class="col-xs-6">
            {!! Form::text('latitude',null,['class'=>'form-control','id'=>'latitude','placeholder'=>'longitude. . .']) !!}
             {{--<input type="text" placeholder="latitude..." class="form-control" placeholder=".col-xs-2"--}}
              {{--name="latitude" id="latitude">--}}
            </div>
            <div class="col-xs-6">
             {!! Form::text('longitude',null,['class'=>'form-control','id'=>'longitude','placeholder'=>'longitude. . .']) !!}
              {{--<input type="text" placeholder="longitude..." class="form-control" placeholder=".col-xs-3"--}}
              {{--name="longitude" id="longitude">--}}
               {{--{!! Form::text('latitude',null,['class'=>'form-control']) !!}--}}
            </div>
          </div>
      </div>

      <div class="form-group">
        {{--{!! Form::label('lokasi', 'Lokasi : ') !!}--}}
        {{--{!! Form::text('lokasi',null,['class'=>'form-control','placeholder'=>'lat,lng','id'=>'location']) !!}--}}
      </div>
      <button type="button" class="btn btn-default" onclick="findMe()">
        <span class="fa fa-compass"></span>Temukan Saya
      </button>
      <div id="map" style="height:250px;width:90%;">Map Here</div>
      <div class="form-group">
              {!! Form::label('phone', 'Nomor Telpon : ') !!}
              {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'(0298) 123 4567','id'=>'phone']) !!}
           </div>
      <div class="form-group"><br />
      <input type="checkbox" data-toggle="toggle" data-on="BPJS" data-off="Non BPJS"
        data-onstyle="info" data-offstyle="default" id="toggle-event" name="bpjs">
        <!-- <small>When edit if support it enabled</small> -->
      </div>
    </div>
    </div>
    <div class="form-group">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
        <a href="{{ url() }}/faskes">
          <button class="btn btn-danger form-control" type="button">Batal</button>
        </a>
    </div>



@section('footer')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script>
	var map;
	function initialize() {
		var latLng = new google.maps.LatLng( <?php echo (empty($f->latitude) && empty($f->longitude)) ? '-7.2669,110.4039' : $f->latitude . ',' . $f->longitude; ?>  );
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 15,
			center: latLng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var marker = new google.maps.Marker({
			position: latLng,
			title: 'Lokasi',
			map: map,
			draggable: true
		});


		google.maps.event.addListener(marker, 'dragend', function(evt){
		//	document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(4) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
			setInput(evt);
		//  alert(evt);
		});

		google.maps.event.addListener(marker, 'dragstart', function(evt){
			//document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
		});
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	function setInput(e)
	{
		lat = e.latLng.lat().toFixed(4);
		lng = e.latLng.lng().toFixed(4);
		// document.getElementById('location').value = lat + "," + lng;
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;

	}
</script>
<script src="{{ asset('js/tools/geolocation.js') }}"></script>
@endsection
