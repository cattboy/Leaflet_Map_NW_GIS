<?php
session_start();
if (!isset($_SESSION['sessionID']))
{
    echo "Inside map but session not set " . $_SESSION["sessionID"] . ".";
    header("Location: /htdocs/login5_sessions/login.php");
    die();
    //exit()
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Game World Map</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- original locations -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  

  <link rel="stylesheet" href="leaflet/leaflet.css" />
    <link rel="stylesheet" href="css/leaflet-sidebar.css" />
 //<link rel="stylesheet" href="ZoomLabel/L.Control.ZoomLabel.css" />

    <style>
        body {
            padding: 0;
            margin: 0;
        }
        html, body, #map {
            height: 100%;
            font: 10pt "Helvetica Neue", Arial, Helvetica, sans-serif;
        }
    html { overflow-y: hidden; } <!--HIDE SCROLL BAR ON RIGHT SIDE-->
        .lorem {
            font-style: italic;
            color: #AAA;
        }
    </style>
</head>
<body>
    <div id="sidebar" class="sidebar collapsed">
        <!-- Nav tabs -->
        <div class="sidebar-tabs">
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-bars"></i></a></li>
                <li><a href="#profile" role="tab"><i class="fa fa-user"></i></a></li>
                <li class="disabled"><a href="#messages" role="tab"><i class="fa fa-envelope"></i></a></li>
                <li><a href="https://youtube.com/cattboy" role="tab" target="_blank"><i class="fa fa-github"></i></a></li>
            </ul>

            <ul role="tablist">
                <li><a href="#settings" role="tab"><i class="fa fa-gear"></i></a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="sidebar-content">
            <div class="sidebar-pane" id="home">
                <h1 class="sidebar-header">
                    <!-- sidebar-v2 -->
                    <span class="sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>

                

                <p class="filters_gathering"><h2>Resource Nodes</h2>
                <p> 
  <input type="checkbox" name="harvesting" value="Harvesting_Herbs">Harvesting Herbs<br>
  <input type="checkbox" name="mining" value="Mining">Mining<br>
<input type="checkbox" name="lumberjacking" value="Lumberjacking">Lumberjacking<br>
<input type="checkbox" name="skinable_monsters" value="Skinable_monsters">Skinable Monsters<br>
<input type="checkbox" name="chests_spawns" value="Chests_spawns">Chest Locations<br>

<input type="checkbox" name="claims" value="Claims">Claims<br>
<input type="checkbox" name="outposts" value="Outposts">Outposts<br>
<input type="checkbox" name="pois" value="PoIs">Points of Interest<br>

<input type="checkbox" name="monster_spawns" value="Monster_spawns">Monster Spawns<br>
<input type="checkbox" name="mining" value="Mining" checked>Mining<br>




                </p>

                <p>Check any box to display its location.</p>
                <br>
                </p>
             <br>
         <p>A responsive sidebar for mapping libraries like <a href="http://google.com">Gooogle APIs</a> or <a href="http://openlayers.org/">OpenLayers</a>.</p>
                 <br>
                <p class="lorem">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            </div>

            <div class="sidebar-pane" id="profile">
                <h1 class="sidebar-header">Profile<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            </div>

            <div class="sidebar-pane" id="messages">
                <h1 class="sidebar-header">Messages<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            </div>

            <div class="sidebar-pane" id="settings">
                <h1 class="sidebar-header">Settings<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            </div>
        </div>
    </div>

    <div id="map" class="sidebar-map"></div>


  <script src="leaflet/leaflet.js"></script>
    <script src="js/leaflet-sidebar.js"></script>
      //<script src="ZoomLabel/L.Control.ZoomLabel.js"></script>

    <script>
      var gameworldX = 14334;
      var gameworldY = 14334;

     //Gameworld Cords 2^15
      var width = 32768;
      var height = 32768;




      //These are the offset values for the tile-size we're using... 
      var xOffset = 2.2860332077577787079670712990093; //= Width/gameworldX 
      var yOffset = 2.2860332077577787079670712990093; //= height/gameworldY



   
var map = L.map('map', {
        // preferCanvas: true,
        // trackResize: false,
        zoom: 0,
        minZoom: -50,
        maxZoom: 8,
        zoomSnap: 0.25,  //change to make the map zoom in slower, lower is slower
        zoomDelta: 0.25, //change to make the map zoom in slower, lower is slower
        wheelPxPerZoomLevel: 200, //change to make the map zoom in slower, HIGHER is slower
        attributionControl: false,
        // zoomControl: false, //The +/- Control buttons default true
        continuousWorld: false,
        //preferCanvas: true,
        scrollWheelZoom: true,
        crs: L.CRS.Simple
    }).setView([0, 0], 0);
 


 L.tileLayer('2topwr15_NewMap_Tiles512_Compressed/{z}/{x}/{y}.png', { //tileSize: 512 //looks very good



        // bounds: new L.LatLngBounds(map.unproject([0, 0], 7), map.unproject([width, height], 7)),
        tms: false,
        noWrap: true,
        tileSize: 512,
        detectRetina: true,
        // maxNativeZoom: 12,
        zoomSnap: .01,
        zoomDelta: .01,
        maxZoom: 8,
        minZoom: -1,
        // zoomOffset: 1,
        crs: L.CRS.Simple
    }).addTo(map);

//L.control.zoomLabel().addTo(map);








// WORKING AREA
// WORKING AREA


// WORKING AREA
// WORKING AREA






// WORKING AREA
// WORKING AREA


// WORKING AREA 
//TEST #1



map.on('click', function(e) {
  doStuff(e);
});


function doStuff(e) {
 
  console.log(e.latlng);
  // coordinates in tile space
  var x = e.layerPoint.x;
  var y = e.layerPoint.y;
  console.log([x, y]);
 
 
 
 var xy = this.map.project([e.latlng.lat,e.latlng.lng],6);
 
 
 
 
      console.log("this is the pixel count location: " + xy);

      //This returns the in-game value...
      xy2 = [xy.x/xOffset,(height-xy.y)/yOffset];

      console.log("this is the ingame location: " + xy2);



};
    







        var marker = L.marker([0, 0]).addTo(map);
        var sidebar = L.control.sidebar('sidebar').addTo(map);
    </script>
</body>
</html>
