// Constantes
const FIRST_STEP_COLOR = 5;// Premier pas avant la deuxième couleur
const SECOND_STEP_COLR = 10;// Deuxième pas pour arriver à la troisième couleur 

// Variables
var mymap;// Map affichée

/**
 * Creates the map
 */
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

/**
 * Draw the markers thanks to the locations
 * @param {array} locations array with all the locations
 */
function drawMarkers(locations) {
    for (key in data) {
        var marker = L.marker([locations[key].latlng.lat, locations[key].latlng.lng]);
        marker.riseOnHover = true;
        marker.bindPopup("<b>Pays :</b> " + locations[key].country + "<br/><b>Ville :</b> " + locations[key].city + "<br/><b>Date :</b> " + locations[key].date + "<br/><b>IP :</b> " + key).openPopup();

        // Différentes couleur sen fonction du nombre d'occurrence
        if (locations[key].count <= FIRST_STEP_COLOR) {

        } else if (locations[key].count <= FIRST_STEP_COLOR) {

        } else {

        }

        marker.addTo(mymap);
    }
}