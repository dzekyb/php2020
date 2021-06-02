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
        $invoiceArgs = Invoice::findById($id);
        if($invoiceArgs['userId'] != $_SESSION['id']) {
            header('Location: ../firms');
            exit();
        }
        $invoiceArticleArgs = InvoiceArticle::findAllByQuery('fakturaId', $id);
        foreach($invoiceArticleArgs as $args) {
            $invoiceArticle = new InvoiceArticle($args);
            $invoiceArticle->delete();
        }
        $invoice = new Invoice($invoiceArgs);
        $invoice->delete();
        header('Location: ../invoices');
        exit();
    } else {
        header('Location: ../index');
        exit();
}