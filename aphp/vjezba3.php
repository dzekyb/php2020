<?php

// Kreiranje konekcija prema bazi podataka i bazi app
$connection = new mysqli('localhost', 'root','Admin2021!','app');

// Dobavljanje podataka iz baze app, tabela user
$sql = "SELECT id, name, lastname, username, phone, email, created FROM user WHERE created LIKE '%%'";
$result = $connection->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $columns = array_keys($row);
        echo "<ul>";
            echo "<li>" . $columns[0] . ":" . $row['id'] . "</li>";
            echo "<li>" . $columns[1] . ":" . $row['name'] . "</li>";
            echo "<li>" . $columns[2] . ":" . $row['lastname'] . "</li>";
            echo "<li>" . $columns[3] . ":" . $row['username'] . "</li>";
            echo "<li>" . $columns[4] . ":" . $row['phone'] . "</li>";
            echo "<li>" . $columns[5] . ":" . $row['email'] . "</li>";
            echo "<li>" . $columns[6] . ":" . $row['created'] . "</li>";
        echo "</ul>";
    }
}else{
    echo "Nema rezultata, bruda.";
}