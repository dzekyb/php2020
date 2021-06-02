<?php

if(isset($_GET['author'])){
    $author = $_GET['author'];
    $format = $_GET['format'];
    $limit = $_GET['limit'];

    $pdo = new PDO("mysql:host=localhost;dbname=servis;charset=utf8", "phproot", "phproot2021!");

    $query = "SELECT * FROM novosti WHERE author = " . $author . " AND status='1' LIMIT " . $limit;

    $result = $pdo->query($query);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);

    if($format == 'json'){
        header('Content-type: application/json');
        $json = json_encode($result);
        print_r($json);
    }else{
        header('Content-type: text/xml');
        echo "<posts>";
            foreach($result as $post){
                echo "<post>";
                    foreach($post as $k => $v){
                        echo "<" . $k . ">";
                        echo $v;
                        echo "</" . $k . ">";
                    }
                echo "</post>";
            }
        echo "</posts>";
    }


}