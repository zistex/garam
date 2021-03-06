<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

   <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>



   <link rel="stylesheet" href="assets/js/MarkerCluster.css"/>
   <script src="assets/js/leaflet.markercluster-src.js"></script>

   <style>
       #mapid { height: 80vh; }

       .ladang {
                    font-size:14pt;
                    color:#2c7af7;
                    text-shadow: 1px 1px #ffffff;
                    text-align: center;
           }

           .legend {
            width:180px;
            position: absolute;
            right: 10px;
            bottom: 40px;
            background-color: white;
            padding:10px;
            z-index: 99999;
            box-shadow:0 0 7px #999;
            background: #fff;
            border-radius: 2px;
          }

    </style>

</head>
<body>
  <div style="margin-top:100px;">
  <select onchange="pilih(this)">
    <option value="1">ladang Garam 1<option>
    <option  value="2">Bangunan<option>
          </select>   

</div>
  
<div>
<input  onclick="aktif_ladang(this)"  type="checkbox" >Ladang Garam</input>
<input onclick="aktif_bangunan(this)" type="checkbox"  >Bangunan</input>
</div>




     <div id="mapid"></div>
</body>
<script>
  var lyr_marker = L.markerClusterGroup();
  var lyr_bangunan = L.markerClusterGroup();
  var lyr_ladang = L.markerClusterGroup();

    var geoLayer;
    var geoLayerMarker;
    var map = L.map('mapid').setView([-7.2759291,112.7464332], 15);

    // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
	// 	maxZoom: 18,
	// 	attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
	// 		'Imagery ?? <a href="https://www.mapbox.com/">Mapbox</a>',
	// 	id: 'mapbox/streets-v11',
	// 	tileSize: 512,
	// 	zoomOffset: -1
	// }).addTo(map);


    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}',
    //  {
    //      foo: 'bar', 
    //      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}
    //     ).addTo(map);


    // Hybrid: s,h;
    // Satellite: s;
    // Streets: m;
    // Terrain: p;

    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);

    //SIMPLE MARKER
    //L.marker([-7.2759291,112.7464332]).addTo(map);


    //CUSTOM MARKER
    var hotelIcon = L.icon({
        iconUrl: 'assets/icons/hotel.png',
        iconSize:     [24, 28] //w x h
    });

    var marker = L.marker([-7.2759291,112.7464332], {icon: hotelIcon}).addTo(map);
    
    //POPUP
    marker.bindPopup('<p>Hello world!<br />This is a nice popup.</p>').openPopup();

    // var popup = L.popup()
    //     .setLatLng(latlng)
    //     .setContent('<p>Hello world!<br />This is a nice popup.</p>')
    //     .openOn(map);


    //POLYLINE
    var latlngs = [
        [
            
            -7.264522037937439,
            112.78070926666258,
          ],
          [
            
            -7.264309183587834,
            112.77663230895996,
          ],
          [
            
            -7.263755761807139,
            112.77268409729004,
          ],
          [
            
            -7.2632449103278995,
            112.76847839355469,
          ],
          [
            
            -7.262989484370584,
            112.76431560516357,
          ],
          [
            
            -7.261882636878651,
            112.76216983795166,
          ],
          [
            
            -7.261286640946718,
            112.76058197021484,
          ],
          [
            
            -7.260179789263145,
            112.75933742523192,
          ]
        ];

        var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);

        // zoom the map to the polyline
        map.fitBounds(polyline.getBounds());



        //POLYGON
                $.getJSON('assets/json/ladang.json', function(json) {
                    geoLayer = L.geoJson(json, {

                        style: function(feature) { 


                          if (feature.properties.kategori ==1){

                            return {
                                        weight: 2,
                                        opacity: 1,
                                        color:'#eb4034',
                                        fillColor:'yellow',
                                        };
                          }else{
                            return {
                                        weight: 2,
                                        opacity: 1,
                                        color:'#eb4034',
                                        fillColor:'#0990b5',
                                        };
                          }
                            
                        },

                        onEachFeature: function(feature, layer) {
                           
                          //alert(feature.properties.kategori);
                         
                          if (feature.properties.kategori == 1){
                            lyr_ladang.addLayer(layer);
                          }else{
                            lyr_bangunan.addLayer(layer);
                          }


                         

                                  var iconLabel = L.divIcon({
                                    className: 'ladang',
                                    html: '<b>'+feature.properties.nama+'</b>',
                                    iconSize: [100, 20]
                                  });
                            
                                        var geoLayerMarker = L.marker(layer.getBounds().getCenter(),{icon:iconLabel}).addTo(map);
                                        lyr_marker.addLayer(geoLayerMarker);

                                        layer.on('click',(e)=>{
                                            $.getJSON('json?id='+feature.properties.id, function(s) {
                                                $.each(s, function(j) {
                                                    var foto = 'no_image.jpg';
                                                    if (s[j].gambar !=''){
                                                        foto=s[j].gambar;
                                                    }
                                                    
                                                    var html='<div class="center"><a href="detail?id='+s[j].id+'&v=ladang"><img width="200px" height="200px" src="assets/uploads/'+foto+'"></a>';
                                                    html+='<a href="detail?id='+s[j].id+'&v=ladang"><h6 class="mt-2">'+s[j].nama+'<h6></a>';
                                                    html+='<hr>';
                                                    html+='<p class="address">Alamat : '+s[j].alamat+'</p></div>';

                                                    L.popup()
                                                                //.setLatLng(layer.getBounds().getCenter())
                                                                .setLatLng(e.latlng)
                                                                .setContent(html)
                                                                .openOn(map);
                                                                
                                                                
                                                })
                                            });

                                        });

                                        //layer.addTo(map); 
                                    }
                                });
                            })







      function pilih(v){
       

        geoLayer.eachLayer(function(layer) {
   
          if(layer.feature.properties.id==v.value){
            map.flyTo(layer.getBounds().getCenter(), 16);
            //layer.bindPopup(layer.feature.properties.nama);
          }
          
        });

      }


      //LEGENDA
      var legend = L.control({position: 'bottomright'});
      legend.onAdd = function (map) {
    
          var div = L.DomUtil.create('div', 'legend');


          labels = ['<strong>Keterangan :</strong>'],

          categories = ['Ladang Garam','Gedung'];

          for (var i = 0; i < categories.length; i++) {
                  
                  if (i==0){
                      div.innerHTML += 
                                  labels.push(
                                      '<img width="20" height="23" src="assets/icons/hotel.png"><i class="circle" style="background:#000000"></i> ' +
                                  (categories[i] ? categories[i] : '+'));
                  
                  }
                  else if (i==1){
                      div.innerHTML += 
                                  labels.push(
                                      '<img width="20" height="23" src="assets/icons/icon2.png"><i class="circle" style="background:#000000"></i> ' +
                                  (categories[i] ? categories[i] : '+'));
                  
                  }
                

              }
              div.innerHTML = labels.join('<br>');
          return div;
          };
          
      legend.addTo(map);



      //LAYER GROUP
     
      function aktif_ladang(v){
        if (v.checked){    
          map.addLayer(lyr_ladang);
        }else{    
          map.removeLayer(lyr_ladang);
        }
      }

      function aktif_bangunan(v){
        if (v.checked){    
          map.addLayer(lyr_bangunan);
        }else{    
          map.removeLayer(lyr_bangunan);
        }
      }





















      map.on('zoomend', function() {
        
      if (map.getZoom()>12){
        
        //map.addLayer(lyr_bangunan);
        //map.removeLayer(lyr_marker);

         
      }else{
        //map.addLayer(lyr_marker);
        //map.removeLayer(lyr_bangunan);
      }
      
    });

</script>
</html>
