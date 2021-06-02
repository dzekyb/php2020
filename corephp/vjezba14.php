<?php
    $product_one = "TV";
    $product_two = "iPhone";
    $product_three = "Laptop";

    $product_price_one = mt_rand(500, 3000);
    $product_price_two = mt_rand(1000, 2500);
    $product_price_three = mt_rand(1000, 10000);

    if($product_price_one > 500 && $product_price_one < 1000){
        $product_message_one = "Low";
    }else if($product_price_one >= 1000 && $product_price_one < 2000){
        $product_message_one = "Okay";
    }else{
        $product_message_one = "High";
    }

    if($product_price_two > 1000 && $product_price_two < 1500){
        $product_message_two = "Low";
    }else if($product_price_two >= 1500 && $product_price_two < 2000){
        $product_message_two = "Okay";
    }else{
        $product_message_two = "High";
    }

    if($product_price_three > 1000 && $product_price_three < 3000){
        $product_message_three = "Low";
    }else if($product_price_three >= 3000 && $product_price_three < 6000){
        $product_message_three = "Okay";
    }else{
        $product_message_three = "High";
    }

    echo $product_one . "<br>";
    echo "The price is " . $product_message_one . "<br>";
    echo "Price: " . $product_price_one;
    echo "<br>";

    echo $product_two . "<br>";
    echo "The price is " . $product_message_two . "<br>";
    echo "Price: " . $product_price_two;
    echo "<br>";

    echo $product_three . "<br>";
    echo "The price is " . $product_message_three . "<br>";
    echo "Price: " . $product_price_three;
    echo "<br>";
?>

