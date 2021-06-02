<?php

// Učitavanje iz fajla mobiteli.xml kroz file_get_contents
$mobiteliTekst = file_get_contents("mobiteli.xml");
// Učitani fajl je sada string i možemo instancirati klasu
$mobiteliXml = new SimpleXMLElement($mobiteliTekst);
// Pristup svim mobitelima
foreach($mobiteliXml as $mobitel){
    echo $mobitel . "<br>";
}

echo "<hr><hr>";

// Učitavanje i direktno kreiranje objekta
$mobiteliXMLNovi = simplexml_load_file("mobiteli.xml");
// Pristup svim mobitelima
foreach($mobiteliXMLNovi as $mobitel){
    echo $mobitel . "<br>";
}

echo "<hr><hr>";
// Učitavanje stringa i direktno kreiranje objekta
// Radi isto što i "new SimpleXMLElement($string)"
$mobiteliString = file_get_contents("mobiteli.xml");
$mobiteliXMLString = simplexml_load_string($mobiteliString);
// Pristup svim mobitelima
foreach($mobiteliXMLString as $mobitel){
    echo $mobitel . "<br>";
}

echo "<hr><hr><hr>";

// Učitavanje knjiga
$knjigeString = file_get_contents("knjige.xml");
// Instanciranje klase
$knjigeXml = new SimpleXMLElement($knjigeString);
// Kako pristupiti autoru prve knjige?
echo $knjigeXml->knjiga[0]->autor;
echo "<br>";
// Kako pristupiti naslovu druge knjige?
echo $knjigeXml->knjiga[1]->naslov;
echo "<hr>";
// Kako pristupiti svemu kroz petlje?
foreach($knjigeXml as $knjige){
    echo $knjige->naslov . "<br>";
    echo $knjige->autor . "<br>";
    echo "<br>";
}
// Kako pristupiti svemu kroz for petlju 
echo "<hr>";
for($i = 0; $i < sizeof($knjigeXml->knjiga); $i++){
    echo $knjigeXml->knjiga[$i]->naslov . "<br>";
    echo $knjigeXml->knjiga[$i]->autor . "<br>";
    echo "<br>";
}

echo "<hr><hr><hr>";
// Učitavanje automobila
$automobiliString = file_get_contents("automobili.xml");
// Instanciranje Simple XML objekta
$automobiliXml = new SimpleXMLElement($automobiliString);
// Pristupanje automobilu 
foreach($automobiliXml as $automobil){
    // Ispis prva tri elementa direktno u automobil elementu
    echo "Proizvođač: " . $automobil->proizvodac . "<br>";
    echo "Model: " . $automobil->model . "<br>";
    echo "Cijena: " . $automobil->cijena . "<br>";
    foreach($automobil->specifikacija as $specifikacija){
        echo "Tip: " . $specifikacija->tip . "<br>";
        echo "Gorivo: " . $specifikacija->gorivo . "<br>";
        echo "Godina: " . $specifikacija->godina . "<br>";
        //echo "Potrošnja: " . $specifikacija->potrosnja . "<br>";
        foreach($specifikacija->potrosnja as $potrosnja){
            echo "Gradska potrošnja: " . $potrosnja->gradska . "<br>";
            echo "Otvorena potrošnja: " . $potrosnja->otvorena . "<br>";
        }
    }
    echo "<br>";
}
