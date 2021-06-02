<?php
if(isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['lastname']) && !empty($_POST['lastname'])){
    
    $host = "localhost";
    $username = "phproot";
    $password = "phproot2021!";
    $database = "ajax";

    $connection = new mysqli($host, $username, $password, $database);

    if($connection->connect_error){
        echo "Connection failed";
        return;
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
$query = "INSERT INTO user (firstname, lastname) VALUES ('{$firstname}', '{$lastname}')";
    
    if($connection->query($query) === TRUE){
        echo "User inserted!";
    }else{
        echo "Error: " . $connection->error;
    }

    $connection->close();
}else{
    echo "Please send first name and last name!";
}