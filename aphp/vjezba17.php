<?php

    if(isset($_POST['name']) && !empty($_POST['name'])){
        if(isset($_POST['lastname']) && !empty($_POST['lastname'])){

            $name = (string) $_POST['name'];
            $lastname = (string) $_POST['lastname'];

            setcookie("name", $name, time() + (60 * 60 * 24 * 356), "/");
            setcookie("lastname", $lastname, time() + (60 * 60 * 24 * 365), "/");

        }else{
            $result = "Error 2: Your lastname is empty!";
        }
    }else{
        $result = "Error 1: Your name is empty!";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cookies</title>
</head>
<body>
    <h1> 
        <?php
            if(isset($_COOKIE['name']) && isset($_COOKIE['lastname'])){
                echo "Hello, " . $_COOKIE['name'] . " " . $_COOKIE['lastname'];
            }else{
                if(empty($result)){
                    header('Refresh:0');
                }
            }

        ?>
    </h1>


    <form action="" method="POST">
        <label for="name">Insert your name:</label>
        <input type="text" name="name">
        <br>
        <label for="lastname">Insert your lastname:</label>
        <input type="text" name="lastname">
        <br>
        <input type="submit" value="Send your data...">
    </form>

    <h2>
    <?php
    if(!empty($result)){
        echo $result;
    }
    ?>
    </h2>
</body>
</html>
