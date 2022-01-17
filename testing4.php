<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOOGLE</title>
    <link rel="icon" href='https://seeklogo.com/images/G/google-maps-2014-logo-6108508C7B-seeklogo.com.png'>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/map.css">
    <link rel="stylesheet" href="css/hotels.css">

    <style>
        .column{
       background: url('img.svg') 0 10px no-repeat;
        }
    </style>
</head>
<body>
    <div class="hotel-search" style="margin-left:45%">
        <div id="findhotels">Find hotels in:</div>

        <div id="locationField">
            <input id="autocomplete" placeholder="Enter a city" type="text" />
        </div>

        <div id="controls">
            <select id="country">
                <option value="all">All</option>
                <option value="am" selected>Armenia</option>
                <option value="au">Australia</option>
                <option value="br">Brazil</option>
                <option value="ca">Canada</option>
                <option value="fr">France</option>
                <option value="de">Germany</option>
                <option value="mx">Mexico</option>
                <option value="nz">New Zealand</option>
                <option value="it">Italy</option>
                <option value="za">South Africa</option>
                <option value="es">Spain</option>
                <option value="pt">Portugal</option>
                <option value="us" >U.S.A.</option>
                <option value="uk">United Kingdom</option>
            </select>
        </div>
    </div>

    <div id="listing" style="margin-left:58% ;z-index:1">
      <table id="resultsTable">
        <tbody id="results"></tbody>
      </table>
    </div>

    <div style="display: none">
        <div id="info-content">
            <table>
            <tr id="iw-url-row" class="iw_table_row">
                <td id="iw-icon" class="iw_table_icon"></td>
                <td id="iw-url"></td>
            </tr>
            <tr id="iw-address-row" class="iw_table_row">
                <td class="iw_attribute_name">Address:</td>
                <td id="iw-address"></td>
            </tr>
            <tr id="iw-phone-row" class="iw_table_row">
                <td class="iw_attribute_name">Telephone:</td>
                <td id="iw-phone"></td>
            </tr>
            <tr id="iw-rating-row" class="iw_table_row">
                <td class="iw_attribute_name">Rating:</td>
                <td id="iw-rating"></td>
            </tr>
            <tr id="iw-website-row" class="iw_table_row">
                <td class="iw_attribute_name">Website:</td>
                <td id="iw-website"></td>
            </tr>
        </table>
    </div>
</div>

<div class='container-fluid d-flex justify-content-center'>
    <div class="col4" >
        <div style="margin-bottom: 30px;">
            <div class="lbl-locations d-flex justify-content-between align-items-center" style="margin-top: 20px;margin-bottom: -18px">
                <h6>Travel Mode</h6>
                <!-- <input type="radio" name="travel_mode" class="travel_mode" value="WALKING"> WALKING -->
                <div class="d-flex justify-content-end align-items-center" >
                    <input type="radio" name="travel_mode" class="travel_mode" value="DRIVING" checked> DRIVING
                </div>
            </div>
            
            <div class="lbl-locations mt-4">Way Points</div>
                <div class="d-flex" style="width: 300px;height:25vh">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-8" >
                            <div id="columns" class="locations-option">
                                    <input type="text" name="way_start" class="form-control column way-points" draggable="true" placeholder="Waypoint">
                                    
                                    <input type="text" name="way_end" class="form-control column way-points" draggable="true" placeholder="Waypoint">
                                </div>
                                
                            </div>
                            
                            <div class="d-flex flex-column col-4" style="margin-left: -20px" id="clumns">
                                <button id="plus" class="btn mt-1 mb-1 btn-info" style="width: 100px" onclick="addWaypoint()"> Add waypoint </button>    
                                <button id="drawPath" class="btn mt-1 mb-1 btn-success" style="width: 100px"> Draw Path </button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div id="detalis">
                    
                    </div>
                    <!-- <button jstcache="1819" aria-label="Հյուրանոցներ" data-query="Հյուրանոցներ" jstrack="fW3dYYKbHaWnrgTD04W4CA:431" ved="1i:2,t:72610,e:1,p:fW3dYYKbHaWnrgTD04W4CA:431" vet="72610" jsaction="pane.402.categoricalSearch; ptrdown: ripple.play; mousedown: ripple.play; keydown: ripple.play" jsinstance="1" class="vtjJ8d-ZjTkM-mJSDk-LgbsSe NIyLF-haAclf" jsan="t-uIfk2b6FAmY,7.vtjJ8d-ZjTkM-mJSDk-LgbsSe,7.NIyLF-haAclf,0.aria-label,0.data-query,0.jstrack,0.ved,0.vet,0.jsaction"> <div jstcache="1825" aria-hidden="true" class="vtjJ8d-ZjTkM-mJSDk-LgbsSe-icon hfTblf-FzV1B-icon" style="width:48px;height:48px;background-color:#129EAF" jsan="7.vtjJ8d-ZjTkM-mJSDk-LgbsSe-icon,t--nVQGspr-Xc,7.hfTblf-FzV1B-icon,5.width,5.height,5.background-color,0.aria-hidden"> <img alt="" jstcache="137" src="//www.gstatic.com/images/icons/material/system_gm/1x/hotel_white_24dp.png" class="hfTblf-FzV1B-icon-HiaYvf" style="width:24px;height:24px" jsan="7.hfTblf-FzV1B-icon-HiaYvf,8.src,5.width,5.height,0.alt"> <div jstcache="138" style="display:none"></div> <div jstcache="139" style="display:none"></div> </div> <div jstcache="1826" class="vtjJ8d-ZjTkM-mJSDk-LgbsSe-text" jsan="7.vtjJ8d-ZjTkM-mJSDk-LgbsSe-text">Հյուրանոցներ</div> </button> -->
        </div>
        <div class="col-8" style="margin-left: 50px;padding-right:-20px">
            <div id="map-layer" style="height: 100vh"></div>
        </div>

    </div>

        <!-- https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations=Yerevan%7CGyumri%2CMA&origins=sevan&key=AIzaSyC8V-WrtEKeNhRHwGopMaoJI3mkKLbZJc0 -->
    
        <!-- <script src="js/hotel.js"></script> -->
        
    </body>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8V-WrtEKeNhRHwGopMaoJI3mkKLbZJc0&callback=initMap&libraries=places&v=weekly" async> </script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>

    <script LANGUAGE="JavaScript" TYPE="text/javascript">

        directionsService = JSON.parse(localStorage.getItem('directionsService'))
        directionsDisplay = JSON.parse(localStorage.getItem('directionsDisplay'))
        start = JSON.parse(localStorage.getItem('start'))
        end = JSON.parse(localStorage.getItem('end'))
        waypoints = JSON.parse(localStorage.getItem('waypoints'))

        if(localStorage.getItem('waypoints')=='[]'){
            document.getElementsByName("way_start")[0].value=JSON.parse(localStorage.getItem('start'));
            document.getElementsByName("way_end")[0].value=JSON.parse(localStorage.getItem('end'));

            let div = document.getElementById('clumns')
            let btn = document.createElement("button")
            btn.innerHTML='clear'
            btn.onclick = function () {
                localStorage.clear();
                history.go(0)
            };
            div.appendChild(btn)

            window.onload = function(){
                document.getElementById('drawPath').click();
            }   

        }
        else if(!localStorage.getItem('waypoints')){
            console.log('ok')
        }    
        else{
            document.getElementsByName("way_start")[0].value=JSON.parse(localStorage.getItem('start'));
            document.getElementsByName("way_end")[0].value=JSON.parse(localStorage.getItem('waypoints'))[0].location;

            let way =JSON.parse(localStorage.getItem('waypoints'))
            for(i=1;i<way.length;i++){
                let div = document.getElementById('columns')
                let inp = document.createElement("input");
                inp.classList.add('form-control','column','way-points')
                inp.draggable="true"
                inp.placeholder = "Waypoint"
                inp.value=way[i].location
                div.appendChild(inp)
            }
            let div = document.getElementById('columns')
            let inp = document.createElement("input");
            inp.classList.add('form-control','column','way-points')
            inp.draggable="true"
            inp.placeholder = "Waypoint"
            inp.value=JSON.parse(localStorage.getItem('end'))
            div.appendChild(inp)

            let divs = document.getElementById('clumns')
            let btn = document.createElement("button")
            btn.innerHTML='clear'
            btn.onclick = function () {
                localStorage.clear();
                history.go(0)
            };
            divs.appendChild(btn)
            
            window.onload = function(){
                document.getElementById('drawPath').click();
            }   
        }
        
        // drawPath(directionsService, directionsDisplay,start,end,waypoints)
        </script>
    <script src ="js/initMap.js"></script>

<script>
    var map;
    var waypoints;
    var directionsService;
    var directionsDisplay;
    let mcount=0
    let delay = 1
    var bounds;
    let places;
    let infoWindow;
        let latlng = []
        let markers = [];
        let autocomplete;
        const countryRestrict = { country: "am" };
        const MARKER_PATH = "https://developers.google.com/maps/documentation/javascript/images/marker_green";
        const hostnameRegexp = new RegExp("^https?://.+?/");
        const countries = {
            am: {
                center: { lat: 40.177200, lng: 45.003490 },
                zoom: 8,
            },
            au: {
                center: { lat: -25.3, lng: 133.8 },
                zoom: 4,
            },
            br: {
                center: { lat: -14.2, lng: -51.9 },
                zoom: 3,
            },
            ca: {
                center: { lat: 62, lng: -110.0 },
                zoom: 3,
            },
            fr: {
                center: { lat: 46.2, lng: 2.2 },
                zoom: 5,
            },
            de: {
                center: { lat: 51.2, lng: 10.4 },
                zoom: 5,
            },
            mx: {
                center: { lat: 23.6, lng: -102.5 },
                zoom: 4,
            },
            nz: {
                center: { lat: -40.9, lng: 174.9 },
                zoom: 5,
            },
            it: {
                center: { lat: 41.9, lng: 12.6 },
                zoom: 5,
            },
            za: {
                center: { lat: -30.6, lng: 22.9 },
                zoom: 5,
            },
            es: {
                center: { lat: 40.5, lng: -3.7 },
                zoom: 5,
            },
            pt: {
                center: { lat: 39.4, lng: -8.2 },
                zoom: 6,
            },
            us: {
                center: { lat: 37.1, lng: -95.7 },
                zoom: 3,
            },
            uk: {
                center: { lat: 54.8, lng: -4.6 },
                zoom: 5,
            },
        };

        initMap()

        function onPlaceChanged() {
            const place = autocomplete.getPlace();
            console.log(autocomplete,'askdljsa;ldj')
            if (place.geometry && place.geometry.location) {
                console.log('place.geometry',place.geometry)
                console.log('place.geometry.location',place.geometry.location);
                map.panTo(place.geometry.location);
                map.setZoom(15);
                search();
            } else {
                document.getElementById("autocomplete").placeholder = "Enter a city";
            }
        }

        function search() {
            const search = {
                bounds: map.getBounds(),
                types: ["lodging"],
            };

            places.nearbySearch(search, (results, status, pagination) => {
                if (status === google.maps.places.PlacesServiceStatus.OK && results) {
                    console.log(results)
                    clearResults();
                    clearMarkers();

                    // Create a marker for each hotel found, and
                    // assign a letter of the alphabetic to each marker icon.
                    for (let i = 0; i < results.length; i++) {
                        const markerLetter = String.fromCharCode("A".charCodeAt(0) + (i % 26));
                        const markerIcon = MARKER_PATH + markerLetter + ".png";

                        // Use marker animation to drop the icons incrementally on the map.
                        markers[i] = new google.maps.Marker({
                        position: results[i].geometry.location,
                        animation: google.maps.Animation.DROP,
                        icon: markerIcon,
                        });
                        // If the user clicks a hotel marker, show the details of that hotel
                        // in an info window.
                        markers[i].placeResult = results[i];
                        google.maps.event.addListener(markers[i], "click", showInfoWindow);
                        setTimeout(dropMarker(i), i * 100);
                        addResult(results[i], i);
                    }
                }
            });
        }

        function clearMarkers() {
            for (let i = 0; i < markers.length; i++) {
                if (markers[i]) {
                    markers[i].setMap(null);
                }
            }

            markers = [];
        }

            // Set the country restriction based on user input.
            // Also center and zoom the map on the given country.
        function setAutocompleteCountry() {
            const country = document.getElementById("country").value;

            if (country == "all") {
                autocomplete.setComponentRestrictions({ country: [] });
                map.setCenter({ lat: 15, lng: 0 });
                map.setZoom(2);
            } else {
                autocomplete.setComponentRestrictions({ country: country });
                map.setCenter(countries[country].center);
                map.setZoom(countries[country].zoom);
            }
            
            clearResults();
            clearMarkers();
        }
        
        function dropMarker(i) {
            return function () {
                markers[i].setMap(map);
            };
        }
        
        function addResult(result, i) {
            const results = document.getElementById("results");
            const markerLetter = String.fromCharCode("A".charCodeAt(0) + (i % 26));
            const markerIcon = MARKER_PATH + markerLetter + ".png";
            const tr = document.createElement("tr");
            
            tr.style.backgroundColor = i % 2 === 0 ? "#F0F0F0" : "#FFFFFF";
            tr.onclick = function () {
                google.maps.event.trigger(markers[i], "click");
            };
            
            const iconTd = document.createElement("td");
            const nameTd = document.createElement("td");
            const icon = document.createElement("img");

            icon.src = markerIcon;
            icon.setAttribute("class", "placeIcon");
            icon.setAttribute("className", "placeIcon");

            const name = document.createTextNode(result.name);

            iconTd.appendChild(icon);
            nameTd.appendChild(name);
            tr.appendChild(iconTd);
            tr.appendChild(nameTd);
            results.appendChild(tr);
        }

        function clearResults() {
            const results = document.getElementById("results");

            while (results.childNodes[0]) {
                results.removeChild(results.childNodes[0]);
            }
        }

            // Get the place details for a hotel. Show the information in an info window,
            // anchored on the marker for the hotel that the user selected.
        function showInfoWindow() {
            const marker = this;

            places.getDetails(
                { placeId: marker.placeResult.place_id },
                (place, status) => {
                if (status !== google.maps.places.PlacesServiceStatus.OK) {
                    return;
                }

                infoWindow.open(map, marker);
                buildIWContent(place);
                }
            );
        }

            // Load the place information into the HTML elements used by the info window.
        function buildIWContent(place) {
            document.getElementById("iw-icon").innerHTML =
                '<img class="hotelIcon" ' + 'src="' + place.icon + '"/>';
            document.getElementById("iw-url").innerHTML =
                '<b><a href="' + place.url + '">' + place.name + "</a></b>";
            document.getElementById("iw-address").textContent = place.vicinity;
            if (place.formatted_phone_number) {
                document.getElementById("iw-phone-row").style.display = "";
                document.getElementById("iw-phone").textContent =
                place.formatted_phone_number;
            } else {
                document.getElementById("iw-phone-row").style.display = "none";
            }

            // Assign a five-star rating to the hotel, using a black star ('&#10029;')
            // to indicate the rating the hotel has earned, and a white star ('&#10025;')
            // for the rating points not achieved.
            if (place.rating) {
                let ratingHtml = "";

                for (let i = 0; i < 5; i++) {
                if (place.rating < i + 0.5) {
                    ratingHtml += "&#10025;";
                } else {
                    ratingHtml += "&#10029;";
                }

                document.getElementById("iw-rating-row").style.display = "";
                document.getElementById("iw-rating").innerHTML = ratingHtml;
                }
            } else {
                document.getElementById("iw-rating-row").style.display = "none";
            }

            // The regexp isolates the first part of the URL (domain plus subdomain)
            // to give a short URL for displaying in the info window.
            if (place.website) {
                let fullUrl = place.website;
                let website = String(hostnameRegexp.exec(place.website));

                if (!website) {
                website = "http://" + place.website + "/";
                fullUrl = website;
                }

                document.getElementById("iw-website-row").style.display = "";
                document.getElementById("iw-website").textContent = website;
            } else {
                document.getElementById("iw-website-row").style.display = "none";
            }
        }

        // if(localStorage.getItem('start') && localStorage.getItem('end')){
        //     document.getElementsByName("way_start")[0].value=JSON.parse(localStorage.getItem('start'));
        //     console.log(JSON.parse(localStorage.getItem('start')))
        // }

        $("#drawPath").on("click",function() {
            let waypoints = []
            let zangvac = document.querySelectorAll('.way-points')
            console.log(zangvac),
            zangvac.forEach(
                (input, index) =>{
                    if( index > 0 && index < zangvac.length - 1){
                        waypoints.push(
                            {
                                location: input.value,
                                stopover: true
                            }
                        )
                    }

                } 
            )
            var start = zangvac[0].value; // skizb
            var end = zangvac[ zangvac.length - 1 ].value; // avart                
            // drawPath(directionsService, directionsDisplay,start,end,waypoints); // hinna

            let link = 'https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations=&origins=&key=AIzaSyC8V-WrtEKeNhRHwGopMaoJI3mkKLbZJc0'

            let link1 = 'https://maps.googleapis.com/maps/api/directions/json?origin=&destination=&waypoints=&alternatives=true&key=AIzaSyC8V-WrtEKeNhRHwGopMaoJI3mkKLbZJc0'

            
            

            myLink1=link1.split("waypoints=")
            myLink1.splice(1, 0, 'waypoints=')

            zangvac.forEach(
                (input, index) =>{
                    if( index > 0 && index < zangvac.length-1 ){
                        if(index!=zangvac.length-1){
                            myLink1.splice(length-2, 0, input.value,'|')
                        }
                        else{
                            myLink1.splice(length-2, 0, input.value)
                        }
                    }
                    
                } 
            )
            link1=myLink1.join('')

            myLink1=link1.split("origin=")
            myLink1.splice(1, 0, 'origin=')

            myLink1.splice(length-2, 0, start)
           
            link1=myLink1.join('')


            myLink1=link1.split("destination=")
            myLink1.splice(1, 0, 'destination=')
        
            myLink1.splice(length-2, 0, end)
           
            link1=myLink1.join('')
            console.log(link1)
            
            
            
            $.ajax({
                url: "server.php", 
                type: "post",
                data : { 
                    'name' : 'getDistance',
                    'link' : link1,
                } , 
                
                success: function(response){
                    console.log(latlng)
                    if(latlng.length){
                        for (let i = 0; i < latlng.length; i++) {
                            latlng[i].setMap(null);
                        }
                    }
                    latlng = [];
                    for(i=0;i<JSON.parse(response).routes[0].legs.length;i++){
                        for(j=0;j<JSON.parse(response).routes[0].legs[i].steps.length;j++){
                            latlng.push(JSON.parse(response).routes[0].legs[i].steps[j].end_location)

                        }
                    }
                    // console.log(latlng)
                    for(i=0;i<latlng.length;i++){
                        // new google.maps.Marker({position: latlng[i], map: map})
                        // let link2 = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=500&type=restaurant&keyword=cruise&key=+MY_API_CODE'
                        // let link2='https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=&radius=10000&name=Sheraton&key=AIzaSyC8V-WrtEKeNhRHwGopMaoJI3mkKLbZJc0'
                        // let link2='https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=&radius=10000&type=point_of_interest&keyword=cruise&key=AIzaSyC8V-WrtEKeNhRHwGopMaoJI3mkKLbZJc0'
                        let link2 = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=&radius=1000&type=hottels&keyword=cruise&key=AIzaSyC8V-WrtEKeNhRHwGopMaoJI3mkKLbZJc0'
                        myLink2=link2.split("location=")
                            myLink2.splice(1, 0, 'location=')
                                            
                            myLink2.splice(length-2, 0, latlng[i].lat+','+latlng[i].lng)
                                            
                            link2=myLink2.join('')
                            console.log(link2 , 'link2')
                        
                            $.ajax({
                                url: "server.php", 
                                type: "post",
                                data : { 
                                    'name' : 'getDistance',
                                    'link' : link2,
                                } , 
                                success: function(response){
                                    if(JSON.parse(response).results.length){
                                        console.log(mcount,JSON.parse(response).results[0].geometry.location)//results[0].geometry.location)
                                        mcount=mcount+1
                                        new google.maps.Marker({position: JSON.parse(response).results[0].geometry.location, map: map})

                                    }
                                    // if(latlng.length){
                                    //     for (let i = 0; i < latlng.length; i++) {
                                    //         latlng[i].setMap(null);
                                    //     }
                                    // }
                                    // latlng = [];
                                    // for(i=0;i<JSON.parse(response).routes[0].legs.length;i++){
                                    //     for(j=0;j<JSON.parse(response).routes[0].legs[i].steps.length;j++){
                                    //         latlng.push(JSON.parse(response).routes[0].legs[i].steps[j].end_location)

                                    //     }
                                    // }
                                }
                            })


                        // latlng[i]=new google.maps.Marker({position: latlng[i], map: map})
                    }
                }
            })




            var origin_addresses = []
            var destination_addresses = []

            let myLink=link.split("origins=")
            myLink.splice(1, 0, 'origins=')
            
            zangvac.forEach(
                (input, index) =>{
                    if( index >= 0 && index < zangvac.length-1){
                        origin_addresses.push(
                            {
                                location: input.value,
                                // stopover: true
                            }
                        )
                        if(index!=zangvac.length-1){
                            myLink.splice(length-2, 0, input.value,'%7C')
                        }
                        else{
                            myLink.splice(length-2, 0, input.value)
                        }
                    }

                } 
            )
            link=myLink.join('')
            myLink=link.split("destinations=")
            myLink.splice(1, 0, 'destinations=')

            zangvac.forEach(
                (input, index) =>{
                    if( index > 0 && index < zangvac.length ){
                        destination_addresses.push(
                            {
                                location: input.value,
                                // stopover: true
                            }
                        )
                        if(index!=zangvac.length-1){
                            myLink.splice(length-2, 0, input.value,'%7C')
                        }
                        else{
                            myLink.splice(length-2, 0, input.value)
                        }
                    }
                    
                } 
            )
            link=myLink.join('')

            function calcRoute(start, end) {
                var request = {
                    origin:start,
                    destination:end,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING,
                };
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        var step = 1;
                        var infowindow2 = new google.maps.InfoWindow();
                        infowindow2.setContent( directionsDisplay.directions.routes[0].legs[0].distance.text + "<br>" +  directionsDisplay.directions.routes[0].legs[0].duration.text + " ");
                        infowindow2.setPosition(response.routes[0].legs[0].steps[step].end_location);
                        infowindow2.open(map);
                    }
                });
            }
            // console.log(link)

            $.ajax({
                url: "server.php", 
                type: "post",
                data : { 
                    'name' : 'getDistance',
                    'link' : link,
                } , 

                success: function(response){
                    $stop = []
                    // console.log(response)
                    for(i=0;i<JSON.parse(response).rows.length;i++){
                        for(j=0;j<JSON.parse(response).rows[i].elements.length;j++){
                            if(j==i){
                                $stop.push(JSON.parse(response).rows[i].elements[j])
                            }
                        }
                    }
                    if(document.querySelector('.asd')){
                        let asd = document.querySelectorAll('.asd')
                        asd.forEach(element=>element.remove())
                    }
                    let km=0
                    let jamanak=0
                    for(i=0;i<$stop.length;i++){
                        // dynamic divs section
                        let tex = document.getElementById('detalis')
                        let div = document.createElement("div");
                        div.classList.add('asd' )
                        let div1 = document.createElement("div");
                        div1.classList.add('d-flex','border-top' )
                        km+=$stop[i].distance.value
                        jamanak+=$stop[i].duration.value
                    }
                    km=Math.round(km/1000)
                    or= Math.floor(jamanak/86400)
                    jam = Math.floor(jamanak/3600)
                    // console.log(or)
                    if(or>0){
                        jam = Math.round((jamanak-(86400*or))/3600)
                        jamanak ='Total Time = ' + or + ' day ' + jam + ' hours ' 
                        benzin =' Fuel = ' + Math.ceil(km/10)+' liters'
                        // console.log(km,jamanak,benzin)
                        km = 'Distance = '+km+' km'
                        
                        let tex = document.getElementById('detalis')
                        let div = document.createElement("div");
                        div.classList.add('asd','border-bottom','border-dark' )
                        let div1 = document.createElement("div");
                        div1.classList.add('d-flex' )
                        // div1.borderTopStyle = '2px solid red';
                        // div1.borderTopWidth= 'thin';
                        let h5 = document.createElement("h5");
                        h5.innerHTML='General Information'
                        let div2 = document.createElement("div");
                        let p = document.createElement("p");
                        p.innerHTML= jamanak
                        let p1 = document.createElement("p");
                        p1.innerHTML= km
                        let p2 = document.createElement("p");
                        p2.innerHTML= benzin

                        div1.appendChild(h5)
                        div.appendChild(div1)
                        div2.appendChild(p)
                        div2.appendChild(p1)
                        div2.appendChild(p2)
                        div.appendChild(div2)
                        tex.appendChild(div)
                        
                    }
                    else if(jam>0){
                        jamanak ='Total Time = '+ jam + ' hours ' + Math.ceil((jamanak-(3600*jam))/60)+' mins'
                        benzin =' Fuel = ' + Math.ceil(km/10)+' liters'
                        // console.log(km,jamanak,benzin)
                        km = 'Distance = '+km+' km'
                        
                        let tex = document.getElementById('detalis')
                        let div = document.createElement("div");
                        div.classList.add('asd','border-bottom','border-dark' )
                        let div1 = document.createElement("div");
                        div1.classList.add('d-flex' )
                        // div1.borderTopStyle = '2px solid red';
                        // div1.borderTopWidth= 'thin';
                        let h5 = document.createElement("h5");
                        h5.innerHTML='General Information'
                        let div2 = document.createElement("div");
                        let p = document.createElement("p");
                        p.innerHTML= jamanak
                        let p1 = document.createElement("p");
                        p1.innerHTML= km
                        let p2 = document.createElement("p");
                        p2.innerHTML= benzin

                        div1.appendChild(h5)
                        div.appendChild(div1)
                        div2.appendChild(p)
                        div2.appendChild(p1)
                        div2.appendChild(p2)
                        div.appendChild(div2)
                        tex.appendChild(div)
                    }
                    else{
                        jamanak ='Total Time = ' + Math.ceil(jamanak/60)+' mins'
                        benzin =' Fuel = ' + Math.ceil(km/10)+' liters'
                        // console.log(km,jamanak,benzin)
                        km = 'Distance = '+km+' km'
                        
                        let tex = document.getElementById('detalis')
                        let div = document.createElement("div");
                        div.classList.add('asd','border-bottom','border-dark' )
                        let div1 = document.createElement("div");
                        div1.classList.add('d-flex' )
                        // div1.borderTopStyle = '2px solid red';
                        // div1.borderTopWidth= 'thin';
                        let h5 = document.createElement("h5");
                        h5.innerHTML='General Information'
                        let div2 = document.createElement("div");
                        let p = document.createElement("p");
                        p.innerHTML= jamanak
                        let p1 = document.createElement("p");
                        p1.innerHTML= km
                        let p2 = document.createElement("p");
                        p2.innerHTML= benzin

                        div1.appendChild(h5)
                        div.appendChild(div1)
                        div2.appendChild(p)
                        div2.appendChild(p1)
                        div2.appendChild(p2)
                        div.appendChild(div2)
                        tex.appendChild(div)
                    }
 

                    for(i=0;i<$stop.length;i++){
                        // dynamic divs section
                        let tex = document.getElementById('detalis')
                        let div = document.createElement("div");
                        div.classList.add('asd' )
                        let div1 = document.createElement("div");
                        div1.classList.add('d-flex','border-top' )
                        km+=$stop[i].distance.value
                        jamanak+=$stop[i].duration.value 
                        // div1.borderTopStyle = '2px solid red';
                        // div1.borderTopWidth= 'thin';
                        // div1.borderTopWidth= 'thin';
                        let h5 = document.createElement("h5");
                        h5.innerHTML=origin_addresses[i].location
                        let h52 = document.createElement("h5");
                        h52.innerHTML='-'
                        let h51 = document.createElement("h5");
                        h51.innerHTML= destination_addresses[i].location

                        let div2 = document.createElement("div");
                        div2.classList.add('d-flex' , 'justify-content-between')
                        let p = document.createElement("p");
                        p.innerHTML= $stop[i].duration.text 
                        let p1 = document.createElement("p");
                        p1.innerHTML= $stop[i].distance.text

                        div1.appendChild(h5)
                        div1.appendChild(h52)
                        div1.appendChild(h51)
                        div.appendChild(div1)
                        div2.appendChild(p)
                        div2.appendChild(p1)
                        div.appendChild(div2)
                        tex.appendChild(div)
                        if(i <= $stop.length - 1) {
                            
                            // calcRoute( zangvac[i].value, zangvac[i+1].value )
                            // calcRoute( new google.maps.LatLng(40.5484, 44.94868) , new google.maps.LatLng(39.691, 45.46653) )
                        }
                    }
                }           
            });
            drawPath(directionsService, directionsDisplay,start,end,waypoints);  

        });

        // ES FUNKCIAN NKARUMA DIRECTIONY
        function drawPath(directionsService, directionsDisplay,start,end,waypoints) {
            // new google.maps.Marker({position: {lat:  40.177200, lng: 45.003490}, map: map})
            window.localStorage.setItem('start', JSON.stringify(start));
            window.localStorage.setItem('waypoints', JSON.stringify(waypoints));
            window.localStorage.setItem('end', JSON.stringify(end));
            
            directionsService.route(
                {
                    origin: start,
                    waypoints: waypoints, //stop keteri zangvac
                    destination: end,
                    optimizeWaypoints: false, // hertakanutyuny vor chxarni
                    travelMode: $("input[name='travel_mode']:checked"). val(),
                }, 
                function(response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Problem in showing direction due to ' + status);
                    }
                }
            );
        }

        

        // ADD WAYPOINTS
        let count
        if(!waypoints){
             count = 2
        }else{
            count=waypoints.length + 2
        }
        function addWaypoint(){
            count++
            if(count>5){
                alert("you can't add more destinations")
            }
            else{
                let div = document.getElementById('columns')
                let inp = document.createElement("input");
                inp.classList.add('form-control','column','way-points')
                inp.draggable="true"
                inp.placeholder = "Waypoint"
                inp.value=""
                inp.addEventListener('dragstart', handleDragStart, false);
                inp.addEventListener('dragover', handleDragOver, false);
                inp.addEventListener('dragleave', handleDragLeave, false);
                inp.addEventListener('drop', handleDrop, false);
                inp.addEventListener('dragend', handleDragEnd, false);
                div.appendChild(inp)
            }
        }
    </script>

    <script src="js/drag.js"></script>
</html>