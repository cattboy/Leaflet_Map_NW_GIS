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


  <script src="leaflet/leaflet.js"></script>
    <script src="js/leaflet-sidebar.js"></script>
      <script src="ZoomLabel/L.Control.ZoomLabel.js"></script>
      
      <!-- //NEED TO REPLACE WITH LOCALLY HOSTED FILES -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
    }).setView([-500, -600], 0);


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
    // [
    //   [-12,5967      ],
    //   [        -87,        5830      ],
    //   [        -181,        5953      ],
    //   [        -106,        6105      ],
    //   [        -12,        5967      ]
    // ]


    [
      [5967, -12      ],
      [              5830,-87      ],
      [        5953,-181              ],
      [               6105,-106      ],
      [        5967, -12              ]
    ]


    ]}
}, {
    "type": "Feature",
    "properties": {"area_type": "Lawless"},
    "geometry": {  
  "type": "Polygon",
  "coordinates": [
    [      
    [         5950, 40             ],
      [               6000,  60     ],
      [                6100,55      ],
      [                5950,40     ]
    ]
    ]}
}, {
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
    var baseLayers = {
      "New World": osmMap
    };
    ///I need to play around with hiding the context of leaflet-control-layers-base text in CSS
    //$('.leaflet-control-layers').hide();  or leaflet-control-layers-base (is the base layer texti want to hide)

    var overlays = {
      "Interesting places": coolPlaces,
      "Claims": polygon_claims,
      "Testing Map Contents": testing_map_contents,
    };

    L.control.layers(baseLayers,overlays).addTo(map);

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


// WORKING AREA
// WORKING AREA  //this is where we will click the map, and give users a chance to submit there details of the item they select

//WORKS
//This opens a pop up on left click that shows the area they clicked
//WORKS BUT IS IN WRONG FORMAT

// var popup = L.popup();

// function onMapClick(e) {
//     popup
//         .setLatLng(e.latlng)
//         .setContent("You clicked the map at " + e.latlng.toString())
//         .openOn(map);
// }

// map.on('click', onMapClick);
//WORKS



//This opens a pop up on right click and has a submission form for the area they clicked

map.on('contextmenu', onPopupBoxSubmit);

    var featureGroup = L.featureGroup().addTo(map);

function onPopupBoxSubmit(eb) {

         var xy = map.project([eb.latlng.lat,eb.latlng.lng],6); 
         console.log(xy);
       var coords3 = convertToInGameCords(xy);
          console.log(coords3);
          var popupContent = '<form role="form" id="form" enctype="multipart/form-data" class = "form-horizontal" onsubmit="addMarker()">'+
          // '<div class="form-group">'+
          //     '<label class="control-label col-sm-5"><strong>Date: </strong></label>'+
          //     '<input type="date" placeholder="Required" id="date" name="date" class="form-control"/>'+ 
          // '</div>'+
          '<div class="form-group">'+
              // '<label class="control-label col-sm-5"><strong>Harvesting Tool Type: </strong></label>'+
              '<select class="form-control" id="node_resource" name="node_resource">'+

                '<option selected disabled>Select Harvesting Tool</option>'+
                '<option value="mining_pick">Mining Pick</option>'+
                '<option value="lumberjacking_axe">Lumberjacking Axe</option>'+
                '<option value="sickle_">Sickle</option>'+
                '<option value="skinning_knife">Skinning Knife</option>'+
              '</select>'+ 
          '</div>'+

          '<div class="form-group">'+
              // '<label class="control-label col-sm-5"><strong>Node Name: </strong></label>'+
              '<select class="form-control" id="node_resource_name" name="node_resource_name">'+
                '<option selected disabled>Harvesting Nodes Name</option>'+
                '<option value="Wyrdwood">Wyrdwood</option>'+
                '<option value="Ironwood">Ironwood</option>'+
                '<option value="Hemp">Hemp</option>'+
                '<option value="Skinning Knife">Skinning Knife</option>'+
              '</select>'+ 
          '</div>'+


          //Counter Box
          // '<div class="form-group">'+
          //     '<label class="control-label col-sm-5"><strong>SubGroup: </strong></label>'+
          //     '<input type="number" min="0" class="form-control" id="age" name="age">'+ 
          // '</div>'+

          //description box
          // '<div class="form-group">'+
          //     '<label class="control-label col-sm-5"><strong>Description: </strong></label>'+
          //     '<textarea class="form-control" rows="6" id="descrip" name="descript">...</textarea>'+
          // '</div>'+

          //not sure what this does???
          // '<input style="display: none;" type="text" id="lat" name="lat" value="'+coords3.x+'" />'+
          // '<input style="display: none;" type="text" id="lng" name="lng" value="'+coords3.y+'" />'+
          '<div class="form-group">'+
            '<div style="text-align:center;" class="col-xs-4 col-xs-offset-2"><button type="button" class="btn">Cancel</button></div>'+
            '<div style="text-align:center;" class="col-xs-4"><button type="submit" value="submit" class="btn btn-primary trigger-submit">Submit</button></div>'+
          '</div>'+






          '</form>';

         popup
            .setLatLng(eb.latlng)
            // .setContent(popupContent + eb.latlng.toString())
            .setContent(popupContent + "X: "+coords3.x+" Y: "+coords3.y)
            .openOn(map);
      };





// WORKING AREA //javascript for hiding or showing the changed lines



//WORKING
// //Returns the X/Y cords from the map on click


map.on('click', function(e) {
  doStuff(e);
});


function doStuff(e) {
  console.log("e.latlng: " + e.latlng);
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



  console.log("inside convertIngameCordtoLatLng just starting x,y " +  + ingamecoords.x + " a: " + ingamecoords.y  );
  var translateFactors = 
    {
      "x": (ingamecoords.x * xOffset),
      "y":  (ingamecoords.y * yOffset) + (height-59)
    };
  console.log("inside convertIngameCordtoLatLng AFTER x,y offset math " + translateFactors.x + " a: " + translateFactors.y );

  var pointXY = L.point(translateFactors.x, translateFactors.y);
  console.log("inside convertIngameCordtoLatLng AFTER pointXY " + pointXY.x);

  var xy4 = map.unproject(pointXY,6);  //change depending on map zoom level
  console.log("UNPROJECT xy4 " + xy4);

  //reverse the order
  var xy5 = [(-1*xy4.lat), xy4.lng];
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

 


        var marker = L.marker([0, 0]).addTo(map);
        marker.bindPopup('ABERTON!').openPopup();
        var sidebar = L.control.sidebar('sidebar').addTo(map);
    </script>
</body>
</html>`
