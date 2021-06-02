<?php

// Konekcija na bazu
$connection = mysqli_connect('localhost', 'root', '', 'php_test_1');
// Testiranje konekcije
if($connection_error = mysqli_connect_error($connection)){
    die('Wrong connection to the server!');
}
// SQL Upit
$query = mysqli_query($connection, "SELECT * FROM php_tabela");
// Testiranje da li upit radi (vraća li nešto osim false)
#var_dump($query);
// Preuzimanje podataka kroz petlju i mysqli_fetch_assoc funkciju
while($row = mysqli_fetch_assoc($query)){
    echo "ID: " . $row['id'] . ", NAME: " . $row['name'] . "<br>";
}
// Preuzimanje broja redova
$rows = mysqli_num_rows($query);
echo "Number of rows: " . $rows . "<br>";
// Ubacivanje u bazu podataka
$insert_query = mysqli_query($connection, 
"INSERT INTO php_tabela (id, name) VALUES (4, 'Ništa')");
if($insert_query){
    echo "User inserted!";
}else{
    echo "User not inserted!";
}
// Posljednji unijeti ID za ovu konekciju (trenuno 0, jer nemamo auto increment)
echo mysqli_insert_id($connection);

