<?php
    $current_time = date('h');
    $user_age = 25;
    $user_name = 'John';
    $user_gender = 'z';
    $time_message = 'morning';
    $user_message = "human";

    if($current_time > 0 && $current_time < 12){
        $time_message = 'morning';
    }else if($current_time >= 12 && $current_time < 18){
        $time_message = 'afternoon';
    }else{
        $time_message = 'evening';
    }

    switch($user_gender){
        case 'm':
            $user_message = (($user_age < 18) ? 'boy' : 'man');
        break;
        case 'f':
            $user_message = (($user_age < 18) ? 'girl' : 'woman');
        break;
        default: 
            $user_message = 'human';
        break;  
    }



    echo 'Good ' . $time_message . ", dear " . $user_name . " " . $user_message . "!";
?>