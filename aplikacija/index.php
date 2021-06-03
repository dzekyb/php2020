<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">

        <?php
            if(isset($_SESSION['id']) && isset($_SESSION['ime']) && isset($_SESSION['prezime']) && isset($_SESSION['status'])){
                require 'dashboard.php';
            }else{
                ?>
                <div class="container">
                <form action="login.php" method="POST">
                    <label for="email">Unesite svoj email:</label>
                    <input type="email" name="email" required>
                    <br>
                    <label for="password">Unesite svoj password:</label>
                    <input type="password" name="password" required>
                    <br>
                    <input type="submit" value="Loguj se">

                    <?php
                        if(isset($_GET['error']) && !empty($_GET['error'])){
                            echo "<span class='error'>";
                            echo $_GET['error'];
                            echo "</span>";
                        }
                    ?>
                </form>
            </div>
            <?php
            }
            ?>
    </div>
</body>
</html>