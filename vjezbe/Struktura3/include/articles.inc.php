<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
 
    require_once('autoloader.php');

    if(isset($_POST['submit'])) {

        $args['firmaId'] = $_POST['firma'];
        $args['idArtikla'] = $_POST['idArtikla'];
        $args['ime'] = $_POST['ime'];
        $args['cijena'] = $_POST['cijena'];
        $args['userId'] = $_SESSION['id'];

        Validate::validateNumber('firma', $args['firmaId']);
        $args['firmaId'] = Sanitize::sanitizeString($args['firmaId']);

        Validate::validateString('idArtikla', $args['idArtikla']);
        $args['idArtikla'] = Sanitize::sanitizeString($args['idArtikla']);

        Validate::validateString('ime', $args['ime']);
        $args['ime'] = Sanitize::sanitizeString($args['ime']);

        Validate::validateNumber('cijena', $args['cijena']);
        $args['cijena'] = Sanitize::sanitizeString($args['cijena']);

        $args['opis'] = $_POST['opis'];
        if($args['opis']) {
            Validate::validateString('opis', $args['opis']);
            $args['opis'] = Sanitize::sanitizeString($args['opis']);
        }

        $error = Message::getError();

        if($error) {
            echo json_encode($error);
            exit();
        }
        $article = new Article($args);
        $article->save();
        $error = Message::getError(); 
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../index');
        exit();
    }
?>