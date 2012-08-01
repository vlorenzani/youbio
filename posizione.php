
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <title>Google Maps JavaScript API v3 Example: Map Geolocation</title>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript">
            var initialLocation;
            var siberia = new google.maps.LatLng(60, 105);
            var newyork = new google.maps.LatLng(40.69847032728747, -73.9514422416687);
            var browserSupportFlag =  new Boolean();



            function initialize() {
                var myOptions = {
                    zoom: 6,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                myListener = google.maps.event.addListener(map, 'click', function(event) {
                    placeMarker(event.latLng);
                    google.maps.event.removeListener(myListener);
                });
                google.maps.event.addListener(map, 'drag', function(event) {
                    placeMarker(event.latLng);
                    google.maps.event.removeListener(myListener);
                });

                // Try W3C Geolocation (Preferred)
                if(navigator.geolocation) {
                    browserSupportFlag = true;
                    navigator.geolocation.getCurrentPosition(function(position) {
                        initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                        map.setCenter(initialLocation);
                    }, function() {
                        handleNoGeolocation(browserSupportFlag);
                    });
                    // Try Google Gears Geolocation
                } else {
                    browserSupportFlag = false;
                    handleNoGeolocation(browserSupportFlag);
                }

                function handleNoGeolocation(errorFlag) {
                    if (errorFlag === true) {
                        alert("Geolocation service failed.");
                        initialLocation = newyork;
                    } else {
                        alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
                        initialLocation = siberia;
                    }
                }

                function placeMarker(location) {
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map,
                        draggable: true
                    });
                    map.setCenter(location);
                    var markerPosition = marker.getPosition();
                    populateInputs(markerPosition);
                    google.maps.event.addListener(marker, "drag", function (mEvent) {
                        populateInputs(mEvent.latLng);
                    });
                }
                function populateInputs(pos) {
                    document.getElementById("t1").value=pos.lat()
                    document.getElementById("t2").value=pos.lng();
                }
            }

        </script>
    </head>
    <body onload="initialize()">
        <div id="map_canvas" style="width: 500px; height: 500px"></div>
        <input type="text" id="t1" name="t1" />
        <input type="text" id="t2" name="t2" />
        Aggiorna la mia posizione
        <div id="map_canvas" style="width: 500px; height: 500px"></div>    
        Per aggiornare la posizione clicca su un punto e trascina il maker fino al punto interessato, successivamente clicca Salva.  
        <form><input type="text" id="t1" name="t1" /></input>
        <input type="text" id="t2" name="t2" /></input>
        <input type="submit" name="Salva"></input>
        </form>
    </body>
</html>
