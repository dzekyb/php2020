<?php 
    // login user out, unseting session and redirecting user to index 
    session_start();
    session_unset();
    unset($_SESSION['fullName']);
    unset($_SESSION['id']);
    header('Location: ../index');
    exit();
?>