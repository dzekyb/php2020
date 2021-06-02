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
            echo json_encode($error);
            exit();
        }
        $articleArguments = InvoiceArticle::findById($id);
        $invoice = Invoice::findById($articleArguments['fakturaId']);

        if($invoice['userId'] != $_SESSION['id']) {
            echo json_encode(array('error'=> 'Nemate odoborenje za ovu radnju'));
            exit();
        }
        $article = new InvoiceArticle($articleArguments);
        $article->delete();
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../index');
        exit();
}