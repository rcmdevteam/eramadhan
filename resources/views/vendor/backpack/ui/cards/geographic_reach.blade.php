<div class="card mb-2">
    <div class="card-body pt-0 mt-3">
        <div>Geographic Reach</div>
        <div id="map" style="height: 316px;"></div>
    </div>
</div>

@push('after_styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('after_scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Dummy data for map (replace with actual data)
    const locationsGeographicReach = [
      { lat: 5.661635271887032, lng: 100.508174766912294, title: 'Event 1' },
      { lat: 5.799629388365625, lng: 100.61653516865843, title: 'Event 2' },
      { lat: 5.5078690781068325, lng: 100.52582946072148, title: 'Event 3' },
    ];
  
    // Create a Leaflet map
    const map = L.map('map').setView([5.661635271887032, 100.50817476691229], 10);
  
    // Add OpenStreetMap as the base layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);
  
    // Add markers for each location
    locationsGeographicReach.forEach(location => {
      L.marker([location.lat, location.lng]).addTo(map)
        .bindPopup(location.title);
    });
  </script>
@endpush