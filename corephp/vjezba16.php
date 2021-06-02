<?php
    $user_status = mt_rand(1,4);

    //$message = ($user_status <= 3) ? "Welcome User" : "Welcome Admin";
    //echo $message;

    //Primjer zašto ternarni operator ne treba koristiti za provjeru više uslova od true i false
    $message = ($user_status <= 3) ? (($user_status == 1) ? "Echo User1" : (($user_status == 2) ? "Echo User2" : "Echo User3")) : "Echo Admin";
    echo $message;

    # Ternarni operator - Samo kad je true ili false
    # IF ili IF-ELSE - Neki jednostavni upiti (isset, !empty)
    # SWITCH - Sve komplikovanije od navedenog
?>