<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script>
        var json = '{"name":"Bruce", "lastname":"Wayne", "age":"40"}';
        var jsonObject = JSON.parse(json);
        console.log(jsonObject);
        console.log(jsonObject.name + " " + jsonObject.lastname);
        console.log("-------");
        var jsonString = JSON.stringify(jsonObject);
        console.log(jsonString);
    </script>
</body>
</html>