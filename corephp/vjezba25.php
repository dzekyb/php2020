<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php

function formElement(
    string $type = "text", 
    string $name = "", 
    string $id = "", 
    string $value = ""
):void{
    echo "<input type='$type' name='$name' id='$id' value='$value'>";
}

function formOpen(
    string $action,
    string $method = "POST"
):void{
    echo "<form action='$action' method='$method'>";
}

function formClose():void{
    echo "</form>";
}

function formLabel(
    string $for,
    string $value
):void{
    echo "<label for='$for'>$value</label>";
}

function br():void{
    echo "<br>";
}

formOpen('form.php');
formLabel('username', 'Insert your username:');
formElement('text', 'username');
br();
formLabel('password', 'Insert your password:');
formElement('password', 'password');
br();
formLabel('password_again', 'Insert your password again:');
formElement('password', 'password_again');
br();
formElement('submit', 'submit', 'submit-final', 'Registration user');
/*
for($i=0; $i<10; $i++){
    formLabel('text'.$i, 'Input' . $i);
    formElement('text', 'text'. $i);
    br(); 
}
*/

formClose();
?>