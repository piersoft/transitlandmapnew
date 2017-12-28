<?php

$lat=$_GET["lat"];
$lon=$_GET["lon"];
$r=$_GET["r"];

?>

<!DOCTYPE html>
<html lang="it">
  <head>
  <title>Trasporti Open</title>
  <link rel="stylesheet" href="http://necolas.github.io/normalize.css/2.1.3/normalize.css" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
   <link rel="stylesheet" href="http://turbo87.github.io/leaflet-sidebar/src/L.Control.Sidebar.css" />
   <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="MarkerCluster.css" />
        <link rel="stylesheet" href="MarkerCluster.Default.css" />
        <meta property="og:image" content="http://www.piersoft.it/transitland/bus_.png"/>
  <script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
<script src="http://turbo87.github.io/leaflet-sidebar/src/L.Control.Sidebar.js"></script>
   <script src="leaflet.markercluster.js"></script>
<script type="text/javascript">

function microAjax(B,A){this.bindFunction=function(E,D){return function(){return E.apply(D,[D])}};this.stateChange=function(D){if(this.request.readyState==4 ){this.callbackFunction(this.request.responseText)}};this.getRequest=function(){if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP")}else { if(window.XMLHttpRequest){return new XMLHttpRequest()}}return false};this.postBody=(arguments[2]||"");this.callbackFunction=A;this.url=B;this.request=this.getRequest();if(this.request){var C=this.request;C.onreadystatechange=this.bindFunction(this.stateChange,this);if(this.postBody!==""){C.open("POST",B,true);C.setRequestHeader("X-Requested-With","XMLHttpRequest");C.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");C.setRequestHeader("Connection","close")}else{C.open("GET",B,true)}C.send(this.postBody)}};
function microAjax2(B,A){this.bindFunction=function(E,D){return function(){return E.apply(D,[D])}};this.stateChange=function(D){if(this.request.readyState==4 ){this.callbackFunction(this.request.responseText)}};this.getRequest=function(){if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP")}else { if(window.XMLHttpRequest){return new XMLHttpRequest()}}return false};this.postBody=(arguments[2]||"");this.callbackFunction=A;this.url=B;this.request=this.getRequest();if(this.request){var C=this.request;C.onreadystatechange=this.bindFunction(this.stateChange,this);if(this.postBody!==""){C.open("POST",B,true);C.setRequestHeader("X-Requested-With","XMLHttpRequest");C.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");C.setRequestHeader("Connection","close")}else{C.open("GET",B,true)}C.send(this.postBody)}};

</script>
  <style>
  #mapdiv{
        position:fixed;
        top:0;
        right:0;
        left:0;
        bottom:0;
        font-family: Titillium Web, Arial, Sans-Serif;
}
#infodiv{
       position:fixed;
        left:2px;
        bottom:2px;
	font-size: 10px;
        z-index:9999;
        border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border: 2px solid #808080;
        background-color:#fff;
        padding:5px;
        box-shadow: 0 3px 14px rgba(0,0,0,0.4)
}
#loader {
    position:absolute; top:0; bottom:0; width:100%;
    background:rgba(255, 255, 255, 0.9);
    transition:background 1s ease-out;
    -webkit-transition:background 1s ease-out;

}
#loader.done {
    background:rgba(255, 255, 255, 0);
}
#loader.hide {
    display:none;
}
#loader .message {
    position:absolute;
    left:50%;
    top:50%;
}
p.pic {
    width: 48px;
    margin-right: auto;
    margin-left: 18px;
}

        .lorem {
            font-style: Titillium Web;
            color: #AAA;
        }
</style>
<link rel="stylesheet" href="LeafletControlGeocoder/Control.Geocoder.css" />

  </head>

<body>

  <div data-tap-disabled="true">

 <div id="mapdiv"></div>
 <div id="sidebar">

</div>
<div id="infodiv" style="leaflet-popup-content-wrapper">
  <p><b>Trasporti OpenData attorno a te<br></b>
  Mappa con fermate, linee e orarie dei trasporti pubblici e privati censiti su Transit.Land. Map by @piersoft. Fonte dati e licenze: <a href="https://transit.land/feed-registry/">Transitland</a></br>Il parametro <b>r</b> nell'URL è il raggio in metri da 200 a 190000 (190km). Codice sorgente su <a href="https://github.com/piersoft/transitlandmap" target="_blank">GITHUB</a></p>
</div>
<div id='loader'><span class='message'>loading<p class="pic"><img src="http://www.piersoft.it/transitland/ajax-loader.gif"></p></span></div>
</div>
<script src="LeafletControlGeocoder/Control.Geocoder.js"></script>

<script type="text/javascript">
var urlj="";
var idstop="";
var corse=0;
var stopurl;
function MostrarVideo(idYouTube)
{
  sidebar.show();
  map.closePopup();

var contenedor = document.getElementById('sidebar');
if(idYouTube == '')
{contenedor.innerHTML = '';
} else{
var url = urlj;
/*
var stopurl=idstop;
console.log(stopurl+" "+url);
if (idstop != ""){
  contenedor.innerHTML = '<iframe width="100%" height="600" src="testrt.php?id='+ stopurl +'" frameborder="0" allowfullscreen></iframe>';

}else */contenedor.innerHTML = '<iframe width="100%" height="600" src="test.php?id='+ url +'&stopurl='+encodeURI(stopurl)+'" frameborder="0" allowfullscreen></iframe>';



var element = document.getElementById("infodiv");
if (element !=null) element.parentNode.removeChild(element);
}
//finishedLoadinglong(corse);
}
</script>
<script language="javascript" type="text/javascript">
<!--

// -->
</script>

  <script type="text/javascript">
		var lat='<?php printf($_GET['lat']); ?>',
        lon='<?php printf($_GET['lon']); ?>',
        zoom=16;


        var transport = new L.TileLayer('http://{s}.tile.thunderforest.com/transport/{z}/{x}/{y}.png?apikey=4643f97f7287443bbaf68e36de6b4ecf', {minZoom: 0, maxZoom: 20, attribution: 'Map Data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'});
        var realvista = L.tileLayer.wms("http://213.215.135.196/reflector/open/service?", {
            		layers: 'rv1',
            		format: 'image/jpeg',attribution: '<a href="http://www.realvista.it/website/Joomla/" target="_blank">RealVista &copy; CC-BY Tiles</a> | <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            	});

        var osm = new L.TileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {maxZoom: 20, attribution: 'Map Data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'});
        var map = new L.Map('mapdiv', {
            editInOSMControl: true,
            editInOSMControlOptions: {
                position: "topright"
            },
            center: new L.LatLng(lat, lon),
            zoom: zoom,
            layers: [transport]
        });

        var baseMaps = {
    "Trasporti": transport,
    "Mapnik": osm,
    "RealVista": realvista
        };


    var sidebar = L.control.sidebar('sidebar', {
          closeButton: true,
          position: 'left'
      });
      map.addControl(sidebar);

        L.control.layers(baseMaps).addTo(map);
        // **************
        // Aggiunto il riferimento al geocoder che per default usa Nominatim ...
        L.Control.geocoder({position: 'topleft'}).addTo(map);
        // **************

        var markeryou = L.marker([parseFloat('<?php printf($_GET['lat']); ?>'), parseFloat('<?php printf($_GET['lon']); ?>')]).addTo(map);
        markeryou.bindPopup("<b>Sei qui</b>");
       var ico=L.icon({iconUrl:'circle.png', iconSize:[20,20],iconAnchor:[10,00]});
       var icov=L.icon({iconUrl:'circleint.png', iconSize:[20,20],iconAnchor:[10,00]});

       var markers = L.markerClusterGroup({spiderfyOnMaxZoom: false, showCoverageOnHover: true,zoomToBoundsOnClick: true});

        function loadLayer(url)
        {
                var myLayer = L.geoJson(url,{
                        onEachFeature:function onEachFeature(feature, layer) {
                                if (feature.properties && feature.properties.id) {

                                }

                        },
                        pointToLayer: function (feature, latlng) {
                          var icona=ico;
                          if (feature.properties.wheelchair_boarding == "1") icona=icov;
                        var marker = new L.Marker(latlng, { icon: icona });

                        markers[feature.properties.id] = marker;
                        marker.bindPopup('<img src="http://www.piersoft.it/transitland/ajax-loader.gif">',{maxWidth:50, autoPan:true});

                      //  marker.on('click',showMarker());
                        return marker;
                        }
                });
                //.addTo(map);

                markers.addLayer(myLayer);
                map.addLayer(markers);
                markers.on('click',showMarker);
        }


        function get_random_color()
        {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ )
            {
               color += letters[Math.round(Math.random() * 15)];
            }
        return color;
        }


        function loadLayerR(url)
        {
          var text="";
          var myStyle="";
                var myLayer = L.geoJson(url,{
                        onEachFeature:function onEachFeature(feature, layer) {


                              if (feature.properties) {

                                text =feature.properties.title;
                                   //console.log("color: "+feature.properties.color);
                                   layer.setStyle({color :get_random_color()});
                                   layer.bindPopup(text);
                                   }




                           },

                        pointToLayer: function (feature, latlng) {
                        var marker = new L.Marker(latlng, { icon: ico });

                        markers[feature.properties.title] = marker;
                        marker.bindPopup(text);

                      //  marker.on('click',showMarker());
                        return marker;
                        }
                }).addTo(map);

              //  markers.addLayer(myLayer);
               map.addLayer(myLayer);
              //  markers.on('click',showMarker);
        }

        microAjax('datastops.php?lat=<?php printf($_GET['lat']); ?>&lon=<?php printf($_GET['lon']); ?>&r=<?php printf($_GET['r']); ?>',function (res) {
        var feat=JSON.parse(res);
        //console.log(feat);
        loadLayer(feat);
        route();
          finishedLoading();
        } );

  function route(){
        microAjax('data.php?lat=<?php printf($_GET['lat']); ?>&lon=<?php printf($_GET['lon']); ?>',function (res1) {
        var feat1=JSON.parse(res1);
        loadLayerR(feat1);
          finishedLoading();
        } );

}
function convertTimestamp(timestamp) {
  var d = new Date(timestamp * 1000),	// Convert the passed timestamp to milliseconds
		yyyy = d.getFullYear(),
		mm = ('0' + (d.getMonth() + 1)).slice(-2),	// Months are zero based. Add leading 0.
		dd = ('0' + d.getDate()).slice(-2),			// Add leading 0.
		hh = d.getHours(),
		h = hh,
		min = ('0' + d.getMinutes()).slice(-2),		// Add leading 0.
		ampm = 'AM',
		time;

	if (hh > 12) {
	//	h = hh - 12;
		ampm = 'PM';
	} else if (hh === 12) {
	//	h = 12;
		ampm = 'PM';
	} else if (hh == 0) {
		h = 12;
	}

	// ie: 2013-02-18, 8:35 AM
	time = h + ':' + min;

	return time;
}

 function showMarker(marker) {

   var jsonref=marker.layer.feature;
  //  //console.log(jsonref);
  var i = 0;
 for (i=0;i<4;i++){
   microAjax('https://transit.land/api/v1/onestop_id/'+jsonref.properties.id, function (res) {

   var feat=JSON.parse(res);
   var index;
   //console.log(feat.routes_serving_stop);
   //console.log(jsonref.properties.id[0]);

//  alert (feat.length);
var text;



if(feat['routes_serving_stop'].length != "undefined")
{
  if(feat['routes_serving_stop'].length == "0")
  {
  text ="Non ci sono linee in arrivo nelle prossime ore.</br>NB: Il tuo gestore ha aggiornato gli orari in opendata?";
  marker.layer.closePopup();
  marker.layer.bindPopup(text);
  marker.layer.openPopup();
  //console.log("non ci sono linee");
}else{
  corse=feat['routes_serving_stop'].length;
urlj=jsonref.properties.id;

//console.log(jsonref.properties.stopurl);
var string =jsonref.properties.stopurl
    substring = "http://www.gtt.to.it";

if (jsonref.properties.stopurl != null && string.indexOf(substring) !== -1){
  ////console.log(jsonref.properties);
  /*
  text ="<b>"+jsonref.properties.name+"</b></br><a href='#' onClick='MostrarVideo();'>Clicca per realtime</a></br><b>";
idstop=jsonref.properties.name;*/
idstop="";
stopurl=jsonref.properties.stopurl;
stopurl=stopurl.replace("http://www.gtt.to.it/cms/percorari/arrivi?option=com_gtt&view=palina&realtime=true&palina=","");
console.log('stopurl in locator: '+stopurl);
text ="<b>"+jsonref.properties.name+"</b></br><a href='#' onClick='MostrarVideo();'>Clicca per orari realtime</a></br>servita dalle linee: <b>";
for (i=0;i<feat['routes_serving_stop'].length;i++){

   //   // when the tiles load, remove the screen
   var last=feat['routes_serving_stop'][i];
//    console.log("routes_serving_stop:"+feat['routes_serving_stop'][i]['route_name']);
 //  var text ="Linee servite: "+last['IdLinea']+"<br>";
   text +="</br>"+last['route_name'];
//    var orario =last['route_name'];
//    text+="</b> orario<b>"+orario;
 }
}
  else {
    idstop="";
    text ="<b>"+jsonref.properties.name+"</b></br><a href='#' onClick='MostrarVideo();'>Clicca per orari programmati</a></br>servita dalle linee: <b>";
//console.log("Feat lenght: "+feat['routes_serving_stop'].length);


 for (i=0;i<feat['routes_serving_stop'].length;i++){

    //   // when the tiles load, remove the screen
    var last=feat['routes_serving_stop'][i];
//console.log("routes_serving_stop:"+feat['routes_serving_stop'][i]['route_name']);
  //  var text ="Linee servite: "+last['IdLinea']+"<br>";
    text +="</br>"+last['route_name'];
//    var orario =last['route_name'];
//    text+="</b> orario<b>"+orario;
  }
    }
    if (jsonref.properties.wheelchair_boarding =="1") text+="</br><i>Accessibile in carrozzina</i>";
    marker.layer.closePopup();
    marker.layer.bindPopup(text);
    marker.layer.openPopup();


}
}

}
  );
}
}

function startLoading() {
    loader.className = '';
}

function finishedLoadinglong(corse) {
    // first, toggle the class 'done', which makes the loading screen
    // fade out
    loader.className = 'done';
    if (corse >= 9){
    setTimeout(function() {

        loader.className = 'hide';
    }, 15000);
    }
    else if (corse >= 5){
    setTimeout(function() {

        loader.className = 'hide';
    }, 9000);
  }else if (corse >= 3){
    setTimeout(function() {

        loader.className = 'hide';
    }, 5000);
  }else{
    setTimeout(function() {

        loader.className = 'hide';
    }, 3000);
  }
}
function finishedLoading() {
    // first, toggle the class 'done', which makes the loading screen
    // fade out
    loader.className = 'done';
    setTimeout(function() {
        // then, after a half-second, add the class 'hide', which hides
        // it completely and ensures that the user can interact with the
        // map again.
        loader.className = 'hide';
    }, 500);
}
      sidebar.on('show', function () {
          //console.log('Sidebar will be visible.');
      });

      sidebar.on('shown', function () {
          //console.log('Sidebar is visible.');
      });

      sidebar.on('hide', function () {
          //console.log('Sidebar will be hidden.');
      });

      sidebar.on('hidden', function () {
          //console.log('Sidebar is hidden.');
      });

      L.DomEvent.on(sidebar.getCloseButton(), 'click', function () {
          //console.log('Close button clicked.');
          location.reload();
      });
</script>

</body>
</html>
