<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOOGLE</title>
    <link rel="icon" href='https://seeklogo.com/images/G/google-maps-2014-logo-6108508C7B-seeklogo.com.png'>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/map.css">
</head>
<body>


        <div class='container-fluid d-flex justify-content-center'>
            <div class="col4" >
                <div style="margin-bottom: 30px;">
                    <div class="lbl-locations d-flex justify-content-between align-items-center" style="margin-top: 20px;">
                        <h6>Travel Mode</h6>
                        <!-- <input type="radio" name="travel_mode" class="travel_mode" value="WALKING"> WALKING -->
                        <div class="d-flex justify-content-end align-items-center">
                            <input type="radio" name="travel_mode" class="travel_mode" value="DRIVING" checked> DRIVING
                        </div>
                    </div>

                    <div class="lbl-locations mt-4">Way Points</div>
                    <div class="d-flex" style="width: 300px;">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-8" >
                                    <div id="columns" class="locations-option">
                                        <input type="text"  name="way_start" class="form-control column way-points" draggable="true" placeholder="Waypoint">

                                        <input type="text"  name="way_end" class="form-control column way-points" draggable="true" placeholder="Waypoint">
                                    </div>

                            </div>
        
                            <div class="d-flex flex-column col-4" style="margin-left: -20px">
                                <button id="plus" class="btn mt-1 mb-1 btn-info" style="width: 100px" onclick="addWaypoint()"> Add waypoint </button>    
                                <button id="drawPath" class="btn mt-1 mb-1 btn-success" style="width: 100px"> Draw Path </button>
                            </div>
                        </div>
                    </div>
            
                </div>
                <div id="detalis">

                </div>
            </div>
            <div class="col-8" style="margin-left: 50px;">
                <div id="map-layer" class="w-100" style="height: 100vh"></div>
            </div>

        </div>


        <!-- https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations=Yerevan%7CGyumri%2CMA&origins=sevan&key=AIzaSyB5qDIoQ-yiKZz2rYdnLYxTtSqbrjN5aLg -->
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5qDIoQ-yiKZz2rYdnLYxTtSqbrjN5aLg"> </script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>

    <script>
      	var map;
      	var waypoints;
        var directionsService;
        var directionsDisplay;
        let delay = 1
        var bounds;

        var addresses = [
            ['Yerevan', 'Vedi'],
            ['Vedi' , 'Artashat'],
            ['Artashat', 'Garni'],
        ];

      	function initMap() {
            var mapLayer = document.getElementById("map-layer");
            var centerCoordinates = new google.maps.LatLng(40.177200, 45.003490);
            var defaultOptions = { 
                center: centerCoordinates,
                zoom: 8
            }
            map = new google.maps.Map(mapLayer, defaultOptions);
            directionsService = new google.maps.DirectionsService;
            directionsDisplay = new google.maps.DirectionsRenderer;
            directionsDisplay.setMap(map);
            bounds = new google.maps.LatLngBounds();
      	}
        initMap()


        $("#drawPath").on("click",function() {
            let waypoints = []
            let zangvac = document.querySelectorAll('.way-points')
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

            let link = 'https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations=&origins=&key=AIzaSyB5qDIoQ-yiKZz2rYdnLYxTtSqbrjN5aLg'

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

            // function calcRoute(start, end) {
            //     var request = {
            //         origin:start,
            //         destination:end,
            //         travelMode: google.maps.DirectionsTravelMode.DRIVING,
            //     };
            //     directionsService.route(request, function(response, status) {
            //         if (status == google.maps.DirectionsStatus.OK) {
            //             directionsDisplay.setDirections(response);
            //             var step = 1;
            //             var infowindow2 = new google.maps.InfoWindow();
            //             infowindow2.setContent( directionsDisplay.directions.routes[0].legs[0].distance.text + "<br>" +  directionsDisplay.directions.routes[0].legs[0].duration.text + " ");
            //             infowindow2.setPosition(response.routes[0].legs[0].steps[step].end_location);
            //             infowindow2.open(map);
            //         }
            //     });
            // }

            $.ajax({
                url: "server.php", 
                type: "post",
                data : { 
                    'name' : 'getDistance',
                    'link' : link,
                } , 
                success: function(response){
                    $stop = []
                    console.log(response)
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
                    for(i=0;i<$stop.length;i++){
                        // dynamic divs section
                        if(i <= $stop.length - 1) {
                            // calcRoute( zangvac[i].value, zangvac[i+1].value )
                            // calcRoute( new google.maps.LatLng(40.5484, 44.94868) , new google.maps.LatLng(39.691, 45.46653) )
                        }
                    }
                }           
            });
            theNext()
        });

        // ES FUNKCIAN NKARUMA DIRECTIONY
        // function drawPath(directionsService, directionsDisplay,start,end,waypoints) {
        //     directionsService.route(
        //         {
        //             origin: start,
        //             waypoints: waypoints, //stop keteri zangvac
        //             destination: end,
        //             optimizeWaypoints: false, // hertakanutyuny vor chxarni
        //             travelMode: $("input[name='travel_mode']:checked"). val()
        //         }, 
        //         function(response, status) {
        //             if (status === 'OK') {
        //                 directionsDisplay.setDirections(response);
        //             } else {
        //                 window.alert('Problem in showing direction due to ' + status);
        //             }
        //         }
        //     );
        // }

        // DRAW ROUTES ON THE MAP START
        function drawPath(start,end,next) {
            var request = {
                origin: start,
                destination: end,
                optimizeWaypoints: false,
                travelMode: google.maps.DirectionsTravelMode.DRIVING,
            };
            directionsService.route(request,
                function(result, status) {
                    if (status == 'OK') {
                        directionsDisplay = new google.maps.DirectionsRenderer({
                            suppressMarkers: true,
                            preserveViewport: true
                        });
                        directionsDisplay.setOptions({
                            polylineOptions: {
                                strokeWeight: 4,
                                strokeOpacity: 1,
                                strokeColor:  '#0ae'
                            }
                        });
                        directionsDisplay.setMap(map);
                        directionsDisplay.setDirections(result);
                        bounds.union(result.routes[0].bounds);
                        map.fitBounds(bounds);
                        var infowindow2 = new google.maps.InfoWindow();
                        infowindow2.setContent( directionsDisplay.directions.routes[0].legs[0].distance.text + "<br>" +  directionsDisplay.directions.routes[0].legs[0].duration.text + " ");
                        infowindow2.setPosition(result.routes[0].legs[0].steps[1].end_location);
                        infowindow2.open(map);
                    }
                    else {
                        console.log("status=" + status + " (start=" + start + ", end=" + end + ")");
                        if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                            nextAddress--;
                            delay += 100;
                        }
                    }
                    next();
                }
            );
        }
        var nextAddress = 0;
        function theNext() {
            if (nextAddress < addresses.length) {
                setTimeout('drawPath("' + addresses[nextAddress][0] + '","' + addresses[nextAddress][1] + '",theNext)', delay);
                nextAddress++;
            } else {
                map.fitBounds(bounds);
            }
        }
        // DRAW ROUTES ON THE MAP END

        // ADD WAYPOINTS
        let count = 0
        let i=2
        function addWaypoint(){
            if(i!=6){
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
                i++
            }
            else{
                alert('you can added maximum 6 destination')
            }
        }
	</script>

    <script src="js/drag.js"></script>
    
</body>
</html>