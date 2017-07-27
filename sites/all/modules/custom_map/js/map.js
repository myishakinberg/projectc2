window.onload = getLocation;

function getLocation() {
    navigator.geolocation.getCurrentPosition(sendPosition);
}

function sendPosition(position) {
    var act_lat =  position.coords.latitude;
    var act_lon = position.coords.longitude;

    var lat = document.getElementsByName("field_test_part_2[0][value][lat]");
    lat.item(0).value = act_lat;

    var lon = document.getElementsByName("field_test_part_2[0][value][lon]");
    lon.item(0).value = act_lon;

}