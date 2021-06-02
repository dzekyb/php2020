<?php
class User{}
$user = new User;
$user->name = "John";
$user->lastname = "Wick";
$user->age = "45";
$user->city = "New York";

$json = json_encode($user);
echo $json;