function findMe()
{
  if (navigator.geolocation) {
  	  navigator.geolocation.getCurrentPosition(success);
  	} else {
      //provide more error handling
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

//geocode location from given latitude and longitude
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


// jquery usage
/*
  buat div dengan id temukan untuk mencari layanan berdasarkan lokasi dari autocomplete
  buat div dengan id temukan_geo untuk mencari laynan berdasarkan lokasi menggunakan hmtml 5 geolocation

*/
  $('#temukan').click(function(){
        var koordinat = $('#koordinat').val();
        if(koordinat == "")
        {
            // $('#kesalahan').html('Anda belum memilih lokasi')
            alert('anda belum memilih lokasi');
        }
        else
        {
           window.location = path + "/" + koordinat;
        }

  });
$('#temukan_geo').click(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function showPosition(position)
        {
          koordinat = position.coords.latitude + "," + position.coords.longitude;
          console.log(koordinat);
          window.location = path + "/" + koordinat;
        }, showError, {timeout: 5000});
    } else {
        alert("Geolocation is not supported by this browser.");
        history.back();
    }
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
