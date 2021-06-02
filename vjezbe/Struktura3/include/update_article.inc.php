<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
    if(isset($_POST['submit'])) {
        require_once('autoloader.php');
        foreach($_POST as $key => $value) {
            if(strpos($key, 'idArtikla')) {
                $args['id'] = explode('-', $key)[0];
                $args['idArtikla'] = $value;
                Validate::validateString($key, $args['id']);
                Validate::validateString($key, $args['idArtikla']);
                $args['id'] = Sanitize::sanitizeString($args['id']);
                $args['idArtikla'] = Sanitize::sanitizeString($args['idArtikla']);
                break;
            }
        }
        $args['firmaId'] = '';
        $args['ime'] = $_POST['ime'];
        Validate::validateString('ime', $args['ime']);
        $args['ime'] = Sanitize::sanitizeString($args['ime']);
        $args['cijena'] = $_POST['cijena'];
        Validate::validateNumber('cijena', $args['cijena']);
        $args['cijena'] = Sanitize::sanitizeString($args['cijena']);

        $args['opis'] = $_POST['opis'] ?? '';
        if($args['opis']) {
            Validate::validateString('opis', $args['opis']);
            $args['opis'] = Sanitize::sanitizeString($args['opis']);
        }
        $args['userId'] = $_SESSION['id'];
        $error = Message::getError();
        if($error) {
            echo json_encode($error);
            exit();
        }
        $article = new Article($args);
        $article->save();
        echo json_encode(Message::getError());
        exit();
    } else {
        header('Location: ../index');
        exit();
}