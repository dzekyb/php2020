<?php

// Konekcija
$connection = new mysqli('localhost', 'phproot', 'phproot2021!');

$name = "Test";
$lastname = "Testović";
$username = "testtest";
$password = "Adanijetest?";
$phone = "+38761111111";
$email = "test@test.com";
$status = "1";

// Ubacivanje podataka
$sql = "INSERT INTO app.user (
    name, 
    lastname, 
    username, 
    password, 
    phone, 
    email, 
    status) 
    VALUES (
        '{$name}',
        '{$lastname}',
        '{$username}',
        '{$password}',
        '{$phone}',
        '{$email}',
        '{$status}'
        )";

    if($connection->query($sql) === true){
        echo "Inserted";
    }else{
        echo "Not inserted";
        echo "<br>";
        echo $connection->error;
    }

// $ime = "{$var}-nekiString";
?>