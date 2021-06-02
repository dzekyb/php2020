<?php

    // validate and sanitize user input and add client to table klijent
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
 
    require_once('autoloader.php');

    if(isset($_POST['submit'])) {
        $args['ime'] = $_POST['ime'];
        $args['jib'] = $_POST['jib'];
        $args['pdv'] = $_POST['pdv'];
        $args['pib'] = $_POST['pib'] ?? '';
        $args['vlasnik'] = $_POST['vlasnik'];
        $args['adresa'] = $_POST['adresa'];
        $args['mjesto'] = $_POST['mjesto'];
        $args['telefon'] = $_POST['telefon'];
        $args['racun'] = $_POST['racun'];
        $args['banka'] = $_POST['banka'];
        $args['userId'] = $_SESSION['id']; 

        foreach($args as $key => $value) {
            if(!empty($value) || $key == 'ime') {
                Validate::validateString($key, $args[$key]);
                $args[$key] = Sanitize::sanitizeString($value);
            } 
        }

        $args['email'] = $_POST['email'];
        if($args['email']) {
            Validate::validateEmail($args['email']);
        }

        $args['logo'] = 'logo';
        Validate::validateFile($args['logo'], 'logo');
        $error = Message::getError();

        if($error) {
            echo json_encode($error);
            exit();
        }
        $client = new Client($args);
        $client->save();
        $error = Message::getError();
        if(!$error){
            $error['success'] = $client->getId();
            $error['ime'] = $client->ime;
        }
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../index');
        exit();
    }
?>