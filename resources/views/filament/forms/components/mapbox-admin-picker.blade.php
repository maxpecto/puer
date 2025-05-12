@php
    // $latitudeInputId = $getStatePath('mapbox_latitude'); // Artıq ehtiyac yoxdur
    // $longitudeInputId = $getStatePath('mapbox_longitude'); // Artıq ehtiyac yoxdur
    $apiKey = $getRecord()->mapbox_api_key ?? $getContainer()->getLivewire()->data['mapbox_api_key'] ?? null;
    $latitude = $getRecord()->mapbox_latitude ?? $getContainer()->getLivewire()->data['mapbox_latitude'] ?? 40.3790;
    $longitude = $getRecord()->mapbox_longitude ?? $getContainer()->getLivewire()->data['mapbox_longitude'] ?? 49.8533;
    $zoom = $getRecord()->mapbox_zoom_level ?? $getContainer()->getLivewire()->data['mapbox_zoom_level'] ?? 10;
    $styleUrl = $getRecord()->mapbox_style_url ?? $getContainer()->getLivewire()->data['mapbox_style_url'] ?? 'mapbox://styles/mapbox/streets-v11';
@endphp

@if($apiKey)
    <div wire:ignore class="mt-4">
        <link href='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css' rel='stylesheet' />
        <script src='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js'></script>
        
        <div id="admin-mapbox-picker" style="height: 400px; width: 100%; border-radius: 0.375rem;" class="shadow-sm border border-gray-300 dark:border-gray-600"></div>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ __('Click on the map to set coordinates or drag the marker.') }}</p>
    </div>

    @assets
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Mapbox API Key from Blade:', '{{ $apiKey }}');
            if (typeof mapboxgl !== 'undefined' && document.getElementById('admin-mapbox-picker')) {
                mapboxgl.accessToken = '{{ $apiKey }}';
                
                const latInput = document.getElementById('mapbox_latitude_input'); // SABİT ID İLƏ DƏYİŞDİRİLDİ
                const lngInput = document.getElementById('mapbox_longitude_input'); // SABİT ID İLƏ DƏYİŞDİRİLDİ

                if (!latInput || !lngInput) {
                    console.error('Mapbox Admin Picker: Latitude or Longitude input not found.');
                    return;
                }

                let initialLat = parseFloat(latInput.value) || {{ $latitude }};
                let initialLng = parseFloat(lngInput.value) || {{ $longitude }};
                let initialZoom = parseInt('{{ $zoom }}') || 10;

                const map = new mapboxgl.Map({
                    container: 'admin-mapbox-picker',
                    style: '{{ $styleUrl }}',
                    center: [initialLng, initialLat],
                    zoom: initialZoom
                });

                map.addControl(new mapboxgl.NavigationControl());

                const marker = new mapboxgl.Marker({
                    draggable: true,
                    color: '#10B981' // Tailwind green-500 for Filament
                })
                .setLngLat([initialLng, initialLat])
                .addTo(map);

                function updateInputs(lngLat) {
                    lngInput.value = lngLat.lng.toFixed(6);
                    latInput.value = lngLat.lat.toFixed(6);
                    // Trigger Livewire update if necessary, Filament might do this automatically for TextInput
                    // This might require dispatching an event that a Livewire component listens to.
                    // For simple TextInputs, direct value change might be picked up.
                    lngInput.dispatchEvent(new Event('input')); 
                    latInput.dispatchEvent(new Event('input'));
                }

                marker.on('dragend', function () {
                    updateInputs(marker.getLngLat());
                });

                map.on('click', function (e) {
                    marker.setLngLat(e.lngLat);
                    updateInputs(e.lngLat);
                });

                // Listen for changes in input fields to update marker position
                latInput.addEventListener('change', function(e) {
                    const newLat = parseFloat(e.target.value);
                    if (!isNaN(newLat)) {
                        const currentLng = marker.getLngLat().lng;
                        marker.setLngLat([currentLng, newLat]);
                        map.flyTo({center: [currentLng, newLat]});
                    }
                });

                lngInput.addEventListener('change', function(e) {
                    const newLng = parseFloat(e.target.value);
                    if (!isNaN(newLng)) {
                        const currentLat = marker.getLngLat().lat;
                        marker.setLngLat([newLng, currentLat]);
                        map.flyTo({center: [newLng, currentLat]});
                    }
                });

            } else {
                 if (!document.getElementById('admin-mapbox-picker')) {
                    console.warn('Mapbox Admin Picker: Container #admin-mapbox-picker not found.');
                 } else {
                    console.warn('Mapbox Admin Picker: mapboxgl is not defined. Make sure Mapbox GL JS is loaded.');
                 }
            }
        });
    </script>
    @endassets
@else
    <p class="text-sm text-danger-500 mt-2">{{ __('Mapbox API Key is not configured. Please set it in the settings to enable the map picker.') }}</p>
@endif 