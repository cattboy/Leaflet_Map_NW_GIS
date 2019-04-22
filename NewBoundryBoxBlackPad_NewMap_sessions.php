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
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" /> -->

	<!-- not working with icons -->
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
	<!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
	<!-- <link href="fontawesome-free-5.7.2-web/css/fontawesome.min.css" rel="stylesheet"> -->
	
	



  <link rel="stylesheet" href="leaflet/leaflet.css" />
  <link rel="stylesheet" href="css/leaflet-sidebar.css" />
  <link rel="stylesheet" href="ZoomLabel/L.Control.ZoomLabel.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="leaflet/leaflet.js"></script>
  <script src="js/leaflet-sidebar.js"></script>
  <script src="ZoomLabel/L.Control.ZoomLabel.js"></script>
  <!-- <script src="1_WorkingJS/submit_popup_to_mapv3.js"></script> -->
  <!-- <script src="1_WorkingJS/airman_example_hide_dropdowns.js"></script> -->
  <!-- <script src="1_WorkingJS\airman_example_hide_dropdowns.js"></script> -->
  <!-- <script src="popup/popup_submit.js"></script>    -->
      
      <!-- //NEED TO REPLACE WITH LOCALLY HOSTED FILES -->      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
					<input type="checkbox" name="skinnable_monsters" value="Skinable_monsters">Skinable Monsters<br>
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

    <!-- <a href="https://github.com/Turbo87/sidebar-v2/"><img style="position: fixed; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a> -->

<!-- Original script pointing to 1.0.1 -->
    <!-- <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script> -->
	


  
    <script>
      var gameworldX = 14334;
      var gameworldY = 14334;

     // Gameworld Cords 2^15
      var width = 32768;
      var height = 32768;

// Gameworld Cords 2^16
	    // var width = 65536;
     //  var height = 65536;


      //These are the offset values for the tile-size we're using... 
      var xOffset = 2.2860332077577787079670712990093; //= Width/gameworldX 
      var yOffset = 2.2860332077577787079670712990093; //= height/gameworldY


console.log(xOffset + " y off " + yOffset);

    // var bounds2 = [[0, 6000], [9700, 14300.0]];

    // });
    // map.setView([0, 6000], 0);
    // map.setView(map.unproject([0, 6000]), 0);
  


    // var southWest = map.unproject([0,6000]);
    // var northEast = map.unproject([9700.00, 14300.0]);
    //   map.fitBounds(new L.LatLngBounds(southWest, northEast)); 
  // map.fitBounds(bounds2);
  //   var x = L.layerPoint.x;
  //   var y = L.layerPoint.y;

  // console.log(e.latlng);
  // // coordinates in tile space
  // var x = e.layerPoint.x;
  // var y = e.layerPoint.y;
  // console.log([x, y]);

  // // calculate point in xy space
  // var pointXY = L.point(x, y);
  // console.log("Point in x,y space: " + pointXY);


    // map.fitBounds(new L.LatLngBounds(southWest, northEast));
  // L.tileLayer('BOTTOMLEFT/{z}/{x}/{y}.png', {
      // L.tileLayer('tiles5 192 cut -- LOOKS BEST/{z}/{x}/{y}.png', {
    // L.tileLayer('BOTTOMLEFT 128/{z}/{x}/{y}.png', {   // tileSize: 256 //looks good   --- so does tilesize 128
      // L.tileLayer('BOTTOMLEFT 1024/{z}/{x}/{y}.png', {   
      // L.tileLayer('BOTTOMLEFT 512/{z}/{x}/{y}.png', { //tileSize: 1024 //looks very good
        // L.tileLayer('2topwr14_tile512/{z}/{x}/{y}.png', { //tileSize: 512 //looks very good
           // L.tileLayer('2topwr15_tile512/{z}/{x}/{y}.png', { //tileSize: 512 //looks very good
              // L.tileLayer('2topwr16_tile512/{z}/{x}/{y}.png', { //tileSize: 512 //looks very good

 // L.tileLayer('2topwr16_tile256_Compressed/{z}/{x}/{y}.png', { //tileSize: 512 //looks very good

         // L.tileLayer('BOTTOMLEFT 64/{z}/{x}/{y}.png', {
           // L.tileLayer('1NORESIZE/{z}/{x}/{y}.png', {



///everything above this is the old map^^^

 var osmMap = L.tileLayer('2topwr15_NewMap_Tiles512_Compressed/{z}/{x}/{y}.png', { //tileSize: 512 //looks very good



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
    });



var map = L.map('map', {
        // preferCanvas: true,
        // trackResize: false,
        layers: [osmMap], // only add one!
        zoom: 0,
        minZoom: -10,
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
    }).setView([-340.303088, -344.976769], 4);


L.control.zoomLabel().addTo(map);

//Moves the zoom dial to the top right
// new L.Control.Zoom({ position: 'topright' }).addTo(this.map);


  // map.setView([-97, -417], 0);



	 // var image = L.imageOverlay('All Filling Perfect Size cut.png').addTo(map);
	// map.fitBounds(bounds2);
    // map.fitBounds(bounds2, {padding: [0, 0, 0, 6000]});
    // map.setView([-1, 6002], 4);







// WORKING AREA
// WORKING AREA
var coolPlaces = new L.LayerGroup();
        //Outposts
        L.marker([-41.29042, 174.78219])
            .bindPopup('Te Papa').addTo(coolPlaces),
        L.marker([-41.29437, 174.78405])
            .bindPopup('Embassy Theatre').addTo(coolPlaces),
        L.marker([-41.2895, 174.77803])
            .bindPopup('Michael Fowler Centre').addTo(coolPlaces),
        L.marker([-41.28313, 174.77736])
            .bindPopup('Leuven Belgin Beer Cafe').addTo(coolPlaces),
        L.polyline([
            [-41.28313, 174.77736],
            [-41.2895, 174.77803],
            [-41.29042, 174.78219],
            [-41.29437, 174.78405]
            ]
            ).addTo(coolPlaces);

      


  var testing_map_contents = new L.LayerGroup();


//This is hte long drawn out version
// // // This needs to be lat: -6.483323023371554, lng: -243.79630050123433 , but came up wrong so I added some extra subrract into the covnertingamecordstolatlng
  // var pointInGame =   {"x": 6817.0673828125,  "y": 207.3566131591797}; //points taken from PAK
  // var markerLocation = convertIngameCordtoLatLng(pointInGame);
  // var marker3 = L.marker(markerLocation).addTo(testing_map_contents);
  // marker3.bindPopup('25m Claim!').openPopup();

//Simplified version
  var marker3 = L.marker(convertIngameCordtoLatLng({"x": 7017.0673828125,  "y": 207.3566131591797})).addTo(testing_map_contents);
  marker3.bindPopup('25m Claim2!').openPopup();



//Outposts


// Wind's Edge
// Windsfield  
// Weaver Post
// Weaver Station
// Weaver's Peak
// Brightmark
// Brightwatch
// Monarch Station
// Consolation Post
// Cleave's Point
// Cleaveshold
// Mountainpass

/////////////////////////////////////
// Mountainhome
//          "id": "e6ba90a2-b9d6-a3a8-99fe-501791ea3524",
//             "worldPosition": {
//                 "x": 10657.3388671875,
//                 "y": 9069.2900390625,
//                 "z": 559.0343017578125

//                 "innerRadius": 35.0,
//                 "outerRadius": 60.0,
//                 "maxHeightBlend": 1.0,
//                 "edgeNoise": 0.25,
//                 "edgeNoiseFeatureSize": 8.0,
//                 "groundNoiseScale": 0.25
//             },
//             "stringParams": [
//                 {
//                     "key": "MAP_ICON_PATH",
//                     "value": "LyShineUI/Images/Map/Icon/POIs/outpost.png"
//                     "key": "USER_FACE_NAME_LOC_KEY",
//                     "value": "ui_poi_outpost_54_1"
//                 },
//                 {
//                     "key": "FOOTPRINT_MESH_PATH",
//                     "value": "/Assets/Objects/POIs/Terrain/Footprints/Claims/Footprint_Claim_40m.obj"

////////////////////////////////////////////////////////////////





// Firstlight Station


//Lawless areas

//Need to add POLY LINES for it
// Myrkgard
// Svikin
// Brightwood Isle


//Claims



//---------------------------------------------------------------
//Taken from C:\Program Files (x86)\Amazon Games\Games Library\f2f504d9-d5a9-4937-834b-c9fda1cbea23\Assets\Config.pak\sharedassets\coatlicue\newworld_vitaeeterna\regions\r_+05_+04\capitals\

// Mettle
//      "x": 10596.578125
//             "y": 9173.2216796875,
  var marker4 = L.marker(convertIngameCordtoLatLng({"x": 10612.0302734375,  "y": 9485.013671875})).addTo(testing_map_contents);
  marker4.bindPopup('Mettle').openPopup();

//Lundsar
// "x": 10603.716796875,
//                 "y": 9254.3916015625,
  var marker4 = L.marker(convertIngameCordtoLatLng({"x": 10596.578125,  "y": 9173.2216796875})).addTo(testing_map_contents);
  marker4.bindPopup('Lundsar').openPopup();

// Ouldinger
 // "x": 10362.80859375,
 //                "y": 8942.8994140625,

  var marker4 = L.marker(convertIngameCordtoLatLng({"x": 10362.80859375,  "y": 8942.8994140625})).addTo(testing_map_contents);
  marker4.bindPopup('Ouldinger').openPopup();
//---------------------------------------------------------------




//---------------------------------------------------------------
//Taken from C:\Program Files (x86)\Amazon Games\Games Library\f2f504d9-d5a9-4937-834b-c9fda1cbea23\Assets\Config.pak\sharedassets\coatlicue\newworld_vitaeeterna\regions\r_+05_+03\capitals\

//Soddenswale
var claim = {"x": 11167.1396484375,
                "y": 6328.24072265625};
 
 var marker4 = L.marker(convertIngameCordtoLatLng(claim)).addTo(testing_map_contents);
  marker4.bindPopup('Soddenswale').openPopup();





//---------------------------------------------------------------
// C:\Program Files (x86)\Amazon Games\Games Library\f2f504d9-d5a9-4937-834b-c9fda1cbea23\Assets\Config.pak\sharedassets\coatlicue\newworld_vitaeeterna\regions\r_+05_+02\capitals\
//Mallorys Notch
var claim = {"x": 11718.1318359375,
                "y": 6008.837890625};
 
 var marker4 = L.marker(convertIngameCordtoLatLng(claim)).addTo(testing_map_contents);
  marker4.bindPopup('Mallorys Notch').openPopup();






// Monster Spawns

//Caves

//Temples (POIs?)













// WORKING AREA
// WORKING AREA




// var boundstest = map.Bounds();
// console.log("LatLngBounds boundstest output: " + boundstest);

 // 	map.setMaxBounds([
	// [-82.5, -133],
	// [82.5, 138]
	// ]);

  



// WORKING AREA
// WORKING AREA


var myLines = [{
    "type": "LineString",
    "coordinates": [[6117.359375, 98.71875], [6115.359375, 97.890625], [6114.953125, 97.1875]]
}, {
    "type": "LineString",
    "coordinates": [[-110, 45], [-110, 45], [-115, 55]]
}];

var myStyle = {
    "color": "#0000ff",
    "weight": 5,
    "opacity": 0.65


};

L.geoJSON(myLines, {
    style: myStyle
}).addTo(map);

// working but not geojson
      // var polygonPoints = [
    
      //  [-12, 5967],
      //       [-106, 6105],
      //       [-181, 5953],
      //       [-87, 5830],
      //       [-12, 5967]
      //       ];
      // var poly = L.polygon(polygonPoints).addTo(map);



var geoJsonDataLines = [{
    "type": "LineString",
    "coordinates": [[48.25, 6048.5], [54, 6128.75], [54, 6105]]
}];

L.geoJSON(geoJsonDataLines, {
   style: myStyle,
    coordsToLatLng: function (coords) {
        //                    latitude , longitude, altitude.. Enter the cords into [X,Y] and it will conver to [Y,X]
        //return new L.LatLng(coords[1], coords[0], coords[2]); //Normal behavior
        return new L.LatLng(coords[0], coords[1], coords[2]);

    }
}).addTo(map);





// WORKING AREA   /// This is all the polygons for the lawless/outposts/claims

var polygon_claims = new L.LayerGroup();

var polygon_claim_lawless = [{
    "type": "Feature",
    "properties": {"area_type": "Claim"},
    "geometry": {
 "type": "Polygon",
  "coordinates": [

    [
      convertIngameCordtoLatLng({"y": 10261.255248576756, "x": 9503.611767902165}),
      convertIngameCordtoLatLng({"y": 10311.279116067784, "x": 9544.798845089628}),
      convertIngameCordtoLatLng({"y": 10262.726538797078, "x": 9575.689152980227}),
      convertIngameCordtoLatLng({"y": 10236.24331483124, "x": 9546.269812132039}),
      convertIngameCordtoLatLng({"y": 10261.255248576756, "x": 9503.611767902165})
    ]


    ]
  }
}, {
    "type": "Feature",
    "properties": {"area_type": "Lawless"},
    "geometry": {  
  "type": "Polygon",
  "coordinates": [

    [
      convertIngameCordtoLatLng({"x": 9376.156807302901, "y": 9422.424594215221}),

      convertIngameCordtoLatLng({"x": 9376.156807302901, "y": 9512.532537324769}),
      convertIngameCordtoLatLng({"x": 9366.535742702677, "y": 9663.004053973724}),
      convertIngameCordtoLatLng({"x": 9259.392042053683, "y": 9818.169422400242}),

      convertIngameCordtoLatLng({"x": 9325.27613408778, "y": 9912.668383834314}),
      convertIngameCordtoLatLng({"x": 9411.129769319865, "y": 9934.218040460608}),
      convertIngameCordtoLatLng({"x": 9521.365331233705, "y": 9976.212311677304}),

      convertIngameCordtoLatLng({"x": 9600.486808407366, "y": 9928.752545524945}),
      convertIngameCordtoLatLng({"x": 9748.30134635625, "y": 9724.041296130437}),
      convertIngameCordtoLatLng({"x": 9747.071581041293, "y": 9633.260903259421}),

      convertIngameCordtoLatLng({"x": 9614.125961110938, "y": 9442.54700425086}),
      convertIngameCordtoLatLng({"x": 9517.107963310491, "y": 9413.307357102454}),
  



      convertIngameCordtoLatLng({"x": 9376.156807302901, "y": 9422.424594215221})
    ]
    ]

  }
}, {
    "type": "Feature",
    "properties": {"area_type": "Lawless"},
    "geometry": {  
  "type": "Polygon",
  "coordinates": [

    [
      convertIngameCordtoLatLng({"x": 5538.927359015402, "y": 9418.878057954276}),
      convertIngameCordtoLatLng({"x": 5517.481781595481, "y": 9478.155819620499}),
      convertIngameCordtoLatLng({"x": 5395.906510738114, "y": 9556.878845675385}),
      convertIngameCordtoLatLng({"x": 5328.559058536552, "y": 9611.110263624305}),
      convertIngameCordtoLatLng({"x": 5301.445149208649, "y": 9687.209188810695}),
      convertIngameCordtoLatLng({"x": 5356.547610100836, "y": 9709.076696048163}),
      convertIngameCordtoLatLng({"x": 5483.370734376506, "y": 9716.948998653652}),
      convertIngameCordtoLatLng({"x": 5605.820647470257, "y": 9631.228370282777}),
      convertIngameCordtoLatLng({"x": 5604.946005233874, "y": 9429.172603408571}),
      convertIngameCordtoLatLng({"x": 5565.587104596597, "y": 9420.425600513583}),
      convertIngameCordtoLatLng({"x": 5538.927359015402, "y": 9418.878057954276})
    ]
    ]

  }
},


{
    "type": "Feature",
    "properties": {"area_type": "Outpost"},
    "geometry": {  
  "type": "Polygon",
  "coordinates": [
    [      
    [        5896, 24            ],
      [                5940,-12    ],
      [                 5808,-67     ],
      [                 5784,-3    ],
        [        5896, 24            ]
    ]
    ]}
}];

L.geoJSON(polygon_claim_lawless, {
  // style: myStyle,
    style: function(feature) 
    {
        switch (feature.properties.area_type)
         {
            case 'Claim': return {color: "#FFFFFF", "weight": 1, "opacity": 0.75};
            case 'Lawless': return {color: "#d80000", "weight": 4, "opacity": 0.75} ;
            case 'Outpost': return {color: "#24ce24", "weight": 2.5, "opacity": 0.75} ;
        }
    }
}).addTo(polygon_claims);




// WORKING AREA 
//TEST #1





 //this is to add custom icons

// replace Leaflet's default blue marker with a custom icon


// var iconlatlng =  [        5896, 24            ];




// function createCustomIcon_Map (feature, latlng) {
//   let myIcon = L.icon({
//     iconUrl: 'map_icons/outpost.TIF',
//     shadowUrl: 'map_icons/outpost.TIF',
//     iconSize:     [25, 25], // width and height of the image in pixels
//     shadowSize:   [35, 20], // width, height of optional shadow image
//     iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
//     shadowAnchor: [12, 6],  // anchor point of the shadow. should be offset
//     popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
//   })
//   return L.marker(iconlatlng, { icon: myIcon })
// }

// // create an options object that specifies which function will called on each feature
// let myLayerOptions = {
//   pointToLayer: createCustomIcon_Map
// }

// // create the GeoJSON layer
// L.geoJSON(myLayerData, myLayerOptions).addTo(map)




///TEST #2

// var myIcon = L.Icon.extend({
//     iconUrl: 'map_icons/outpost.TIF',
//         iconSize: [38, 95],
//         iconAnchor: [22, 94],
//         popupAnchor: [-3, -76]
    
//     });
  
//       L.geoJson(PPES, {
//     pointToLayer: function (feature, latLng) {
//           return new L.Marker(iconlatlng, {
//             icon: new myIcon({
//               iconUrl: 'map_icons/outpost.TIF'
//             })
//           })
//       }
//     }).addTo(map)


// WORKING AREA
// WORKING AREA

var myIcon = L.icon({
    iconUrl: 'map_icons/outpost.png',
    iconSize: [35, 35],
    iconAnchor: [10, 10],
    popupAnchor: [-3, -76]
    // shadowUrl: 'map_icons/outpost.png',
    // shadowSize: [68, 95],
    // shadowAnchor: [22, 94]
});
L.marker([0, 0], {icon: myIcon}).addTo(coolPlaces);




var myStringArray_node_resource = 
    [
    "resource_mining",
    "resource_lumberjacking",
    "resource_sickle",
    "resource_monster",
    "resource_hands",
    "resource_poi"
    ];



// selectValues = { "1": "test 1", "2": "test 2" };
    var myStringArray_resource_mining = 
    {
    "resource_crystal": "Crystal",
    "resource_lodestone": "Lodestone",
    "resource_iron_ore_vein": "Iron Ore Vein",
    "resource_seeping_stone": "Seeping Stone",
    "resource_silver_ore_vein": "Silver Ore Vein",
    "resource_gold_ore_vein": "Gold Ore Vein",
    "resource_starmetal_ore_vein": "Starmetal Ore Vein",
    "resource_orichalcum_ore_vein": "Orichalcum Ore Vein",
    "resource_platinum_vein": "Platinum Vein",
    "resource_earthcrag": "Earthcrag",
    "resource_scorchstone": "Scorchstone",
    "resource_shockspire": "Shockspire",
    "resource_springstone": "Springstone",
    "resource_lifejewel": "Lifejewel",
    "resource_blightcrag": "Blightcrag",
    "resource_soulspire": "Soulspire"
    };


  var myStringArray_resource_lumberjacking = 
   {
    "resource_wyrdwood": "Wyrdwood",
    "resource_ironwood": "Ironwood"
   };

  var myStringArray_resource_sickle = 
  {
    "resource_vegetables": "Vegetables",
    "resource_fruits": "Fruits",
    "resource_grains": "Grains",
    "resource_hemp": "Hemp",
    "resource_air_spirit": "Air Spirit",
    "resource_death_spirit": "Death Spirit",
    "resource_earth_spirit": "Earth Spirit",
    "resource_fire_spirit": "Fire Spirit",
    "resource_life_spirit": "Life Spirit",
    "resource_soul_spirit": "Soul Spirit",
    "resource_water_spirit": "Water Spirit",
    "resource_flame_azalea": "Flame Azalea",
    "resource_morning_glory": "Morning Glory",
    "resource_aster": "Aster",
    "resource_mushroom": "Mushroom",
    "resource_toadstool": "Toadstool",
    "resource_mandrake": "Mandrake",
    "resource_lotus": "Lotus",
    "resource_herbs": "Herbs",
    "resource_earthspine": "Earthspine",
    "resource_dragonglory": "Dragonglory",
    "resource_shockbulb": "Shockbulb",
    "resource_rivercress": "Rivercress",
    "resource_lifebloom": "Lifebloom",
    "resource_blightroot": "Blightroot",
    "resource_soulsprout": "Soulsprout"
  };

    var myStringArray_resource_poi = 
    {
"resource_fishing_village": "Fishing Village",
"resource_farm_village": "Farm Village",
"resource_village": "Village",
"resource_alchemy_house": "Alchemy House",
"resource_blacksmith_house": "Blacksmith House",
"resource_outfitting_house": "Outfitting House",
"resource_engineering_house": "Engineering House",
"resource_provisioning_house": "Provisioning House",
"resource_tanning_house": "Tanning House",
"resource_weaving_house": "Weaving House",
"resource_smelting_house": "Smelting House",
"resource_carpenty_house": "Carpenty House",
"resource_farm_mill": "Farm Mill",
"resource_campsite": "Campsite",
"resource_ancient_temple": "Ancient Temple",
"resource_ancient_ruins": "Ancient Ruins",
"resource_ancient_great_temple": "Ancient Great Temple",
"resource_ancient_tower": "Ancient Tower",
"resource_ancient_sphere": "Ancient Sphere",
"resource_ancient_shrine": "Ancient Shrine",
"resource_ancient_shipwreck": "Ancient Shipwreck",
"resource_ancient_buttress": "Ancient Buttress",
"resource_ancient_lighthouse": "Ancient Lighthouse",
"resource_corrupted_fort": "Corrupted Fort",
"resource_azoth_tree": "Azoth Tree",
"resource_mine": "Mine",
"resource_logging_camp": "Logging Camp",
"resource_cave": "Cave",
"resource_graveyard": "Graveyard"
};

    var myStringArray_resource_monster = 
{
"resource_withered": "Withered",
"resource_pig": "Pig",
"resource_damned": "Damned",
"resource_damned": "Damned",
"resource_damned": "Damned",
"resource_damned": "Damned",
"resource_forest_elemental": "Forest Elemental",
"resource_tundra_elemental": "Tundra Elemental",
"resource_bison": "Bison",
"resource_wolf_timber": "Wolf Timber",
"resource_bear_black": "Bear Black",
"resource_boar": "Boar",
"resource_turkey": "Turkey",
"resource_elk_bull": "Elk Bull",
"resource_elk_cow": "Elk Cow",
"resource_wolf_white": "Wolf White",
"resource_wolf_grey": "Wolf Grey",
"resource_wolf_ice_guardian": "Wolf Ice Guardian",
"resource_bear_corrupted": "Bear Corrupted",
"resource_wolf_corrupted": "Wolf Corrupted",
"resource_corrupted_huntsmen": "Corrupted Huntsmen",
"resource_corrupted_pistoleer": "Corrupted Pistoleer",
"resource_corrupted_champion": "Corrupted Champion",
"resource_corrupted_summoner": "Corrupted Summoner",
"resource_corrupted_laborer": "Corrupted Laborer",
"resource_corrupted_farmhand": "Corrupted Farmhand",
"resource_wraight_drown": "Wraight Drown",
"resource_wraight_burning": "Wraight Burning",
"resource_wraight_plague": "Wraight Plague",
"resource_wraight": "Wraight",
"resource_ancient_keeper": "Ancient Keeper",
"resource_ancient_reaver": "Ancient Reaver",
"resource_ancient_guardian": "Ancient Guardian",
"resource_drowned_sailor": "Drowned Sailor"
};

    var myStringArray_resource_hands = 
    {
"resource_berry_bush": "Berry Bush",
"resource_turkey_nest": "Turkey Nest",
"resource_saltpeter": "Saltpeter",
"resource_honey": "Honey",
"resource_nuts": "Nuts",
"resource_earthshell_turtle": "Earthshell Turtle",
"resource_salamander_snail": "Salamander Snail",
"resource_lightning_beetle": "Lightning Beetle",
"resource_floating_spinefish": "Floating Spinefish",
"resource_lifemoth": "Lifemoth",
"resource_blightmoth": "Blightmoth",
"resource_soulwyrm": "Soulwyrm",
"resource_ironchest": "IronChest",
"resource_lootbasket": "LootBasket",
"resource_container": "Container",
"resource_ancient_chest": "Ancient Chest",
"resource_farming_supplies": "Farming Supplies",
"resource_blacksmith_supplies": "Blacksmith Supplies",
"resource_alchemy_supplies": "Alchemy Supplies",
"resource_outfitting_supplies": "Outfitting Supplies",
"resource_engineering_supplies": "Engineering Supplies",
"resource_provisioning_supplies": "Provisioning Supplies",
"resource_tanning_supplies": "Tanning Supplies",
"resource_weaving_supplies": "Weaving Supplies",
"resource_smelting_supplies": "Smelting Supplies",
"resource_carpentry_supplies": "Carpentry Supplies",
"resource_abandoned_supplies": "Abandoned Supplies",
    };

var globalsubmitcordsx = 0;
var globalsubmitcordsy = 0;
var globalsubmitcordslat = 0;
var globalsubmitcordslng = 0;
//This opens a pop up on right click and has a submission form for the area they clicked
var submit_Loc_popup = L.popup();
map.on('contextmenu', onPopupBoxSubmit);
    var featureGroup = L.featureGroup().addTo(map);
function onPopupBoxSubmit(eb) {

         var xy = map.project([eb.latlng.lat,eb.latlng.lng],6); 
         console.log(xy);
       var coords3 = convertToInGameCords(xy);

      globalsubmitcordsx = coords3.x;
      globalsubmitcordsy = coords3.y;
      globalsubmitcordslat = eb.latlng.lat;
      globalsubmitcordslng = eb.latlng.lng;
          console.log(coords3);
          var popupContent = 
           '<form id="node_submission_form2" onsubmit="return false;"> <!-- onsubmit="return false;" -- this will make the page to not reload -->'+
    '<div class="node_submission_form_group" id="types">'+
      '<select class="form-control" id="node_resource">'+
        '<option selected disabled value="disabled">Select Harvesting Type</option>'+
      '</select> '+
    '</div>'+
   ' <div class="container_node_resource">'+
     ' <div class="resource_mining">'+
         'Harvesting Node Type for resource_mining'+
         '<br>'+
         '<select id="resource_mining">'+
          
        '</select>'+
     ' </div>'+
     ' <div class="resource_lumberjacking">'+
       ' Harvesting Node Type for resource_lumberjacking'+
        '<br>   '   +
        '<select id="resource_lumberjacking">'+
       ' </select>'+
     ' </div>'+
     ' <div class="resource_sickle">'+
       ' Harvesting Node Type for resource_sickle'+
        '<br>'+
       ' <select id="resource_sickle">'+
         '</select>'+
     ' </div>'+
      '<div class="resource_monster">'+
       ' Harvesting Node Type for resource_monster'+
       ' <br>'+
          '<select id="resource_monster">'+
        '</select>'+
     ' </div>'+
    '  <div class="resource_hands">'+
       ' Harvesting Node Type for resource_hands'+
      '  <br>'+
        '<select id="resource_hands">'+
        '</select>'+
     ' </div>'+
   '   <div class="resource_poi">'+
      '  Harvesting Node Type for resource_poi'+
       ' <br>'+
        '  <select id="resource_poi">'+
       ' </select>  '+
       '    </div>  '+
       '  </div>'+
    '<button type="submit" class="btn btn-primary" value="submit" name="process-node-submit">Submit to map!</button>'+
  '</form>'
  ;
 
         submit_Loc_popup
            .setLatLng(eb.latlng)
            // .setContent(popupContent + eb.latlng.toString())
            //need to reverse order if i wnat to use my function
            .setContent(popupContent + '"x": ' +coords3.y+', "y": '+coords3.x)
            //.setContent(popupContent + '"x": ' +coords3.x+', "y": '+coords3.y)
            .openOn(map);
      
   
      };






map.on('popupopen', function(e) {


  document.querySelector("#node_submission_form2").addEventListener("submit", function(e) {
    //alert("HERE");

    if (!doValidation()) {
      // alert("HERE");
      e.preventDefault(); //stop form from submitting

    }
  });



 var select = document.getElementById("node_resource");
  // alert("select = " + select);
  var options = myStringArray_node_resource;
  // alert("options = " + options);
  for(var i = 0; i < options.length; i++) {
      var opt = options[i];
     // alert("opt = " + opt);
      var el = document.createElement("option");
      el.textContent = opt;
      // alert("el.textContent = " + el.textContent);
      el.value = opt;
      select.appendChild(el);

   // var subarr = "myStringArray_" + options[i];
    // alert("noeval subarr = " + subarr);
      var subarr = eval("myStringArray_" + opt);

      // alert("subarr = " + subarr);
  $.each(subarr, function(key, value) {
    $('#' + opt)
    .append($('<option>', { value : key })
    .text(value));
    }); 
  }


  $('#node_resource').bind('change',
    function() {
      var elements = $('div.container_node_resource').children().hide(); // hide all the elements
      var value = $(this).val();

      if (value.length) { // if somethings' selected

        elements.filter('.' + value).show(); // show the ones we want

      }
    }).trigger('change');  


 });



function doValidation() //Make sure they selected a Harvesting type, and return the one theey selected
  {

    var selectDocID = document.getElementById("node_resource");
    var selectedValueinDropdown = selectDocID.options[selectDocID.selectedIndex].value;
      var arrayLength = myStringArray_node_resource.length;
    if (selectedValueinDropdown == "disabled")
    {
      alert("Please Select Harvesting Type!");
      exit();
    }
    else
    {
        for (var i = 0; i < arrayLength; i++) 
        { 
          if (selectedValueinDropdown == myStringArray_node_resource[i])
          { 
            // alert("myStringArray_node_resource[i] = " + myStringArray_node_resource[i]);
            var selectDocID2 = document.getElementById(myStringArray_node_resource[i]);

              var selectedValueinSubDropdown = selectDocID2.options[selectDocID2.selectedIndex].value;
              // alert("selectedValueinSubDropdown = " + selectedValueinSubDropdown);

              // alert("globalsubmitcordsx = " + globalsubmitcordsx);
              // alert("globalsubmitcordsy = " + globalsubmitcordsy);

              // alert("globalsubmitcordslat = " + globalsubmitcordslat);
              // alert("globalsubmitcordslng = " + globalsubmitcordslng);





//AJAX CALL

              $.ajax({
                        type: "POST",
                        url: "1DBCallsMap/process_submit_node.php",
                        data: 
                            {
                            node_resource_type: selectedValueinDropdown,
                            node_resource_name: selectedValueinSubDropdown,
                            node_position_ingame_x: globalsubmitcordsx,
                            node_position_ingame_y: globalsubmitcordsy,
                            node_position_lat: globalsubmitcordslat,
                            node_position_lng: globalsubmitcordslng

                            },
                        success: function (data) {
                          console.log('Submission was successful.');
                          console.log(data);
                        },
                        error: function (data) {
                          console.log('An error occurred subbmitting node data.');
                          console.log(data);
                        },
                       });









//maybe ignore thjis
              // if (window.XMLHttpRequest) {
              //     // code for IE7+, Firefox, Chrome, Opera, Safari
              //     xmlhttp = new XMLHttpRequest();
              // } else {
              //     // code for IE6, IE5
              //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              // }
              // xmlhttp.onreadystatechange = function() {
              //     if (this.readyState == 4 && this.status == 200) {
              //         document.getElementById("txtHint").innerHTML = this.responseText;
              //     }
              // };
              // xmlhttp.open("GET","1DBCallsMap/process_submit_node.php?node_resource_type="+selectedValueinDropdown+"node_resource_name="+selectedValueinSubDropdown+"node_position_ingame_x="+globalsubmitcordsx+"node_position_ingame_y="+globalsubmitcordsy+"node_position_lat="+globalsubmitcordslat+"node_position_lng="+globalsubmitcordslng,true);
              // xmlhttp.send();
             
              // //valeus that need to be passed in selectedValueinDropdown, selectedValueinSubDropdown, node_position_ingame_x, node_position_ingame_y, node_position_lat, node_position_lng, forum_name, alpha_access_nda, login_row_id);


            }
        }
    }
 }





// WORKING AREA //javascript for hiding or showing the changed lines



//WORKING
// //Returns the X/Y cords from the map on click


map.on('click', function(e) {
  doStuff(e);
});


function doStuff(e) {
  console.log("e.latlng: " + e.latlng);
  console.log("e.latlng.lat: " + e.latlng.lat + ", & e.latlng.lng: " + e.latlng.lng);


  // coordinates in tile space
  var x = e.layerPoint.x;
  var y = e.layerPoint.y;
  console.log("e.layerpoint.x: & e.layerpoint.y: " + [x, y]);
  console.log("e.layerpoint.x:" + x);
  console.log("e.layerpoint.y:" + y);


  // // calculate point in xy space
  // var pointXY = L.point(x, y);
  // var pointYX = L.point(y, x);

  // console.log("Point in x,y space: " + pointXY);
  //   console.log("Point in Y X space: " + pointYX);

  // // convert to lat/lng space
  // var pointlatlng = map.layerPointToLatLng(pointXY);
  // // why doesn't this match e.latlng?
  // console.log("Point in layerPointToLatLng lat,lng space: " + pointlatlng);

  // var pointlatlngYX = map.layerPointToLatLng(pointYX);
  // // why doesn't this match e.latlng?
  // console.log(" Y X: " + pointlatlngYX);


  // var containpointlatlng = map.containerPointToLatLng(pointXY);
  // // why doesn't this match e.latlng?
  // console.log("Point in containerPointToLatLng lat,lng space: " + containpointlatlng);

  // var layerpointpointlatlng = map.layerPointToContainerPoint(pointXY);
  // // why doesn't this match e.latlng?
  // console.log("Point in layerPointToContainerPoint lat,lng space: " + layerpointpointlatlng);


////This will collect the pixels location whe nclicking the map

 var xy = this.map.project([e.latlng.lat,e.latlng.lng],6); //(we need to change the zoom level 6-7 depending on the map's max zoom
      console.log("this is the pixel count location on the map: " + xy);

      //This returns the in-game value...
// var  xy2 = [xy.x/xOffset,(height-xy.y)/yOffset];

//  console.log("this is the maps pixel' location: " + xy2);


var xy3 = convertToInGameCords(xy);

console.log("this is after converting the cords using the offset, now the ingame cords are x,y: (" + xy3.x + "," + xy3.y + ")");

//adds a marker at the click location
// var marker2 = L.marker([e.latlng.lat,e.latlng.lng]).addTo(map);

}

  
function convertToInGameCords(latlngcoords) {
//THis will take a lat_lng cord and turn it into an in game coordinate
// console.log("inside convertToInGameCords x,y " + latlngcoords );
  var translateFactors = 
    {
      "x": (latlngcoords.x / xOffset),
      "y":  ((height-latlngcoords.y) / yOffset)
    };

  return translateFactors;
}

function convertIngameCordtoLatLng(ingamecoords) {
//notes
//1st we need to take the cords, 
//2nd  we multiple by the offset
//3rd we convert to latlang
//have cords, split them, do math, make point, unproject, return latlng reverse and add to marker waypoint
//This will take an in-game coordinate and turn it into a lat_lng for the map to use



  console.log("inside convertIngameCordtoLatLng just starting x,y "  + ingamecoords.x + " a: " + ingamecoords.y  );
  var translateFactors = 
    {
      "x": (ingamecoords.x * xOffset),
      "y":  (ingamecoords.y * yOffset) + height
    };
  console.log("inside convertIngameCordtoLatLng AFTER x,y offset math " + translateFactors.x + " a: " + translateFactors.y );

  var pointXY = L.point(translateFactors.x, translateFactors.y);
  console.log("inside convertIngameCordtoLatLng AFTER pointXY " + pointXY.x);

  var xy4 = map.unproject(pointXY,6);  //change depending on map zoom level
  console.log("UNPROJECT xy4 " + xy4);

  //reverse the order
  var xy5 = [(-1*xy4.lat), xy4.lng];  //working
  // var xy5 = [xy4.lng, (-1*xy4.lng)];
   // var xy5 = [xy4.lat, xy4.lng];


  console.log("reverse the order xy5 " + xy5);
  
  return xy5;
}




var Layer_Lawless_areas = new L.LayerGroup();
var Lawless_areasFeature = [{
      "type": "Feature",
       "properties": 
      {
        "id": "lawless",
        "name": "Lawless Zone (Bright Wood)",
        "style": {
                 "clickable": false,
                 "color": "#d80000",
                 "dashArray": "7",
                 "interactive": false,
                 "opacity": 0.8,
                 "weight": 4
                 }
      },
      "geometry": {
        "type": "Polygon",
        "coordinates": [[
                   {"x": 5538.927359015402, "y": 9418.878057954276},
                   {"x": 5517.481781595481, "y": 9478.155819620499},
                   {"x": 5395.906510738114, "y": 9556.878845675385},
                   {"x": 5328.559058536552, "y": 9611.110263624305},
                   {"x": 5301.445149208649, "y": 9687.209188810695},
                   {"x": 5356.547610100836, "y": 9709.076696048163},
                   {"x": 5483.370734376506, "y": 9716.948998653652},
                   {"x": 5605.820647470257, "y": 9631.228370282777},
                   {"x": 5604.946005233874, "y": 9429.172603408571},
                   {"x": 5565.587104596597, "y": 9420.425600513583},
                   {"x": 5538.927359015402, "y": 9418.878057954276}
                  ]]
      }
     
    },{
                   "type": "Feature",
       "properties": 
      {
        "id": "lawless",
        "name": "Lawless Zone (Bright Wood)",
        "style": {
                 "clickable": false,
                 "color": "#d80000",
                 "dashArray": "7",
                 "interactive": false,
                 "opacity": 0.8,
                 "weight": 4
                 }
      },
      "geometry": {
        "type": "Polygon",
        "coordinates": [[
                   {"x": 9376.156807302901, "y": 9422.424594215221},
                        {"x": 9376.156807302901, "y": 9512.532537324769},
                        {"x": 9366.535742702677, "y": 9663.004053973724},
                        {"x": 9259.392042053683, "y": 9818.169422400242},
                        {"x": 9325.27613408778, "y": 9912.668383834314},
                        {"x": 9411.129769319865, "y": 9934.218040460608},
                        {"x": 9521.365331233705, "y": 9976.212311677304},
                        {"x": 9600.486808407366, "y": 9928.752545524945},
                        {"x": 9748.30134635625, "y": 9724.041296130437},
                        {"x": 9747.071581041293, "y": 9633.260903259421},
                        {"x": 9614.125961110938, "y": 9442.54700425086},
                        {"x": 9517.107963310491, "y": 9413.307357102454},
                        {"x": 9376.156807302901, "y": 9422.424594215221}
                  ]]
      }
     
    } ]   ;






L.geoJSON(Lawless_areasFeature, {
    coordsToLatLng: function (coords) {
    return convertIngameCordtoLatLngGeoJsonObject2(coords);
    },
    style:function (feature) {
    return {style: feature.properties.style}}
}).addTo(Layer_Lawless_areas);



function convertIngameCordtoLatLngGeoJsonObject2(ingamecoords) {
//This is called for each function in the array


  console.log("convertIngameCordtoLatLngGeoJsonObject # of objects"  + ingamecoords);
  console.log("inside convertIngameCordtoLatLngGeoJsonObject just starting x,y "   + ingamecoords.x + " a: " + ingamecoords.y  );

    var translateFactors = 
    {
      "x": (ingamecoords.x * xOffset) + width,
      "y":  (ingamecoords.y * yOffset)
    };
  console.log("inside convertIngameCordtoLatLngGeoJsonObject AFTER x,y offset math " + translateFactors.x + " a: " + translateFactors.y );

  var pointXY = L.point(translateFactors.y, translateFactors.x);
  console.log("inside convertIngameCordtoLatLngGeoJsonObject AFTER pointXY " + pointXY.x);

  var xy4 = map.unproject(pointXY,6);  //change depending on map zoom level
  console.log("UNPROJECT xy4 " + xy4);

  //reverse the order
  var xy5 = [(-1*xy4.lat), xy4.lng];  //workingclosests
 

  console.log("reverse the order xy5 " + xy5);
  
  return xy5;
}


//  var xy8 = this.map.project([xy4.lat,xy4.lng],6); //(we need to change the zoom level 6-7 depending on the map's max zoom
//       console.log("now lets convert the unproject into project " + xy4);

// var xy9 = convertToInGameCords(xy8);

// console.log("now we convert that into the cords and add a marker x: " + xy9.x + " & testing cordconversiony : " + xy9.y);


//  var xy14 = convertToInLatLangCords(L.point([6817.0673828125,207.3566131591797]));



//  console.log("inside convertToInLatLangCords AFTER xy14 " + xy14[0]);
//  console.log("testing cordconversion x: " + xy14.x + " & testing cordconversiony : " + xy14.y);



// let point = L.point(6817.0673828125,207.3566131591797); // x=0,y=0
//  console.log("point =  " + point);
// // // This needs to be lat: -6.483323023371554, lng: -243.79630050123433

// let latlng = map.layerPointToLatLng(point);

//  console.log("latlng =  " + latlng);

          // var xy5 = convertToInGameCords(xy4);
        //   var xy3 = convertToInLatLangCords(6817.0673828125,207.3566131591797);

        // // var marker3 = L.marker([xy3]).addTo(map);
        // // marker3.bindPopup('25m Claim!').openPopup();


        // //adds it but in the wrong position        
        // // var marker3 = L.marker([6817.0673828125,207.3566131591797]).addTo(map);
        // // marker3.bindPopup('25m Claim!').openPopup();


        // var marker3 = L.marker([xy3.x, xy3.y]).addTo(map);
        // marker3.bindPopup('25m Claim!').openPopup();

 


        // var marker = L.marker([-343.691389, -349.123591]).addTo(map);
        // marker.bindPopup('ABERTON!').openPopup();

    var baseLayers = {
      "New World": osmMap
    };
    ///I need to play around with hiding the context of leaflet-control-layers-base text in CSS
    //$('.leaflet-control-layers').hide();  or leaflet-control-layers-base (is the base layer texti want to hide)

    var overlays = {
      "Interesting places": coolPlaces,
      "Claims": polygon_claims,
      "Testing Map Contents": testing_map_contents,
      "Lawless Areas": Layer_Lawless_areas
    };

    L.control.layers(baseLayers,overlays).addTo(map);




        var sidebar = L.control.sidebar('sidebar').addTo(map);
    </script>
</body>
</html>
