<?php
// Rad sa indeksima (indeksirani niz, jer indeksi - brojevi)
$boje = array("crveni", "zeleni", "bijele", "plavo");


$recenica = "Danas sam prolazio kroz Sarajevo. Bilo je zaista prelijepo. Vidio sam " . $boje[0] . " tepih, " . $boje[1] . " park, lijepe, " . $boje[2] . " golubove i zaista " . $boje[3] . " nebo.";

echo $recenica;

echo "<br><br>";

// Rad sa ključevima (asocijativni niz, jer ključevi su asocijacije - tekst)
$bojeNove = array("prvi"=>"crveni", "drugi"=>"zeleni", "treci"=>"bijele", "cetvrti"=>"plavo");

$recenicaNova = "Danas sam prolazio kroz Sarajevo. Bilo je zaista prelijepo. Vidio sam " . $bojeNove["prvi"] . " tepih, " . $bojeNove["drugi"] . " park, lijepe, " . $bojeNove["treci"] . " golubove i zaista " . $bojeNove["cetvrti"] . " nebo.";

echo $recenicaNova;





//MVC - Model View Controller