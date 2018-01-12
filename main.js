var mymap = L.map('mapid').setView([64, 100], 2);

		        L.tileLayer('http://tiles.maps.sputnik.ru/tiles/kmt2/{z}/{x}/{y}.png', {
			    maxZoom: 10
		        }).addTo(mymap);




                
                

            
            var arr = [];		
                popups = L.geoJSON(dronestrikes, {
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup("<p>IAGA код: " + feature.properties.code  + "</br>Название обсерватории: " + feature.properties.RusName +  "</br>Открыта: " + feature.properties.open1 + "</br>Широта: " + feature.properties.GeogLat + "</br>Долгота: " + feature.properties.GeogLon + "</br>Альтитуда: " + feature.properties.alt  + "</br>Страна: " + feature.properties.country +"</br>Институт: " + feature.properties.inst + "</br>Интермагнет: " + feature.properties.intmag + "</p>");
                        arr.push(feature.properties.code);
                        layer.on('click', function(e) {
                            var sel = document.getElementById('obsnametab');
                            var code = feature.properties.code;
                            var index
                            for (i=0; i <= sel.options.length; i++) {
                                if (sel.options[i].value == code) {
                                    index = i;
                                    break;
                                }
                            }
                            sel.selectedIndex = index;
                            mymap.setView([feature.properties.GeogLat+1, feature.properties.GeogLon], 6);
                        });
                    }, 
                    pointToLayer: function(feature, latlng) {
    	
                    return L.marker(latlng, {draggable: false,        // Make the icon dragable
                            title: feature.properties.code,     // Add a title
                            opacity: 0.9} );
                    /*return new L.CircleMarker(latlng, {radius: 10, fillOpacity: 0.85,title: feature.properties.code});*/
                    
                    },
                    style: function(feature) {
                    return {};
                    }
	
            }).addTo(mymap);

            var popup = L.popup();
            function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("You clicked the map at " + e.latlng.toString())
				.openOn(mymap);
		    }
            mymap.on('click', onMapClick);
            

            function onSelectChange() {
                var select = document.getElementById('obsnametab');
                var selIndex = select.selectedIndex;
                for (var i=0; i<arr.length; i++) {
                    if (select.options[selIndex].value == arr[i]) {
                        L.geoJSON(dronestrikes, {
                            onEachFeature: function(feature, layer) {
                                var code = feature.properties.code;
                                if (arr[i] == code) {
                                    mymap.setView([feature.properties.GeogLat, feature.properties.GeogLon], 6);
                                }
                            }
                        })
                    }
                }
            }