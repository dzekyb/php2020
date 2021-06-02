<?php 
    require('autoloader.php');

    if(isset($_POST['submit'])) {

        $username = Sanitize::sanitizeString($_POST['username']);
        $email = Sanitize::sanitizeString($_POST['email']);
        $password = Sanitize::sanitizeString($_POST['password']);
        $confirmPassword = Sanitize::sanitizeString($_POST['confirmPassword']);
        
        Validate::validateUsername($username);
        Validate::validateEmail($email);
        Validate::passwordMatch($password, $confirmPassword);

        $error = Message::getError();

        if($error) {
            echo json_encode($error);
            exit();
        }
        
        $user = User::findByEmail($email);

        if($user) {
            Message::addError('email', 'Email already in use');
            echo json_encode(Message::getError());
            exit();
        }

        if(!$error){
            $user = new User($username, $email, $password);
            $user->save();
            $error = Message::getError();
        }
        echo json_encode($error);
        exit();
     } else {
        header('Location: ../register');
        exit();
     }
?>