        <div class="alert alert-info">
        <strong>Improvement ! </strong>Custom Validation, auto value kolom lat lng
        </div>
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
             <div class="alert alert-info">Jika ganti faskes dari Rs/klinik/puskesmas ke mandiri tidak boleh,
             coba tipe data enum</div>
              <div class="form-group">
                         {!! Form::label('tipe', 'Tipe Faskes : ') !!}
                         {{--{!! Form::select('id_tipe',$t,null,['class'=>'form-control',null,'id'=>'tipe']) !!}--}}
                         {!! Form::select('tipe_id',
                         $t,
                               null,
                               array('class' => 'form-control')) !!}

               </div>
        </div>

        {{--rightsection--}}
        <div class="col-md-6">
                <div class="alert alert-info">Validasi ini</div>
                <div class="form-group">
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
                 <div id="map" style="height:280px;width:90%;">Map Here</div>
                <div class="form-group">
                   <input type="checkbox" data-toggle="toggle" data-on="BPJS" data-off="Non BPJS"
                        data-onstyle="info" data-offstyle="default" id="toggle-event" name="bpjs">
                </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::submit('Batal', ['class' => 'btn btn-danger form-control']) !!}
    </div>



@section('footer')
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        	<script>
        		var map;
        		function initialize() {


        			var latLng = new google.maps.LatLng( <?php echo empty($location) ? '-7.2669,110.4039' : $location; ?>  );
        			var map = new google.maps.Map(document.getElementById('map'), {
        				zoom: 10,
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
        			document.getElementById('location').value = lat + "," + lng;
        		}
        </script>

        <script>
        function findMe()
                  {
                    if (navigator.geolocation) {
                    	  navigator.geolocation.getCurrentPosition(success);
                    	} else {
                    	  error('Geo Location is not supported');
                    	}
                  }

                  function success(position)
                  {
                        var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                        var options = {
                          zoom: 15,
                          center: coords,
                          mapTypeControl: false,
                          navigationControlOptions: {
                          	style: google.maps.NavigationControlStyle.SMALL
                          },
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("map"), options);

                        var marker = new google.maps.Marker({
                            position: coords,
                            map: map,
                            title:"You are here!",
                            draggable:true
                        });

                        $('#latitude').val(position.coords.latitude.toFixed(4));
                        $('#longitude').val(position.coords.longitude.toFixed(4));


                        google.maps.event.addListener(marker, 'dragend', function(evt){
                  			//	document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(4) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
                  				setInput(evt);
                  			//  alert(evt);
                  			});

                  			google.maps.event.addListener(marker, 'dragstart', function(evt){
                  				//document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
                  			});
                  }
        </script>

        <script>
        	function geocodeLocation(){
        					//var lokasi = document.getElementById('location').value;
        					var lat = $('#latitude').val();
        					var lng = $('#longitude').val();

        				  var geocoder = new google.maps.Geocoder();
        				  var latlng = new google.maps.LatLng(lat, lng);
        				  geocoder.geocode({'latLng': latlng}, function(results, status) {

        					if (status == google.maps.GeocoderStatus.OK) {
        						$('#alamat').val(results[0].formatted_address);

        					} else {
        					  alert('Geocoder failed due to: ' + status);
        					}


        				});

        				  return false;
        			}
        </script>



    <script>
    $('#tag_list').select2({
        placeholder:'Choose a tag',
        tags:true //for auto add
    });
    </script>
@endsection
