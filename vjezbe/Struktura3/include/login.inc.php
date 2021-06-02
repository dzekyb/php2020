<?php
    require_once('autoloader.php');

    if(isset($_POST['submit'])) {    
        $email = Sanitize::sanitizeString($_POST['email']);
        $password = Sanitize::sanitizeString($_POST['password']);
        $user = User::login($email, $password);
        $error = Message::getError();
        if(!$error) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
        }
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../login');
        exit();
    }
?>