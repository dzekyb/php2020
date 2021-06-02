<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }

    if(isset($_GET['id'])) {
        require_once('autoloader.php');
        $id = $_GET['id'];
        Validate::validateString('id', $id);
        if(Message::getError()) {
            header('Location: ../index');
            exit();
        }
        $id = Sanitize::sanitizeString($id);
        $firm = Firm::findById($id);
        echo json_encode($firm);
        exit();
    } else {
        header('Location: ../index');
        exit();
    }
?>