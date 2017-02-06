var map;
var directionsService;
var directionsDisplay;

var myPosition;
var latlng;

function initMap() {


    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;

    map = new google.maps.Map(document.getElementById('map'), {

        zoom: 12
    });

    directionsDisplay.setMap(map);

    function calculateAndDisplayRoute(directionsService, directionsDisplay, o, e) {
        directionsService.route({
            origin: o,
            destination: e,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }





    function maPosition(position) {

        myPosition = position

        var infopos = "Position déterminée :\n";
        infopos += "Latitude : "+position.coords.latitude +"\n";
        infopos += "Longitude: "+position.coords.longitude+"\n";
        infopos += "Altitude : "+position.coords.altitude +"\n";
        infopos += "Vitesse  : "+position.coords.speed +"\n";



        latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);


        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title:"Vous êtes ici"
        });


        map.panTo(latlng);

    }





    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(maPosition, function() {
            //handleLocationError(true, infoWindow, map.getCenter());
            console.log("Ok");
        });
    } else {
        // Browser doesn't support Geolocation
        //handleLocationError(false, infoWindow, map.getCenter());
        console.log("Error");
    }




    var flightPlanCoordinates = [
        {lat: 37.772, lng: -122.214},
        {lat: 21.291, lng: -157.821},
        {lat: -18.142, lng: 178.431},
        {lat: -27.467, lng: 153.027}
    ];
    var flightPath = new google.maps.Polyline({
        path: flightPlanCoordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });

    flightPath.setMap(map);


    var marker1 = new google.maps.Marker({
        position: latlng,
        map: map,
        title:"Vous êtes ici"
    });



}



//https://maps.googleapis.com/maps/api/geocode/json?address=&key=AIzaSyBx5RW1xR1AAL_A874x9_pXzV85KA7T66g


function createMarker(latlng) {

    // If the user makes another search you must clear the marker variable


    marker = new google.maps.Marker({
        map: map,
        position: latlng
    });

}



function searchAddress() {

    var addressInput = document.getElementById('address').value;

    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({address: addressInput}, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {

            var myResult = results[0].geometry.location; // reference LatLng value

            createMarker(myResult); // call the function that adds the marker

            map.setCenter(myResult);

            map.setZoom(17);

            calculateAndDisplayRoute(directionsService, directionsDisplay, myPosition, myResult);

        }
    });
}





function toggleBounce() {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}