<?php

class db{
    var $servername = "localhost";
    var $username = "phproot";
    var $password = "phproot2021!";
    var $dbname = "servis";
    var $connection;

    public function getConnection(){
        $con = mysqli_connect(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        ) or die("Connection failed: " . mysqli_connect_error());

        if(mysqli_connect_errno()){
            print_f("Connection failed: ", mysqli_connect_error());
        }else{
            $this->connection = $con;
        }
        return $this->connection;
    }
}