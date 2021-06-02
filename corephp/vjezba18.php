<?php
// Primjer 1
for($x = 1; $x <= 10; $x++){
    if($x<10){
        echo $x;
        echo "-";
    }else{
        echo $x;
    }
}
echo "<br><br>";
// Primjer 2
for($i = 0; $i < 10; $i++){
    echo "A";
}
echo "<br><br>";
// Primjer 3
for($i = 0; $i < 100; $i+=4){
    echo $i . " ";
}
echo "<br><br>";
// Primjer 4
for($i = 1; $i <= 100; $i++){
    echo $i * $i . " ";
//  echo pow($i, 2);
}
echo "<br><br>";
// Primjer 5
$dani = 31;
$mjeseci = 12;
$pocetna_godina = 1920;
$krajnja_godina = date('Y');

echo "<select name='dan'>";
for($i = 1; $i <= 31; $i++){
    echo "<option value='" . $i . "'>" . $i . "</option>";
}
echo "</select>";

echo "<select name='mjesec'>";
for($i = 1; $i <= 12; $i++){
    echo "<option value='" . $i . "'>" . $i . "<option>";
}
echo "</select>";

echo "<select name='godina'>";
for($i = $pocetna_godina; $i <= $krajnja_godina; $i++){
    echo "<option value='" . $i . "'>" . $i . "<option>";
}
echo "</select>";

// Obrnuta varijanta posljednjeg selecta:
// echo "<select name='godina'>";
// for($i = $krajnja_godina; $i >= $pocetna_godina; $i--){
//     echo "<option value='" . $i . "'>" . $i . "<option>";
// }
// echo "</select>";
echo "<br><br>";
// Primjer 6
$dan = date('d');
echo "<table>";
for($i = 1; $i <= 31; $i++){

    if($i == $dan){
        $style = "style='color:red;'";
    }else{
        $style = "";
    }

    if($i % 7 == 1){
        echo "<tr>";
        echo "<td $style>" . $i . "</td>";
    }else if($i % 7 == 0){
        echo "<td $style>" . $i . "</td>";
        echo "</tr>";
    }else{
        echo "<td $style>" . $i . "</td>";
    }
}
echo "</table>";
echo "<br><br>";
// Primjer 7
?>
<form action="" method="GET">
    <label for="number1">Insert first number: </label>
    <input type="text" name="number1">
    <br>
    <label for="number2">Insert second number: </label>
    <input type="text" name="number2">
    <br>
    <input type="submit" value="Send numbers">
</form>
<?php
    if(isset($_GET['number1']) && isset($_GET['number2'])){
        if(!empty($_GET['number1']) && !empty($_GET['number2'])){
            $number1 = $_GET['number1'];
            $number2 = $_GET['number2'];
            $sum = 0;

            for($i = $number1; $i <= $number2; $i++){
                $sum += $i;
            }

            echo "<h1>Final sum is: " . $sum . "</h1>";

        }
    }
    echo "<br><br>";
    // Primjer 8
    $number = 5;
    while($number >= 1){
        echo $number . " ";
        $number--;
    }
    echo "<br><br>";
    // Primjer 9
    $number = 5;
    do{
        echo "Number is bigger than 5!";
        $number--;
    }while($number>5);
    echo "<br><br>";
    // Primjer 10
    $number = 30;
    while($number > 5){
        if($number == 7){
            break;
        }
        if($number % 2){
            $number--;
            continue;
        }

        if($number == 24){
            $number--;
            continue;
        }

        echo $number . " ";
        $number--;
    }
    echo "<br><br>";
    // Primjer 11
    $a1 = mt_rand(0, 100);
    $a2 = mt_rand(0, 100);
    $a3 = mt_rand(0, 100);
    $a4 = mt_rand(0, 100);
    $a5 = mt_rand(0, 100);
    $a6 = mt_rand(0, 100);
    $b1 = "January";
    $b2 = "February";
    $b3 = "March";
    $b4 = "April";
    $b5 = "May";
    $b6 = "June";

    $iteracija = 0;
    $mjesec = 0;
    for($i = 0; $i < 6; $i++){
        switch($i){
            case 0:
                $iteracija = $a1;
                $mjesec = $b1;
            break;
            case 1:
                $iteracija = $a2;
                $mjesec = $b2;
            break;
            case 2:
                $iteracija = $a3;
                $mjesec = $b3;
            break;
            case 3:
                $iteracija = $a4;
                $mjesec = $b4;
            break;
            case 4:
                $iteracija = $a5;
                $mjesec = $b5;
            break;
            case 5:
                $iteracija = $a6;
                $mjesec = $b6;
            break;
            default:
                $iteracija = $a1;
                $mjesec = $b1;
            break;
        }
        echo $mjesec . " ";

        for($j = 0; $j < $iteracija; $j++){
            if($iteracija < 50){
                echo "<span style='background-color: red; width: 8px; height: 8px; margin-right: 3px; display: inline-block;'></span>";
            }else if($iteracija >= 50 && $iteracija < 90){
                echo "<span style='background-color: orange; width: 8px; height: 8px; margin-right: 3px; display: inline-block;'></span>";
            }else{
                echo "<span style='background-color: green; width: 8px; height: 8px; margin-right: 3px; display: inline-block;'></span>";
            }
        }

        echo "<br>";
    }

    //echo ${'b'. $i};
    echo "<br><br>";
    // Primjer 12
    $niz = array("prvi" => "Januar", "drugi" => "Februar", "Mart", "April", "Maj", "Juni");
    foreach($niz as $kljuc => $mjesec){
        echo $kljuc . ":" . $mjesec . " ";
    }
    echo "<br><br>";
    // Primjer 13
    $brojeviX = array(1, 13, 27, 58, 47, 89, 68);
    foreach($brojeviX as &$brojX){
        $brojX = $brojX + 1;
        echo $brojX . " ";
        echo "<br>";
    }
    foreach($brojeviX as $brojX){
        echo $brojX . " ";
    }
    var_dump($brojeviX);