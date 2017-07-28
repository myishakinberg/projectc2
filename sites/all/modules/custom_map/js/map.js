window.onload = tryAPIGeolocation;


function sendPosition(position) {
    var act_lat =  position.coords.latitude;
    var act_lon = position.coords.longitude;
    var lat = document.getElementsByName("field_test_part_2[0][value][lat]");
    lat.item(0).value = act_lat;

    var lon = document.getElementsByName("field_test_part_2[0][value][lon]");
    lon.item(0).value = act_lon;

}

function tryAPIGeolocation() {
    jQuery.post( "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCgQtF_rKAVSQzyR30KebWYi6VrDhCrcW4", function(success) {
        sendPosition({coords: {latitude: success.location.lat, longitude: success.location.lng}});
    });
};