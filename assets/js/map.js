
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8
        });

        var marker = new google.maps.Marker({
            position: { lat: -34.397, lng: 150.644 },
            map: map,
            draggable: true
        });

        // Add a search box to the map
        var input = document.getElementById('location');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            marker.setMap(null);

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                // Create a new marker for the selected place.
                marker = new google.maps.Marker({
                    map: map,
                    title: place.name,
                    position: place.geometry.location,
                    draggable: true
                });

                // Update the location input field with the selected address
                input.value = place.formatted_address;

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        // Update the location input field when marker is dragged
        google.maps.event.addListener(marker, 'dragend', function(event) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'location': marker.getPosition() }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        input.value = results[0].formatted_address;
                    }
                }
            });
        });
    }

    // Initialize the map
    google.maps.event.addDomListener(window, 'load', initMap);

