<?php

$xml = <<<XML
    <izdanja>
        <knjiga id="01">
            <naslov>Madam Bovary</naslov>
            <autor>Flaubert</autor>
        </knjiga>
        <knjiga id="02">
            <naslov>Zločin i kazna</naslov>
            <autor>Dostojevski</autor>
        </knjiga>
    </izdanja>
XML;

// Instanciranje i učitavanje
$dom = new DOMDocument();
$dom->loadXML($xml);

// Čitanje svih knjiga
$knjige = $dom->getElementsByTagName("knjiga");
// Prolazak kroz svaku od knjiga
foreach($knjige as $knjiga){
    // Ispis atributa
    echo $knjiga->getAttribute("id");
    // Uzimanje stavki od svake knjige
    $stavke = $knjiga->childNodes;
    // Prolazak kroz svaku od stavki
    foreach($stavke as $stavka){
        echo $stavka->nodeValue . "<br>";
    }
    // Izlazak iz knjige
    echo "<hr>";
}