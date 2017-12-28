<?php

$lat=$_GET["lat"];
$lon=$_GET["lon"];
$r=$_GET["r"];

function geoJson ($locales)
    {
        $original_data = json_decode($locales, true);
        $features = array();

        foreach($original_data['stops'] as $key => $value) {
            $features[] = array(
                    'type' => 'Feature',
                    'geometry' => array('type' => 'Point', 'coordinates' => array((float)$value['geometry']['coordinates'][0],(float)$value['geometry']['coordinates'][1])),
                    'properties' => array('name' => $value['name'], 'id' => $value['onestop_id'],'stopurl' => $value['tags']['stop_url'],'wheelchair_boarding' =>$value['tags']['wheelchair_boarding']),
                    );
            };

        $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);
        return json_encode($allfeatures, JSON_PRETTY_PRINT);

    }

$url = 'https://transit.land/api/v1/stops?lon='.$lon.'&lat='.$lat.'&r='.$r."&per_page=1000";


$original_json_string = file_get_contents($url, true);
//echo $original_json_string;

$geostring=geoJson($original_json_string);

echo $geostring;
 ?>
