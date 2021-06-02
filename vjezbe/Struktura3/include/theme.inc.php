<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
   if(isset($_COOKIE['theme'])) {
        setcookie('theme', '',  time() - 3600, '/');
        echo json_encode($cookie['theme'] = 'no');
    } else {
     setcookie('theme', 'dark', time() + 86400 , '/');
     echo json_encode('');
   }
