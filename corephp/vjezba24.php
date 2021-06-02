<?php

// Functions with multiple paramters
function undefinedArguments(){

    for($i = 0; $i < func_num_args(); $i++){
        echo func_get_arg($i) . "<br>";
    }
}

undefinedArguments(4, 2, 13, 24, 78, "treci", 12.3);

function setUser(){
    //0 - Ime, 1 - Prezime, 2 - Datum rođenja, 3 - Spol
    $paramNum = func_num_args();
    if($paramNum > 4){
        return "Too many parameters!";
    }
    $user = array();
    switch($paramNum){
        case 1:
            $user['name'] = func_get_arg(0);
        break;
        case 2:
            $user['name'] = func_get_arg(0);
            $user['lastname'] = func_get_arg(1);
        break;
        case 3:
            $user['name'] = func_get_arg(0);
            $user['lastname'] = func_get_arg(1);
            $user['date'] = func_get_arg(2);
        break;
        case 4:
            $user['name'] = func_get_arg(0);
            $user['lastname'] = func_get_arg(1);
            $user['date'] = func_get_arg(2);
            $user['gender'] = func_get_arg(3);
        break;
        default:
            return "No parameters!";
        break;
    }

    return $user;
}

var_dump(setUser("Amar", "Bešlija", "13.03", "muški", "peti"));