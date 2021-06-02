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
    <li> Name: <span id="name"></span></li>
    <li> Lastname: <span id="lastname"></span></li>
    <li> Age: <span id="age"></span></li>
    <li> City: <span id="city"></span></li>
</ul>

<script>
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            var user = JSON.parse(this.responseText);
            //document.getElementById("name").innerHTML = user.name;
            //document.getElementById("lastname").innerHTML = user.lastname;
            //document.getElementById("age").innerHTML = user.age;
            //document.getElementById("city").innerHTML = user.city;

            document.getElementById("name").innerHTML = user[0];
            document.getElementById("lastname").innerHTML = user[1];
            document.getElementById("age").innerHTML = user[2];
            document.getElementById("city").innerHTML = user[3];
        }
    };
    
    ajax.open("GET", "server2.php", true);
    ajax.send();

</script>

</body>
</html>