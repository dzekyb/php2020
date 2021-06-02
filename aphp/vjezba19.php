<?php
    $username = 'amarbeslija';
    $password = '12345678';
    if(isset($_POST['username']) && !empty($_POST['username'])){
        if(isset($_POST['password']) && !empty($_POST['password'])){
            #Trenutak kada biste otišli u bazu i dobavili podatke
            if($username === $_POST['username'] &&
               $password === $_POST['password']){
                   #Otvaramo sesiju
                   session_start();
                   $_SESSION['username'] = $username;
                   $_SESSION['id'] = '25';
               }
        }
    }

?>
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
        if(!isset($_SESSION['id']) && empty($_SESSION['id'])){
            ?>
            <form action="#" method="POST">
                <label for="username">
                    Username:
                    <input type="text" name="username">
                </label>
                <br>
                <label for="password">
                    Password:
                    <input type="password" name="password">
                </label>
                <br>
                <input type="submit" value="Login">
            </form>
            <?php
        }else{
            ?>
            <div>
                <ul>
                    <li> <?=$_SESSION['id'];?> </li>
                    <li> <?=$_SESSION['username'];?> </li>
                    <li> <a href="vjezba19-1.php">Idi dalje</a> </li>
                </ul>
            </div>
            <?php
        }
        ?>
</body>
</html>