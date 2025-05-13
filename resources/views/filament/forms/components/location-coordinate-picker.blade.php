<div id="map-picker-container" style="height: 400px; width: 100%; border-radius: 0.5rem; margin-top: 0.5rem;" wire:ignore>
    <div id="map-picker-element" 
         style="height: 100%; width: 100%;"
         data-mapbox-api-key="{{ $mapboxApiKey ?? '' }}"
         data-mapbox-style-url="{{ $mapboxStyleUrl ?? 'mapbox://styles/mapbox/streets-v12' }}"
         data-current-latitude="{{ $currentLatitude ?? '' }}"
         data-current-longitude="{{ $currentLongitude ?? '' }}"
    ></div>
</div>

@pushonce('scripts')
<link href='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.mapboxCoordinatePickerInitialized && document.getElementById('map-picker-element')._mapboxgl)
        {
            console.log('Mapbox coordinate picker already initialized and map instance exists.');
            return;
        }
        window.mapboxCoordinatePickerInitialized = true;

        const mapElement = document.getElementById('map-picker-element');
        if (!mapElement) {
            console.error('Map element (id: map-picker-element) not found.');
            return;
        }

        // Data atributlarından dəyərləri oxu
        const mapboxApiKey = mapElement.dataset.mapboxApiKey || null;
        const mapboxStyleUrl = mapElement.dataset.mapboxStyleUrl || 'mapbox://styles/mapbox/streets-v12';
        const currentLatFromPHP = mapElement.dataset.currentLatitude ? parseFloat(mapElement.dataset.currentLatitude) : null;
        const currentLngFromPHP = mapElement.dataset.currentLongitude ? parseFloat(mapElement.dataset.currentLongitude) : null;

        const latitudeInputId = 'latitude'; 
        const longitudeInputId = 'longitude';

        const latitudeInput = document.getElementById(latitudeInputId);
        const longitudeInput = document.getElementById(longitudeInputId);

        console.log('Map Picker Script Initializing (v3 - data attributes)...');
        console.log('Mapbox API Key:', mapboxApiKey ? (mapboxApiKey === '' ? 'EMPTY_STRING_FROM_DATA_ATTR' : 'SET') : 'NOT_SET_OR_NULL');
        console.log('Mapbox Style URL:', mapboxStyleUrl);
        console.log('Latitude Input Element:', latitudeInput);
        console.log('Longitude Input Element:', longitudeInput);
        console.log('Current Latitude from PHP (data-attr):', currentLatFromPHP);
        console.log('Current Longitude from PHP (data-attr):', currentLngFromPHP);

        if (!mapboxApiKey || mapboxApiKey === '') { // Boş string olub olmadığını da yoxla
            mapElement.innerHTML = '<div style="padding: 20px; text-align: center; color: red;">Mapbox API açarı təyin edilməyib və ya boşdur. Zəhmət olmasa, Ayarlar səhifəsindən Mapbox API açarını daxil edin.</div>';
            console.error('Mapbox API Key is missing or empty.');
            return;
        }

        if (!latitudeInput || !longitudeInput) {
            console.error('Latitude or Longitude input element not found.');
            mapElement.innerHTML = '<div style="padding: 20px; text-align: center; color: red;">Enlik və ya Uzunluq üçün input elementləri tapılmadı. IDləri yoxlayın.</div>';
            return;
        }

        mapboxgl.accessToken = mapboxApiKey;

        let initialLat = currentLatFromPHP || parseFloat(latitudeInput.value) || 40.3790;
        let initialLng = currentLngFromPHP || parseFloat(longitudeInput.value) || 49.8533;
        let initialZoom = (currentLatFromPHP && currentLngFromPHP) ? 13 : ( (latitudeInput.value && longitudeInput.value && !isNaN(parseFloat(latitudeInput.value)) && !isNaN(parseFloat(longitudeInput.value)) ) ? 13 : 9);
        
        if (currentLatFromPHP && latitudeInput.value !== String(currentLatFromPHP).substring(0, latitudeInput.value.length)) { // substring to avoid precision issues in comparison
            latitudeInput.value = parseFloat(currentLatFromPHP).toFixed(7);
        }
        if (currentLngFromPHP && longitudeInput.value !== String(currentLngFromPHP).substring(0, longitudeInput.value.length)) {
            longitudeInput.value = parseFloat(currentLngFromPHP).toFixed(7);
        }

        console.log(`Map Initializing with Coords: Lat=${initialLat}, Lng=${initialLng}, Zoom=${initialZoom}`);

        try {
            const map = new mapboxgl.Map({
                container: mapElement,
                style: mapboxStyleUrl,
                center: [initialLng, initialLat],
                zoom: initialZoom
            });

            map.addControl(new mapboxgl.NavigationControl());
            let marker = null;

            function updateMarkerAndInputs(lng, lat, dispatchEvent = true) {
                if (marker) {
                    marker.setLngLat([lng, lat]);
                } else {
                    marker = new mapboxgl.Marker({ draggable: true })
                        .setLngLat([lng, lat])
                        .addTo(map);
                    marker.on('dragend', function() {
                        const lngLat = marker.getLngLat();
                        updateMarkerAndInputs(lngLat.lng, lngLat.lat, true);
                    });
                }
                const newLatStr = parseFloat(lat).toFixed(7);
                const newLngStr = parseFloat(lng).toFixed(7);
                if (latitudeInput.value !== newLatStr) {
                    latitudeInput.value = newLatStr;
                    if(dispatchEvent) latitudeInput.dispatchEvent(new Event('input', { bubbles: true }));
                }
                if (longitudeInput.value !== newLngStr) {
                    longitudeInput.value = newLngStr;
                    if(dispatchEvent) longitudeInput.dispatchEvent(new Event('input', { bubbles: true }));
                }
            }

            if (!isNaN(initialLat) && !isNaN(initialLng) && !(initialLat === 40.3790 && initialLng === 49.8533)) {
                 updateMarkerAndInputs(initialLng, initialLat, false);
            }
           
            map.on('click', function(e) {
                updateMarkerAndInputs(e.lngLat.lng, e.lngLat.lat);
                map.flyTo({center: [e.lngLat.lng, e.lngLat.lat], zoom: Math.max(map.getZoom(), 13)});
            });
            
            const observer = new ResizeObserver(() => {
                if (map && mapElement.offsetParent !== null) { 
                    map.resize();
                }
            });
            observer.observe(mapElement);
            console.log('Map initialized successfully.');

        } catch (error) {
            console.error('Error initializing Mapbox map:', error);
            mapElement.innerHTML = `<div style="padding: 20px; text-align: center; color: red;">Xəritə yüklənərkən xəta baş verdi: ${error.message}</div>`;
        }
    });
</script>
@endpushonce 