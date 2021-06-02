<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
 
    require_once('autoloader.php');

    if(isset($_POST['submit'])) {
        foreach($_POST as $key => $value) {
            if(strpos($key, 'ime')) {
                $args['id'] =Sanitize::sanitizeString(explode('-', $key)[0]);
                Validate::validateString($key, $value);
                $args['ime'] = Sanitize::sanitizeString($value);
                break;
            }
        }
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
            if(!empty($value) && $key !== 'ime') {
                Validate::validateString($key, $args[$key]);
                $args[$key] = Sanitize::sanitizeString($value);
            }
        }
        $args['pdv'] = $_POST['pdv'];
        Validate::validateNumber('pdv', $args['pdv']);

        $args['email'] = $_POST['email'];
        if($args['email']) {
            Validate::validateEmail($args['email']);
        }

        $oldFirm = Firm::findById($args['id']);
        $args['logo'] = 'logo';
        if($oldFirm['logo']) {
            unlink('../images/' . $oldFirm['logo']);
            Validate::validateFile($args['logo'], 'logo');
        }

        
        $error = Message::getError();

        if($error) {
            echo json_encode($error);
            exit();
        }
        $firm = new Firm($args);
        $firm->save();
        $error = Message::getError();
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../index');
        exit();
    }
?>