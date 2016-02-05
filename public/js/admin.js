$('#gis').click(function(){
	$('#myModal').modal('show');
});

$('#temukan').click(function(){
	$('#euclidean').html("");
	$('#haversine').html("");

	var koordinat = $('#koordinat').val();
	var latlng = koordinat.split(",");
	var restUrl = '/api/active/'+latlng[0]+'/'+latlng[1];
	getApiData(restUrl);

});
function getApiData(restUrl)
{
	$.ajax({
              type:'GET',
              url: restUrl,
              beforeSend: function() {
			     $('#loader').show();
			     $('#loaderh').show();
			  },
			  complete: function(){
			     $('#loader').hide();
			     $('#loaderh').hide();
			  },
              success:function(locations)
              {
              	// console.log(locations);
              	$("#result").css("display", "block");
                $.each(locations['euclidean']['data'], function(i, location){
                  $('#euclidean').append("<tr><td>"+(i+1)+"</td><td>" 
                      	+ location.nama_faskes 
                      	+ "</td><td>" 
                      	+ location.jarak.toFixed(5)
                      	+"</td></tr>");
                });//end each
                $('#euclideanmemory').html(locations['euclidean']['memory_usage']);
                $('#euclideantime').html(locations['euclidean']['time_elapsed'].toFixed(5));
                $('#euclideanfaskes').html(locations['euclidean']['data'].length);

                $.each(locations['haversine']['data'], function(i, location){
                      $('#haversine').append("<tr><td>"+(i+1)+"</td><td>" 
                      	+ location.nama_faskes 
                      	+ "</td><td>" 
                      	+ location.jarak.toFixed(5)
                      	+"</td></tr>");
	             });
                $('#haversinememory').html(locations['haversine']['memory_usage']);
                $('#haversinetime').html(locations['haversine']['time_elapsed'].toFixed(5));
                $('#haversinefaskes').html(locations['haversine']['data'].length);

              },
              error:function(){
                  alert('oops something wrong');
              },

         });
}