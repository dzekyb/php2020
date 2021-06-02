<?php

try{
    // PDO konekcija
    $connection = new PDO("mysql:host=localhost;port=3306;dbname=app", 'phproot', 'phproot2021!');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    // Upis u bazu podataka (prepared)
    $sql = $connection->prepare("INSERT INTO user (name, lastname, username, password, email, phone, status) VALUES (:name, :lastname, :username, :password, :email, :phone, :status)");

    $name = 'Test3';
    $lastname = 'Testović3';
    $username = 'test3';
    $password = 'Testmetestme!';
    $email = 'testmenow@test.com';
    $phone = '+38761225883';
    $status = '3';

    
    $sql->bindParam(':name', $name);
    $sql->bindParam(':lastname', $lastname);
    $sql->bindParam(':username', $username);
    $sql->bindParam(':password', $password);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':phone', $phone);
    $sql->bindParam(':status', $status);

    $sql->execute();
    echo "Unešeno";
}catch(PDOException $e){
    echo "Greška: " . $e->getMessage();
}
