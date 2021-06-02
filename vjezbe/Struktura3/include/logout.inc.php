<?php
    session_start();
    session_unset();
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    header('Location: ../index');
?>