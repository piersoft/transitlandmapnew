<?php

//file di test
$lat=$_GET["lat"];
$lon=$_GET["lon"];
$r=$_GET["raggio"];
$text=$_GET["id"];
$stopurl=$_GET["stopurl"];
$text1=$_GET["route"];
$numero_giorno_settimana = date("w");
if ($numero_giorno_settimana == 2) $numero_giorno_settimana =1;
if ($numero_giorno_settimana == 3) $numero_giorno_settimana =2;
if ($numero_giorno_settimana == 4) $numero_giorno_settimana =3;
if ($numero_giorno_settimana == 5) $numero_giorno_settimana =4;
if ($numero_giorno_settimana == 6) $numero_giorno_settimana =5;
if ($numero_giorno_settimana == 0) $numero_giorno_settimana =6;
//echo $numero_giorno_settimana;
$c=0;
$t=0;


date_default_timezone_set("Europe/Rome");
$ora=date("H:i:s", time());
$ora2=date("H:i:s", time()+60*60);
//echo $ora." ".$ora2."</br>";
$today = date ("Y-m-d");
//$today="2015-06-15";
$distanza=[];
//echo $ora." ".$ora2;
$json_string = file_get_contents("https://transit.land/api/v1/onestop_id/".$text);
$parsed_json = json_decode($json_string);
$count = 0;
$countl = 0;
$namedest=$parsed_json->{'name'};
$IdFermata="";

foreach($parsed_json->{'routes_serving_stop'} as $data=>$csv1){
 $count = $count+1;
}
//  echo "linee: ".$count."</br>";




$countl=0;
$countl2=0;

$json_string1 = file_get_contents("https://transit.land/api/v1/schedule_stop_pairs?destination_onestop_id=".$text."&origin_departure_between=".$ora.",".$ora2."&date=".$today);

//echo $json_string1;
//echo "https://transit.land/api/v1/schedule_stop_pairs?destination_onestop_id=".$text."&origin_departure_between=".$ora.",".$ora2."&date=".$today;
$parsed_json1 = json_decode($json_string1);


foreach($parsed_json1->{'schedule_stop_pairs'} as $data12=>$csv11){
 $countl = $countl+1;
}

$start=0;
if ($countl == 0){

}else{
    $start=1;
}
//echo "numero arrivi:".$countl."</br>";
$temp_c1="";
for ($l=0;$l<$countl;$l++)
  {

  	if (($parsed_json1->{'schedule_stop_pairs'}[$l]->{'service_days_of_week'}[$numero_giorno_settimana]) == "true")
  	  {

        $distanza[$l]['orari']=$parsed_json1->{'schedule_stop_pairs'}[$l]->{'destination_arrival_time'};
        $json_string2 = file_get_contents("https://transit.land/api/v1/onestop_id/".$parsed_json1->{'schedule_stop_pairs'}[$l]->{'origin_onestop_id'});
        $parsed_json2 = json_decode($json_string2);
        $name=$parsed_json2->{'name'};
        //echo $json_string2;
      //  echo $parsed_json2->{'routes_serving_stop'}[0]->{'route_onestop_id'};
        foreach($parsed_json2->{'routes_serving_stop'} as $data12=>$csv11){
      //    echo $parsed_json2->{'routes_serving_stop'}[$data12]->{'route_onestop_id'};
        if ($parsed_json2->{'routes_serving_stop'}[$data12]->{'route_onestop_id'}==$parsed_json1->{'schedule_stop_pairs'}[$l]->{'route_onestop_id'}){
          $linea=$parsed_json2->{'routes_serving_stop'}[$data12]->{'route_name'};
          $temp_c1 .="Linea: <b>".$linea."</b> arrivo: <b>";
        //  $temp_c1 .=$parsed_json1->{'schedule_stop_pairs'}[$l]->{'destination_arrival_time'};
          $temp_c1 .=$distanza[$l]['orari']."</b>\n<br>proveniente da: ".$name;
          $temp_c1 .="</br>";
        }
        }


        $c++;
      }else
    	  {
foreach ($parsed_json1->{'schedule_stop_pairs'}[$l]->{'service_added_dates'} as $datacd=>$csv11cd) {

    if ($parsed_json1->{'schedule_stop_pairs'}[$l]->{'service_added_dates'}[$datacd] == $today){
    //  echo "debug: trovata linea nel calendar_dates";
          $distanza[$l]['orari']=$parsed_json1->{'schedule_stop_pairs'}[$l]->{'destination_arrival_time'};
          $json_string2 = file_get_contents("https://transit.land/api/v1/onestop_id/".$parsed_json1->{'schedule_stop_pairs'}[$l]->{'origin_onestop_id'});
          $parsed_json2 = json_decode($json_string2);
          $name=$parsed_json2->{'name'};
          //echo $json_string2;
        //  echo $parsed_json2->{'routes_serving_stop'}[0]->{'route_onestop_id'};
          foreach($parsed_json2->{'routes_serving_stop'} as $data12=>$csv11){
        //    echo $parsed_json2->{'routes_serving_stop'}[$data12]->{'route_onestop_id'};
          if ($parsed_json2->{'routes_serving_stop'}[$data12]->{'route_onestop_id'}==$parsed_json1->{'schedule_stop_pairs'}[$l]->{'route_onestop_id'}){
            $linea=$parsed_json2->{'routes_serving_stop'}[$data12]->{'route_name'};
            $temp_c1 .="Linea: <b>".$linea."</b> arrivo: <b>";
          //  $temp_c1 .=$parsed_json1->{'schedule_stop_pairs'}[$l]->{'destination_arrival_time'};
            $temp_c1 .=$distanza[$l]['orari']."</b>\n<br>proveniente da: ".$name;
            $temp_c1 .="</br>";
          }
          }


          $c++;
        }
      }
}
  //  }

  }
  sort($distanza);

if ( $start==1){
echo "<font face='verdana'>Linee in arrivo nella prossima ora a <b>".$namedest."</b>\n<br>";
}else{
  echo "<font face='verdana'>Non ci sono arrivi nella prossima ora.</br></br>NB: Può capitare che gli orari forniti dal gestore siano scaduti e non più validi. Controlla su <a href='https://transit.land/feed-registry/' target='_blank'>TransitLand</a>";

}

echo "\n<br><font face='verdana'>".$temp_c1;
if ($stopurl !=undefined) echo "</br>Per orari realtime clicca :<a href='http://www.gtt.to.it/cms/percorari/arrivi?option=com_gtt&view=palina&realtime=true&palina=".urlencode($stopurl)."' target='_blank'>QUI</a>";



?>
