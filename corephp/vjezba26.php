<?php
function calculator($numberOne, $numberTwo, $operator){
    if($numberOne > 0 && $numberTwo > 0){
        switch($operator){
            case '+':
                echo $numberOne + $numberTwo;
            break;
            case '-':
                echo $numberOne - $numberTwo;
            break;
            case '*':
                echo $numberOne * $numberTwo;
            break;
            case '/':
                echo $numberOne / $numberTwo;
            break;
            default:
                echo "Wrong operator";
            break;
        }
    }else{
        echo "All numbers must be over zero.";
    } 
}

calculator(75, 5, "-");
?>