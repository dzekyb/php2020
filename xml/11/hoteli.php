<?php

$dom = new DOMDocument();
$dom->load("hoteli.xml");

// Preuzimanje svih hotela u varijablu $hoteli
$hoteli = $dom->getElementsByTagName("hotel");
// Prolazak kroz svaki hotel
foreach($hoteli as $hotel){
    // Ulazak u hotel pojedinačno i preuzimanje njegovih stavki
    $stavke = $hotel->getElementsByTagName("*");
    // Prolazak kroz svaku od stavki
    foreach($stavke as $stavka){
        // Ispis vrijednosti
        echo $stavka->nodeValue . "<br>";
    }
    echo "<hr>";
}