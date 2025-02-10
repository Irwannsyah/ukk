// Ambil elemen input latitude dan longitude
const latitudeInput = document.getElementById('latitude');
const longitudeInput = document.getElementById('longitude');

// Ambil nilai default latitude dan longitude dari input
let latitude = parseFloat(latitudeInput.value) || 0;
let longitude = parseFloat(longitudeInput.value) || 0;

// Inisialisasi peta dengan Leaflet.js
const map = L.map('map').setView([latitude, longitude], 13);

// Tambahkan tile layer
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

// Tambahkan marker ke peta
let marker = L.marker([latitude, longitude]).addTo(map);
marker.bindPopup('Lokasi Wisata').openPopup();

// Fungsi untuk memperbarui marker dan peta
function updateMap() {
    const newLatitude = parseFloat(latitudeInput.value);
    const newLongitude = parseFloat(longitudeInput.value);

    if (!isNaN(newLatitude) && !isNaN(newLongitude)) {
        // Update marker posisi
        marker.setLatLng([newLatitude, newLongitude]);
        // Update peta posisi
        map.setView([newLatitude, newLongitude], 13);
    }
}

// Tambahkan event listener pada input latitude dan longitude
latitudeInput.addEventListener('input', updateMap);
longitudeInput.addEventListener('input', updateMap);
