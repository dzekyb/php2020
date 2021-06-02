<?php

    // validate and sanitize user input and add firm to table Firma
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
 
    require_once('autoloader.php');

    if(isset($_POST['submit'])) {
        $args['ime'] = $_POST['ime'];
        $args['logo'] = 'logo';
        $args['jib'] = $_POST['jib'];
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
        $args['pdv'] = $_POST['pdv'];
        Validate::validateNumber('pdv', $args['pdv']);

        $args['email'] = $_POST['email'];
        if(!empty($args['email'])){
            Validate::validateEmail($args['email']);
        }

        Validate::validateFile($args['logo'], 'logo');
        $error = Message::getError();

        if($error) {
            echo json_encode($error);
            exit();
        }
        $firm = new Firm($args);
        $firm->save();
        $error = Message::getError();
        if(!$error) {
            $error['success'] = $firm->getId();
            $error['ime'] = $firm->ime;
        }
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../index');
        exit();
    }
?>