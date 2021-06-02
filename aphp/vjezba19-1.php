<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>About</h1>
    <p> <?=$_SESSION['username'];?> </p>
    <a href="vjezba19.php">Idi nazad</a>
</body>
</html>