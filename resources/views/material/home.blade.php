@extends('material.layout.paralax')

@section('content')	
<link href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <div id="index-banner" class="parallax-container" style="height:550px;">
    <div class="section no-pad-bot" style="margin-top:125px">
      <div class="container">
        <br><br>
        <!-- <h1 class="header center teal-text text-lighten-2">Parallax Template</h1> -->
        <div class="row center">
          <h5 class="header col s12 light">Temukan 
            <span class="element"></span> disekitar anda
          </h5>
        </div>
        
        <!-- search bar   -->
         <nav>
            <div class="nav-wrapper">
              <form>
                <div class="input-field teal lighten-1">
                  <input id="lokasi" type="search" required placeholder="inputkan lokasi . . .">
                  <input class="form-control" type="hidden" id="koordinat"></input>
                  <label for="search"><i class="material-icons">search</i></label>
                  <i class="material-icons">close</i>
                </div>

              </form>
            </div>
          </nav>
        <!-- end search bar -->

        <div class="row"><br><br></div>
        <div class="row center">

          <a href="#" id="temukan_geo" class="btn-large waves-effect waves-light teal lighten-1">
           <i class="material-icons left">location_on</i>Sekitar saya
          </a>
          <a href="#" id="temukan" class="btn-large waves-effect waves-light teal lighten-1">
           <i class="material-icons right">search</i>Cari 
          </a>
        </div>
        <br><br>
      </div>
    </div>
    <div class="parallax"><img src="{{ asset('images/lorong.jpg') }}" alt="Unsplashed background img 1"></div>
  </div>

  @stop

  @section('coding')
<script>
    $(this).ready( function() {
        $("#lokasi").autocomplete({
          minLength: 1,
          source:
          function(req, add){
              $.ajax({
              url:  "{{ url() }}/lokasi",
                dataType: 'json',
                type: 'GET',
                data: req,
                success:

                function(data){
                // console.log(data);

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
</script>
<!-- geolocation -->
<script>
var path = 'material/nearby';
    $('#temukan').click(function(){
        var koordinat = $('#koordinat').val();
        console.log(koordinat);

        if(koordinat == "")
        {
            // alert('Empty');
            // $('#kesalahan').show();
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
</script>
  @stop