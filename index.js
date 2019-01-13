<!DOCTYPE html>
<html>
  <head>
    <title>Simple Click Events</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="utf-8" />
  </head>
  <body>
    <div id="map"></div>
        <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>

	  var fun = [['amusement_park','bowling_alley','casino','movie_theater','stadium'],3]; //3
		var nuture = [['aquarium','park','zoo'],2];//2
		var art = [['art_gallery'],2];//2
		var night = [['bar', 'night_club','cafe'],3];//3
		var beauty = [['beauty_salon','hair_care','spa'],3];//3
		var shopaholic = [['clothing_store','jewelry_store','shopping_mall','shoe_store'],3];//3
		var religion = [['church','hindu_temple','mosque','synagogue'],1]; //1h
		var monuments = [['city_hall', 'museum'],3];//3
		
		
		var map;
		var infowindow;	
		var result=0;
		var city = 'Kraków';
		var hour1 = new Date("July 21, 1983 09:00");
		var hour2 = new Date("July 21, 1983 17:00");
		var time_diff = (hour2 - hour1)/1000/60;
		var pyrmont = {lat: 50.049, lng: 19.944};
		var rynek ={lat: 50.062, lng: 19.940};
		pyrmont = rynek;
		var food=0;
		var night_fun=0;
		var category = religion;

      function initMap() {
        

        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 15
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
		for (var i = 0; i < category.length; ++i) {
        service.nearbySearch({
          location: pyrmont,
          radius: 1000,
		  
			type: [category[0][i]]
		  
        }, callback);
		}
		
		var markerArray = [];

        // Instantiate a directions service.
        var directionsService = new google.maps.DirectionsService;

        /*// Create a map and center it on Manhattan.
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 40.771, lng: -73.974}
        });*/

        // Create a renderer for directions and bind it to the map.
        var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

        // Instantiate an info window to hold step text.
        var stepDisplay = new google.maps.InfoWindow;

        // Display the route between the initial start and end selections.
        calculateAndDisplayRoute(
            directionsDisplay, directionsService, markerArray, stepDisplay, map);
        // Listen to change events from the start and end lists.
        //var onChangeHandler = function() {
        //  calculateAndDisplayRoute(
        //      directionsDisplay, directionsService, markerArray, stepDisplay, map);
        //};
        //document.getElementById('start').addEventListener('change', onChangeHandler);
        //document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
		   result = sortPlaces(results);
		   document.getElementById("demo").innerHTML=result[0].rating+result[0].name;
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name+"\n"+place.rating);
          infowindow.open(map, this);
        });
      }
	  
	  function sortPlaces(result) {
			return result.sort(function(a,b){return b.rating - a.rating;});
	    }
		
		
		
      function calculateAndDisplayRoute(directionsDisplay, directionsService,
          markerArray, stepDisplay, map) {
        // First, remove any existing markers from the map.
        for (var i = 0; i < markerArray.length; i++) {
          markerArray[i].setMap(null);
        }

        // Retrieve the start and end locations and create a DirectionsRequest using
        // WALKING directions.
        directionsService.route({
          origin: pyrmont,//document.getElementById('start').value,
          destination: rynek,//document.getElementById('end').value,
          travelMode: 'WALKING'
        }, function(response, status) {
          // Route the directions and pass the response to a function to create
          // markers for each step.
          if (status === 'OK') {
            //document.getElementById('warnings-panel').innerHTML =
            //    '<b>' + response.routes[0].warnings + '</b>';
			
			
			//document.getElementById("demo").innerHTML=time_diff;
			//document.getElementById("demo").innerHTML=response.routes[0].legs[0].duration.value;
            //document.getElementById("demo").innerHTML=time_diff;
			directionsDisplay.setDirections(response);
            //showSteps(response, markerArray, stepDisplay, map);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

      function showSteps(directionResult, markerArray, stepDisplay, map) {
        // For each step, place a marker, and add the text to the marker's infowindow.
        // Also attach the marker to an array so we can keep track of it and remove it
        // when calculating new routes.
        var myRoute = directionResult.routes[0].legs[0];
        for (var i = 0; i < myRoute.steps.length; i++) {
          var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
          marker.setMap(map);
          marker.setPosition(myRoute.steps[i].start_location);
          attachInstructionText(
              stepDisplay, marker, myRoute.steps[i].instructions, map);
        }
      }

      function attachInstructionText(stepDisplay, marker, text, map) {
        google.maps.event.addListener(marker, 'click', function() {
          // Open an info window when the marker is clicked on, containing the text
          // of the step.
          stepDisplay.setContent(text);
          stepDisplay.open(map, marker);
        });
      }

		
	  
		
		
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGkKotPN8lP4yiffPytnKNLDMJO17KBsM&libraries=places&callback=initMap">
    </script>
  </body>
</html>