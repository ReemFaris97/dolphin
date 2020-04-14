<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>شركة القابضة للمهام </title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
        #floating-panel {
            position: absolute;
            top: 5px;
            left: 50%;
            margin-left: -180px;
            width: 350px;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
        }
        #latlng {
            width: 225px;
        }
    </style>
</head>
<body>

<div id="map"></div>

<script>
    var map;
    // var pointC = new google.maps.LatLng(30.9711082, 31.2643653);
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
        directionsDisplay.setMap(map);



        var routes = <?php echo json_encode($routes); ?>;
        console.log(routes);
            var key;

		Object.size = function(obj) {
			var size = 0, key;
			for (key in obj) {
				if (obj.hasOwnProperty(key)) size++;
			}
			return size;
		};

        for (var i = 0; i < routes.length; i++) {
			var objectSize = Object.size(routes[i]);
			var startPoint = new google.maps.LatLng(routes[i]['departLat'], routes[i]['departLng']);
			console.log( 'the stat point is' + startPoint);
             var centerCount = (objectSize - 4) / 2 ;
            console.log('center count is ' + centerCount);
			var centerPoint = [];
            for (var n = 0; n < centerCount ; n++){
                 centerPoint[n] = new google.maps.LatLng(routes[i]['center'+(n+2)+'Lat'], routes[i]['center'+(n+2)+'Lng']);
                 console.log('center point num ' +  Number(n+1) + ' is' + centerPoint[n]);
            }
			 console.log('all totallll are' + centerPoint);
            var endPoint = new google.maps.LatLng(routes[i]['arriveeLat'], routes[i]['arriveeLng']);
            var directionsDisplay = new google.maps.DirectionsRenderer({map: map,});
            calculateAndDisplayRoute(directionsService, directionsDisplay, startPoint,centerPoint,endPoint);
        }

    }
    function calculateAndDisplayRoute(directionsService, directionsDisplay, startPoint,centerPoint ,endPoint) {
			 console.log('all totallll are in the function ' + centerPoint);
				directionsService.route({
					origin: startPoint,
					destination: endPoint,
					optimizeWaypoints: true,
					travelMode: 'DRIVING'
				}, function(response, status) {
					if (status === 'OK') {

                directionsDisplay.setDirections(response);
                var my_route = response.routes[0];
                // console.log(my_route.legs[i]);
                for (var i = 0; i < my_route.legs.length; i++) {

                    var marker = new google.maps.Marker({
                        position: my_route.legs[i].start_location,
                        label: "mursi"+(i),
                        map: map
                    });

                    var marker = new google.maps.Marker({
                        position: my_route.legs[i].end_location,
                        label: "seham"+(i),
                        map: map
                    });

                }
						
						
//						Special loop for center points
						console.log('center points is' + centerPoint.length );
				for (var s = 0; s < centerPoint.length ; s++) {

                  console.log('pointt ' + centerPoint[s]);
                    var marker = new google.maps.Marker({
                        position: centerPoint[s],
                        label: "middle marker " +(s),
                        map: map
                    });

                    

                }
						




            } else {
                window.alert('Impossible d afficher la route ' + status);
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsT140mx0UuES7ZwcfY28HuTUrTnDhxww&callback=initMap">
</script>
</body>
</html>
