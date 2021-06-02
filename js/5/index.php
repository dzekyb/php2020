<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        <li>Name: <span id="name"></span></li>
        <li>Age: <span id="age"></span></li>
    </ul>
    <script>
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var userObject = JSON.parse(this.responseText);
                document.getElementById("name").innerHTML = userObject.name;
                document.getElementById("age").innerHTML = userObject.age;
            }
        };
        ajax.open("GET", "data.json", true);
        ajax.send();
    </script>
</body>
</html>