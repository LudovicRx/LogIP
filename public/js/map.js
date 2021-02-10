var mymap;

function createMap() {
    mymap = L.map('mapid').setView([51.505, -0.09], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibHVkb3ZpY3J4IiwiYSI6ImNra3BsZ2JoczExcmwyeHJ3a2FmbHhmYWsifQ._-son2TunhXLWn0boYfjhQ'
    }).addTo(mymap);
    mymap.fitWorld();
}


function drawMarkers(locations) {
    for (let i = 0; i < locations.length; i++) {
        var marker = L.marker([locations[i].latlng.lat, locations[i].latlng.lng]);
        marker.riseOnHover = true;
        marker.bindPopup("<b>Pays :</b> " + locations[i].country + "<br/><b>Ville :</b> " + locations[i].city + "<br/><b>Date :</b> " + locations[i].date + "<br/><b>IP :</b> " + locations[i].ip).openPopup();
        marker.addTo(mymap);
    }
}