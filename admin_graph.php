<?php /*
$link = mysql_connect("localhost", "result", "1Littleme!");
mysql_select_db("result-mysql", $link); 

$conditional_query = "SELECT address,latitude,longitude FROM EDay_walk_list_A WHERE longitude !=' '";
$result = mysql_query($conditional_query) or die (mysql_error());
$i = 1;
while ($auth_as_row = mysql_fetch_array ($result))
{
$show_address= $auth_as_row['address'];
$show_latitude= $auth_as_row['latitude'];
$show_longitude= $auth_as_row['longitude'];
$new_result .= $auth_as_row['address'].$auth_as_row['latitude'].",".$auth_as_row['longitude'] ; 
    $i++; 
}
*/?>
<!DOCTYPE html> 

<html> 
  <head> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    
  </head> 
<div data-role="page">
<header data-role="header" data-theme="b">
<h4>Map</h4>
<a href="/Survey_new.php">Survey</a>
<a href="/Login.html">Sign out</a>
</header>
  <body> 

  </head>
  <body>
  
  
    <div id="map"></div>
<section id="wrapper">


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <article>

    </article>
<script>

function success(position) {
  var mapcanvas = document.createElement('div');
  mapcanvas.id = 'mapcontainer';
  mapcanvas.style.height = '550px';
  mapcanvas.style.width = '1280px';

  document.querySelector('article').appendChild(mapcanvas);

  var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var locations = [
					
		 <?php
$link = mysql_connect("localhost", "result", "1Littleme!");
mysql_select_db("result-mysql", $link); 

$conditional_query = "SELECT address,latitude,longitude FROM EDay_walk_list_A WHERE  completed ='Yes'";
$result = mysql_query($conditional_query) or die (mysql_error());
$i = 1;
while ($auth_as_row = mysql_fetch_array ($result))
{
$show_name = $auth_as_row['name'];
$show_address= $auth_as_row['address'];
$show_latitude= $auth_as_row['latitude'];
$show_longitude= $auth_as_row['longitude'];
 

echo '[\''.$show_address.'\','.$show_latitude.','.$show_longitude.','.'5'.'],';
$i++;
}
?>
					
				];
      
      
  var options = {
    zoom: 10,
    center: coords,
    mapTypeControl: false,
    navigationControlOptions: {
    	style: google.maps.NavigationControlStyle.SMALL
    },
    mapTypeId: google.maps.MapTypeId.HYBRID
  };
  var map = new google.maps.Map(document.getElementById("mapcontainer"), options);

   var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    };
}

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(success);
  
} else {
  error('Geo Location is not supported');
}

</script>
</section>

</body>
</html>