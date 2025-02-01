
var latitude = -7.9422;
var longitude = 112.9530;

var map = L.map('map').setView([latitude, longitude], 13);





// mark pada maps
var marker = L.marker([latitude, longitude]).addTo(map);
marker.bindPopup(`lokasi wisata`)
// var circle = L.circle([latitude, longitude], {
//     color:'red',
//     fillOpacity : 0.5,
//     radius : 1000,
// }).addTo(map);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
