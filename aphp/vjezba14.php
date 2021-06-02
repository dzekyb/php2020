<?php
    if(isset($_POST['num1']) && !empty($_POST['num1'])){
        if(isset($_POST['num2']) && !empty($_POST['num2'])){
            if(isset($_POST['operator']) && !empty($_POST['operator'])){
                $numOne = (int) $_POST['num1'];
                $numTwo = (int) $_POST['num2'];
                $operator = $_POST['operator'];

                switch($operator){
                    case "+":
                    $result = $numOne + $numTwo;
                    break;
                    case "-":
                    $result = $numOne - $numTwo;
                    break;
                    case "*":
                    if($numOne != 0 && $numTwo != 0){
                        $result = $numOne * $numTwo;
                    }else{
                        $result = "Error2: Numbers can't be 0 when multiplying";
                    }
                    break;
                    case "/":
                    if($numOne != 0 && $numTwo != 0){
                        $result = $numOne / $numTwo;
                    }else{
                        $result = "Error3: Numbers can't be 0 when dividing";
                    }
                    break;
                    default:
                    $result = "Error1: Wrong operation!";
                }
            }else{
                $result = "Error4: Operator can't be empty!";
            }
        }else{
            $result = "Error5: Num2 can't be empty!";
        }
    }else{
        $result = "Error6: Num1 can't be empty!";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kalkulator</title>
</head>
<body>
    <form action="" method="POST">
        <label for="num1">First number:</label>
        <input type="number" name="num1" value="">
        <br>
        <select name="operator">
            <option value="" disabled selected>Choose your operation</option>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <br>
        <label for="num2">Second number:</label>
        <input type="number" name="num2" value="">
        <br>
        <input type="submit" value="Calculate">
    </form>

    <h2> <?=$result;?> </h2>
</body>
</html>


