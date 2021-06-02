<?php // connecting to database 


    $serverName = 'localhost';
    $port = 3306;
    $userName = 'phproot';
    $password = 'phproot2021!';
    $db = 'logotip';

    $conn = new mysqli($serverName . ':' . $port, $userName, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        header('Location: index');
        exit();
    }
?>