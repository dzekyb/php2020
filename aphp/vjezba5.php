<?php

// Konekcija
$connection = new mysqli('localhost', 'phproot', 'phproot2021!');

// Update
$sql = "UPDATE app.user SET name='Nije test', lastname='Nije Testović' WHERE app.user.id > 5";

if($connection->query($sql) === true){
    echo "Updated";
}else{
    echo "Not updated: " . $connection->error;
}