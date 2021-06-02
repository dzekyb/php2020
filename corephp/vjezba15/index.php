<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

    <?php
        if(!empty($_GET['page']) && isset($_GET['page'])){
            $page = $_GET['page'];
            switch($page){
                case 'home':
                case 'about':
                case 'contact':
                case 'profile':
                case 'login':
                case 'registration':
                case 'forgotten-password':
                case 'confirm-registration':
                case 'confirm-password':
                    require $page . ".php";
                break;
                default:
                    require 'home.php';
                break;
            }
        }else{
            require 'home.php';
        }
    ?>

    <a href="index.php?page=home">Home</a>
    <a href="index.php?page=about">About</a>
    <a href="index.php?page=contact">Contact</a>
</body>
</html>