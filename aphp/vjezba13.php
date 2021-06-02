<?php
class Database{
    public $hostname;
    public $username;
    public $password;
    public $database;
    public $connection;


    public function __construct(){
        $this->hostname = "localhost";
        $this->username = "phproot";
        $this->password = "phproot2021!";
        $this->database = "app";
    
        $this->connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    }

    public function insert($table, $keys, $values){
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        if($this->connection->query($sql)){
            echo "Ubačeno";
        }else{
            echo $this->connection->error;
            echo $sql;
        }
    }

    public function select($table){
        $sql = "SELECT * FROM {$table}";
        $results = $this->connection->query($sql);

        $returnArray = array();
        if($results->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $returnArray[] = $row;
            }
        }

        return $returnArray;
    }

    public function update($table, $column, $value, $where){
        $sql = "UPDATE $table SET $column=$value WHERE $where";
        $this->connection->query($sql);
    }

    public function delete($table, $where){
        $sql = "DELETE FROM $table WHERE $where";
        $this->connection->query($sql);
    }
}

$db = new Database();
$db->insert('user', 'name,lastname,username,password,phone,email,status', "'test4','test4', 'test4', 'test4', '+3876287178327', 'test4@test.com','2'");