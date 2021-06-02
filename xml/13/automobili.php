<?php
$dom = new DOMDocument();
$dom->load("automobili.xml");

$auta = $dom->getElementsByTagName("automobil");
foreach($auta as $auto){
    $proizvodac = $auto->getElementsByTagName("proizvodac");
    echo $proizvodac->item(0)->nodeValue . "<br>";
    //model
    //cijena
    

}