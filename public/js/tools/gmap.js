//init map
google.maps.event.addDomListener(window,'load',function(){
  var homeLatlng = new google.maps.LatLng(-7.33,110.5); 
  
  var myOptions = {
    zoom: 15,
    center: homeLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  
  map = new google.maps.Map(document.getElementById("map"), myOptions);

   infowindow = new google.maps.InfoWindow({
        content: "loading..."
    });

   var marker = new google.maps.Marker({
			        position: new google.maps.LatLng(lat,lng),
			        map: map,
			        //icon : 'http://maps.google.com/mapfiles/kml/shapes/man.png',
			        title: 'loc'
			    });
});

function routing(awal,tujuan)
{
 var directionsService = new google.maps.DirectionsService();
     var directionsDisplay = new google.maps.DirectionsRenderer();
     document.getElementById('panel').innerHTML = "";

     var map = new google.maps.Map(document.getElementById('map'), {
       zoom:7,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });

     directionsDisplay.setMap(map);
     directionsDisplay.setPanel(document.getElementById('panel'));

     var request = {

       origin: awal,
       destination: tujuan,
       travelMode: google.maps.DirectionsTravelMode.DRIVING
     };

     directionsService.route(request, function(response, status) {
       if (status == google.maps.DirectionsStatus.OK) {
         directionsDisplay.setDirections(response);

         var point = response.routes[ 0 ].legs[ 0 ];
       }
     });
}