// Projet    :   Log IP
// Auteur    :   Ludovic Roux
// Desc.     :   Fichier qui gère la map
// Version   :   1.0, 14.04.2021, LR, version initiale

// Constantes
const FIRST_STEP_COLOR = 5;// Premier pas avant la deuxième couleur
const SECOND_STEP_COLOR = 10;// Deuxième pas pour arriver à la troisième couleur 

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
        var myIcon = L.icon({
            // iconUrl: 'res/img/marker.svg',
            iconSize: [38, 95],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76],
            // shadowUrl: 'my-icon-shadow.png',
            shadowSize: [68, 95],
            shadowAnchor: [22, 94]
        });
        // Différentes couleur sen fonction du nombre d'occurrence
        if (locations[key].count <= FIRST_STEP_COLOR) {
            myIcon.options.iconUrl = 'res/img/markerFirstStep.svg';
        } else if (locations[key].count <= SECOND_STEP_COLOR) {
            myIcon.options.iconUrl = 'res/img/markerSecondStep.svg';
        } else {
            myIcon.options.iconUrl = 'res/img/markerThirdStep.svg';
        }


        var marker = L.marker([locations[key].latlng.lat, locations[key].latlng.lng], { icon: myIcon });
        var textPopup = "<b>Pays :</b> " + locations[key].country +
            "<br/><b>Ville :</b> " + locations[key].city +
            "<br/><b>Date :</b> " + locations[key].date +
            "<br/><b>IP :</b> " + key +
            "<br/><b>URL :</b> " + locations[key].url +
            "<br/><b>Code :</b> " + locations[key].code +
            "<br/><b>Agent :</b> " + locations[key].agent;

        if (locations[key].count > 1) {
            textPopup += "<br/><b>Nombre d'attaques : </b>" + locations[key].count;
        }

        marker.riseOnHover = true;
        marker.bindPopup(textPopup).openPopup();


        marker.addTo(mymap);
    }
}