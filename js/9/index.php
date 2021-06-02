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
        <li>Name: <span id="firstname"></span></li>
        <li>Lastname: <span id="lastname"></span></li>
        <li>Age: <span id="age"></span></li>
        <li>City: <span id="city"></span></li>
    </ul>

    <script>
        // Postavljanje podataka u localStorage
        localStorage.setItem("firstname", "Bruce");
        localStorage.setItem("lastname", "Wayne");

        // Postavljanje podataka u sessionStorage
        sessionStorage.setItem("age", "40");
        sessionStorage.setItem("city", "Gotham");

        // Dobavljanje podataka iz localStorage-a
        var firstname = localStorage.getItem("firstname");
        var lastname = localStorage.getItem("lastname");

        // Dobavljanje podataka iz sessionStorage-a
        var age = sessionStorage.getItem("age");
        var city = sessionStorage.getItem("city");

        // Postavljanje podataka u HTML
        document.getElementById("firstname").innerHTML = firstname;
        document.getElementById("lastname").innerHTML = lastname;

        // Postavljanje podataka u HTML
        document.getElementById("age").innerHTML = age;
        document.getElementById("city").innerHTML = city;

        // Brisanje podataka (odnosno jednog podatka) iz localStorage-a
        localStorage.removeItem('firstname');

        // Brisanje podataka (jednog podatka) iz sessionStorage-a
        sessionStorage.removeItem("age");

        // Brisanje svih podataka iz localStorage-a
        localStorage.clear();

        // Brisanje svih podataka iz sessionStorage-a
        sessionStorage.clear();

        
    </script>
</body>
</html>