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
</head>
<body>
    
    <h1>My Google Map</h1>
    <div class="d-flex justify-content-center">
        <div 
            id="googleMap" 
            style="width:80%;height:90vh;"
        ></div>
    </div>


</body>

<script>
    function myMap() {
        var mapProp= {
            center: new google.maps.LatLng( 40.177200, 44.503490 ),
            zoom:12,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8V-WrtEKeNhRHwGopMaoJI3mkKLbZJc0&callback=myMap"></script>
</html>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXt7RJ-OvC-f69xvAPFCXyJRbiL6l0x_8&libraries=&v=weekly&libraries=geometry,places&libraries=places" ></script> -->