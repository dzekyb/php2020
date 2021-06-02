<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p id="location"></p>
    <button onclick="getLocation()">Get Location</button>

    <script>
        var element = document.getElementById("location");

        function getLocation(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }else{
                element.innerHTML = "Geolocation is not supported!";
            }
        }

        function showPosition(position){
            element.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
        }

    </script>
</body>
</html>