<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DayTripper</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
</head>
<body>
	<?php
		$miasto = $_GET['miasto'];
		$rodzaj = $_GET['rodzaj'];
		$rodzaj_posilku = $_GET['rodzajposilku'];
		$transport = $_GET['transport'];
		$start = $_GET['start'];
		$end = $_GET['end'];
	?>
	
    <div class="cookies"></div>

    <div id="content">
        <div id="content-box">
            <div id="plan">
                <ul id="results">
                </ul>    
            </div>

            <div id="map"></div>
        <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

		var fun = ['amusement_park','bowling_alley','casino','movie_theater','stadium']; var funT=3; //3
		var nuture = ['aquarium','park','zoo']; var natureT=2;//2
		var art = ['art_gallery']; var artT=2;//2
		var night = ['bar', 'night_club','cafe']; var nightT=3;//3
		var beauty = ['beauty_salon','hair_care','spa']; var beautyT=3;//3
		var shopaholic = ['clothing_store','jewelry_store','shopping_mall','shoe_store'];var shopaholicT=3;//3
		var religion = ['church','hindu_temple','mosque','synagogue']; var religionT=1; //1h
		var monuments = ['city_hall', 'museum']; var monuments = 3;//3
		
		
		var map;
		var infowindow;	
		var result=[];
		var city = '<?php $_GET['miasto'] ?>';
		var hour1 = new Date("July 21, 1983 <?php $_GET['start'] ?>");
		var hour2 = new Date("July 21, 1983 <?php $_GET['end'] ?>");
		var time_diff = (hour2 - hour1)/1000/60/60-1;
		var pyrmont = {lat: 50.049, lng: 19.944};
		var rynek ={lat: 50.062, lng: 19.940};
		//pyrmont = rynek;
		var food='brak';
		var night_fun=0;
		var category = religion;
		var num=0;
		var z;
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
		  
			type: [category[i]]
		  
        }, callback);
		}
		
		//result = sortPlaces(result);
		//document.getElementById("demo").innerHTML=result;//.rating;//+result[0].name;
		

        // Instantiate a directions service.
        var directionsService = new google.maps.DirectionsService;

        var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

        var stepDisplay = new google.maps.InfoWindow;

		// Display the route between the initial start and end selections.
        calculateAndDisplayRoute(
            directionsDisplay, directionsService);
			
      }

		
      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < 3; i++) {
            createMarker(results[i]);
          }
		  //z = z + results.length;
		   //result.push(results);
		   //result = sortPlaces(results);

		   
		   
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var zmienna = document.getElementById("results");
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name+" "+place.rating);
          infowindow.open(map, this);
        });

                var li = document.createElement('li');
                li.textContent = place.geometry.location;
                zmienna.appendChild(li);
		   //
      }
	  
	  function sortPlaces(result_) {
			return result_.sort(function(a,b){return b.rating - a.rating;});
	    }
		
		
	
		
		
      function calculateAndDisplayRoute(directionsDisplay, directionsService) {
            var waypts=[];
            for (var i = 0; i < results.length; i++){
                var point = document.getElementsByTagName('li')[i].innerHTML;
                waypts.push(point.slice(2,point.length));
            }
			//dupa();
        // First, remove any existing markers from the map.
        /*for (var i = 0; i < markerArray.length; i++) {
          markerArray[i].setMap(null);
        }*/

        // Retrieve the start and end locations and create a DirectionsRequest using
        // WALKING directions.
        directionsService.route({
          origin: waypts[0],//document.getElementById('start').value,
          destination: waypts[waypts.length],//document.getElementById('end').value,
          travelMode: 'WALKING',
          optimizeWaypoints = true;
        }, function(response, status) {
          // Route the directions and pass the response to a function to create
          // markers for each step.
          if (status === 'OK') {
            //document.getElementById('warnings-panel').innerHTML =
            //    '<b>' + response.routes[0].warnings + '</b>';
			
			
			//result=sortPlaces(result[0]);
			//document.getElementById("demo").innerHTML=result[0].rating+result[0].name;
			//document.getElementById("demo").innerHTML=result.length+" " + z;//
			//document.getElementById("demo").innerHTML=time_diff;
			//document.getElementById("demo").innerHTML=response.routes[0].legs[0].duration.value;
			//
			
		   
			directionsDisplay.setDirections(response);
            //showSteps(response, markerArray, stepDisplay, map);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
//document.getElementById("demo").innerHTML=result[0].rating+result[0].name;
/*
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
*/
		
	  
		//initMap();
		
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGkKotPN8lP4yiffPytnKNLDMJO17KBsM&libraries=places&callback=initMap">
    </script>
        </div>
    </div>

    <div id="footer-box">
        <p>Copyright 2019 by zJava-Project</p>
        <p>Background photo by <a href="https://unsplash.com/@rawpixel">rawpixel</a> on <a href="https://unsplash.com/">Unsplash</a></p>
    </div>
</body>
</html>