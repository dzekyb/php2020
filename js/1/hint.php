<?php

$firstname = $_GET['firstname'];
if(isset($firstname) && !empty($firstname)){
    $names[] = "Amar";
    $names[] = "Arnela";
    $names[] = "Tarik";
    $names[] = "Amila";
    $names[] = "Hamza";
    $names[] = "Dženan";
    $names[] = "Vuk";
    $names[] = "Savo";
    $names[] = "Almir";

    $hint = "";
    
    if($firstname !== ""){
        $firstname = strtolower($firstname);
        $length = strlen($firstname);

        foreach($names as $name){
            if(stristr($firstname, substr($name, 0, $length))){
                if($hint === ""){
                    $hint = $name;
                }else{
                    $hint .= ", $name";
                }
            }
        }
    }

    echo $hint === "" ? "No suggestions!" : $hint;
}