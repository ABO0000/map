function initMap() {
    var mapLayer = document.getElementById("map-layer");
    var centerCoordinates = new google.maps.LatLng(40.177200, 45.003490);
    var defaultOptions = { 
        center: centerCoordinates,
        zoom: 8
    }
    map = new google.maps.Map(mapLayer, {
        zoom: countries["am"].zoom,
        center: countries["am"].center,
        mapTypeControl: false,
        panControl: false,  
        zoomControl: false, 
        streetViewControl: false,   
    });
    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay.setMap(map);
    bounds = new google.maps.LatLngBounds();

    infoWindow = new google.maps.InfoWindow({
        content: document.getElementById("info-content"),
    });
    // Create the autocomplete object and associate it with the UI input control.
    // Restrict the search to the default country, and to place type "cities".
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("autocomplete"),
        {
        types: ["(cities)"],
        componentRestrictions: countryRestrict,
        fields: ["geometry"],
        }
    );
    places = new google.maps.places.PlacesService(map);
    autocomplete.addListener("place_changed", onPlaceChanged);
    // Add a DOM event listener to react when the user selects a country.
    document
        .getElementById("country")
        .addEventListener("change", setAutocompleteCountry);
}
