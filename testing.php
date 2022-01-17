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
    <style>
        .column{
       background: url('img.svg') 0 10px no-repeat;
        }
    </style>
</head>
<body>


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
                                        <input type="text"  name="way_start" class="form-control column way-points" draggable="true" placeholder="Waypoint">

                                        <input type="text"  name="way_end" class="form-control column way-points" draggable="true" placeholder="Waypoint">
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
            </div>
            <div class="col-8" style="margin-left: 50px;">
                <div id="map-layer" class="w-100" style="height: 100vh"></div>
            </div>

        </div>


        <!-- https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations=Yerevan%7CGyumri%2CMA&origins=sevan&key=AIzaSyB5qDIoQ-yiKZz2rYdnLYxTtSqbrjN5aLg -->
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5qDIoQ-yiKZz2rYdnLYxTtSqbrjN5aLg"> </script>
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

    <script>
      	var map;
      	var waypoints;
        var directionsService;
        var directionsDisplay;
        let delay = 1
        var bounds;

        

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
            console.log(directionsService, directionsDisplay,start,end,waypoints)
            window.localStorage.setItem('start', JSON.stringify(start));
            window.localStorage.setItem('waypoints', JSON.stringify(waypoints));
            window.localStorage.setItem('end', JSON.stringify(end));
            
            directionsService.route(
                {
                    origin: start,
                    waypoints: waypoints, //stop keteri zangvac
                    destination: end,
                    optimizeWaypoints: false, // hertakanutyuny vor chxarni
                    travelMode: $("input[name='travel_mode']:checked"). val()
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
        let count = 2
        let i=2
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
    
</body>
</html>