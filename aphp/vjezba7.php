<?php

// Konekcija
$connection = new mysqli('localhost', 'phproot', 'phproot2021!');

// Prepared Statements
$sql = $connection->prepare("INSERT INTO app.user (name, lastname, username, password, email, phone, status) VALUES (?,?,?,?,?,?,?)");

$sql->bind_param('sssssss', $name, $lastname, $username, $password, $email, $phone, $status);

$name = "Test2";
$lastname = "Testović2";
$username = "Iamtest";
$password = "CanItestyou?";
$email = "test2@test.com";
$phone = "+38761111234";
$status = "3";

if($sql->execute()){
    echo "Inserted";
}else{
    echo "Not inserted";
}