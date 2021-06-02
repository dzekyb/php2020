<?php
// Konekcija na bazu
include "connection.php";
$db = new db();
$connection = $db->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];

switch($request_method){
    case "GET":
        if(!empty($_GET['id'])){
            $id = intval($_GET['id']);
            get_employees($id);
        }else{
            get_employees();
        }
    break;
    case "POST":
        insert_employee();
    break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
    break;
}

function get_employees($id = 0){
    global $connection;
    $query = "SELECT * FROM zaposleni";

    if($id != 0){
        $query .= " WHERE id=" . $id . " LIMIT 1";
    }

    $response = array();
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)){
        $response[] = $row;
    }
    header("Content-type: application/json");
    echo json_encode($response);
}

function insert_employee(){
    global $connection;
    $data = json_decode(file_get_contents("php://input"), true);
    $employee_name = $data['ime'];
    $employee_salary = $data['plata'];
    $employee_age = $data['godine'];

    $query = "INSERT INTO zaposleni (ime, plata, godine) VALUES (" . $employee_name . ", " . $employee_salary . ", " . $employee_age . ")";

    if(mysqli_query($connection, $query)){
        $response = array(
            "status" => "1",
            "status_message" => "Employee Added Successfully"
        );
    }else{
        $response = array(
            "status" => "0",
            "status_message" => "Employee Addition Failed"
        );
    }
    header("Content-type: application/json");
    echo json_encode($response);
}