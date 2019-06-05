<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <div id="map"></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>

<script>
var p1 = new google.maps.LatLng(2.919307, 101.772102);
var p2 = new google.maps.LatLng(2.999165, 101.785463);

alert(calcDistance(p1, p2));

//calculates distance between two points in km's
function calcDistance(p1, p2) {
  return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
}

</script>
</body>
</html>


