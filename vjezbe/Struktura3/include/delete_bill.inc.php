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
        $id = Sanitize::sanitizeString($id);
        $error = Message::getError();
        if($error) {
            header('Location: ../articles/' . $firmId);
            exit();
        }
        $billArguments = Bill::findById($id);
        $isBillInInvoice = Invoice::findAllByQuery('fiskalni', $id);
        if($billArguments['userId'] != $_SESSION['id'] || !empty($isBillInInvoice)) {
            header('Location: ../bills');
            exit();
        } 
        $bill = new Bill($billArguments);
        $bill->delete();
        if($bill->slika) {
            unlink('../images/' . $bill->slika);
        }
        header('Location: ../bills');
        exit();
    } else {
        header('Location: ../index');
        exit();
}