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
        // Kreiramo neki objekat sa korisničkim podacima
        var user = {
            name : "John",
            age  : "31",
            city : "New York"
        }
        // Pretvaramo objekat u JSON notaciju (string)
        var dataToStore = JSON.stringify(user);
        // Pozivamo localStorage i čuvamo taj kompletan JSON
        // pod ključem koji se zove user unutar browsera
        localStorage.setItem("userTest", dataToStore);
        
        // Dobavljanje podataka iz local storage-a
        var dataFromStorage = localStorage.getItem("userTest");
        // Tek ovdje smo konvertovali string u objekat
        dataFromStorage = JSON.parse(dataFromStorage);
        // Ispis podataka iz kreiranog objekta u konzolu
        console.log(dataFromStorage.name); // Objektni pristup
        console.log(dataFromStorage['age']); // Pristup kao da je niz

    </script>
</body>
</html>