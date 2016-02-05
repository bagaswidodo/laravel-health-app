/* Geolocation */
$('#temukan_geo').click(function(){
    //var koordinat = $('#koordinat').val();
    //begin geo function
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function showPosition(position)
        {
          koordinat = position.coords.latitude + "," + position.coords.longitude;
          latlng = koordinat.split(",");
          var restUrl = '/api/active/'+latlng[0]+'/'+latlng[1];
          getApiData(restUrl);
          // window.location = path + "/" + koordinat;

          //show modal
          $('.bs-example-modal-lg').modal('show');
          $('#geo_accuracy').html(position.coords.accuracy);
          $('#latlng').val(koordinat);
          geocodeLocation(latlng[0],latlng[1]);

        }, showError, {timeout: 5000});
    } else {
        alert("Geolocation is not supported by this browser.");
        history.back();
    }
    //end geo function
});//end temukan geo click function

//helper geolocation
//additional function
    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("Pengguna tidak mengijinkan mengakses layanan lokasi");
                break;
            case error.POSITION_UNAVAILABLE:
            	alert("Layanan informasi Lokasi tidak tersedia");
                // x.innerHTML = alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
            	alert("Permintaan akses lokasi telah habis")
                // x.innerHTML = alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
            	alert("Sepertinya terjadi kesalahan");
                // x.innerHTML = alert("An unknown error occurred.");
                break;
        }
    }
/* Geolocation */