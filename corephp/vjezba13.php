<?php
    $username_db = "admin";
    $password_db = "123456";

    $username_form = "admin";
    $password_form = "123456";

    if(!empty($username_form) && !empty($password_form)){
        if($username_db === $username_form){
            if($password_db === $password_form){
                echo "Signed In!";
            }else{
                echo "Error: Wrong user data!";
            }        
        }else{
            echo "Error: Wrong user data!";
        }
    }else{
        echo "Error: Data is empty!";
    }
?>