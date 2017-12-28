<?php

$lat=$_GET["lat"];
$lon=$_GET["lon"];
$urlr = 'https://transit.land/api/v1/routes.geojson?bbox='.floatval($lon-0.005).','.floatval($lat-0.005).','.floatval($lon+0.005).','.floatval($lat+0.005);

$srcr = file_get_contents($urlr);

echo $srcr;
 ?>
