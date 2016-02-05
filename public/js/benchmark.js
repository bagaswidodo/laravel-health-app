$(document).ready(function() {
// Create two variable with the names of the months and days in an array
var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
var dayNames= ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"]

// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year   
$('#tanggal').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

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


//autocomplete configuration
$(this).ready( function() {
    $("#lokasi").autocomplete({
      minLength: 1,
      source:
      function(req, add){
          $.ajax({
          url: "lokasi",
            dataType: 'json',
            type: 'GET',
            data: req,
            success:

            function(data){
            // console.log(data);

                if(data.response ==true){
                  add(data.message);
                  console.log(data.message);

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

//ajax preprocessor
// mustache


// var resultTemplate = $('#result-template').html();      
// var $result = $('#result');
// function fillDetail(nearby)
// {
//   $result.append(Mustache.render(resultTemplate, nearby));
// }


//ajax request get nearby faskes
// function getNearbyAll(path,lat, lng, distance, tipe)
// {
//         var distance = typeof distance !== 'undefined' ? distance : 1;
//         var tipe = typeof tipe !== 'undefined' ? tipe : '';
//               var restUrl = path + "/" +lat + "," + lng + distance + "/" + tipe;
//               console.log("URL REST: "  + restUrl);
//               $result.html("");
//             $.ajax({
//                   type:'GET',
//                   url: restUrl,
//                   success:function(users)
//                   {
                      
//                       var locations =  JSON.parse(users);
//                         $.each(locations, function(i, location){
//                           console.log(location.data.data.length);
//                           // fillDetail(location);
//                           $result.append(Mustache.render(resultTemplate, nearby));
//                          });//end each

//                   },
//                   error:function(){
//                       alert('oops something wrong');
//                   },

//              });

// }