<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }

    if(isset($_POST['submit'])) {
        require_once('autoloader.php');
        $id = $_POST['id'];
        Validate::validateString('id', $id);
        if(Message::getError()) {
            header('Location: ../index');
            exit();
        }
        $id = Sanitize::sanitizeString($id);
        $bills = Bill::findAllByQuery('firmaId', $id);
        echo json_encode($bills);
        exit();
    } else {
        header('Location: ../index');
        exit();
    }
?>