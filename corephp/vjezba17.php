<?php
    $current_temperature = mt_rand(-20, 50);
    $rain = mt_rand(0,1);
    $mud = mt_rand(0,1);
    $snow = mt_rand(0,1);
    $temperature_message = "Very Cold.";
    $snow_message = "Not Snow Outside.";
    $rain_message = "Not Rain Outside.";
    $mud_message = "Not Mud Outside.";


    switch($current_temperature){
        case $current_temperature >= -20 && $current_temperature < 0:
            $temperature_message = "Very Cold";

            if($snow){
                $snow_message = "Snow Outside";
            }else{
                $snow_message = "Not Snow Outside";
                if($rain){
                    $rain_message = "Rain Outside";
                    if($mud){
                        $mud_message = "Mud Outside";
                    }else{
                        $mud_message = "Not Mud Outside";
                    }
                }else{
                    $rain_message = "Not Rain Outside";
                }
            }
        echo "It is " . $temperature_message . ".";
        echo "It is " . $snow_message . ".";
        echo "It is " . $rain_message . ".";
        echo "It is " . $mud_message . ".";
        break;
        case $current_temperature >= 0 && $current_temperature < 20:
            $temperature_message = "Good Temperature";
            if($rain){
                $rain_message = "Rain Outside";
                if($mud){
                    $mud_message = "Mud Outside";
                }else{
                    $mud_message = "Not Mud Outside";
                }
            }else{
                $rain_message = "Not Rain Outside";
            }
        echo "It is " . $temperature_message . ".";
        echo "It is " . $rain_message . ".";
        echo "It is " . $mud_message . ".";
        break;
        case $current_temperature >= 20 && $current_temperature < 35:
            $temperature_message = "Hot";
            if($rain){
                $rain_message = "Rain Outside";
            }else{
                $rain_message = "Not Rain Outside";
            }
        echo "It is " . $temperature_message . ".";
        echo "It is " . $rain_message . ".";
        break;
        case $current_temperature >= 35:
            $temperature_message = "Very Hot";
            echo "It is " . $temperature_message . ".";
        break;
        default:
            $temperature_message = "No information!";
        break;
    }



?>