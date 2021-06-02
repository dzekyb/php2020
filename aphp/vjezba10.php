<?php

try{
    // PDO konekcija
    $connection = new PDO("mysql:host=localhost;port=3306;dbname=app", 'phproot', 'phproot2021!');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $connection->query("SELECT * FROM user");
    while($row = $sql->fetch(PDO::FETCH_ASSOC)){
        echo "ID: " . $row['id'] . ", " . $row['username'];
        echo "<br>";
    }

}catch(PDOException $e){
    echo "Greška: " . $e->getMessage();
}
