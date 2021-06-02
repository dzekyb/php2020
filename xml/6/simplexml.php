<?php

$xml = <<<XML
<xml>
    <element>
        Prva vrijednost
    </element>
    <element>
        Druga vrijednost
    </element>
    <element>
        Treća vrijednost
    </element>
</xml>
XML;

// Instanciranje Simple XML klase u novi objekat
$sxml = new SimpleXMLElement($xml);
// Pristup prvom elementu unutar objekta
echo $sxml->element[0];
// Pristup drugom elementu
echo "<br>";
echo $sxml->element[1];
// Pristup trećem elementu
echo "<br>";
echo $sxml->element[2];
// Pristup nepostojećem elementu
echo $sxml->element[3];
echo "<hr>";

// Pristup svim elementima kroz for petlju (standardnu)
echo "<ul>";
for($i = 0; $i < sizeof($sxml->element); $i++){
    echo "<li>" . $sxml->element[$i] . "</li>";
} 
echo "</ul>";

// Pristup svim elementima kroz foreach petlju (bez brojača)
echo "<hr>";
echo "<ul>";
foreach($sxml as $element){
    echo "<li>" . $element . "</li>";
}
echo "</ul>";

// Pristup svim elementima kroz foreach petlju sa brojačem
// Ista logika važi i dobavljanje i ispis podataka iz baze podataka
echo "<hr>";
echo "<ul>";
    $brojac = 0;
    foreach($sxml as $element){
        // Filtracija na osnovu eksternog brojača 
        if($brojac == 1){
            continue;
        }
        echo "<li>" . $element . "</li>";
        // Vođenje računa o brojaču kako ne bi uvijek bio 0
        $brojac++;
    }
echo "</ul>";
echo "<hr><hr>";

// Primjer sa autima
$xml2 = <<<AUTA
<xml>
    <auto>
        BMW
    </auto>
    <auto>
        Mercedes
    </auto>
    <auto>
        Audi
    </auto>
</xml>
AUTA;

//Instanciranje objekta i importovanje kroz string
$auta = new SimpleXMLElement($xml2);

// Ispis prvog auta
echo $auta->auto[0];

// Ispis drugog auta
echo "<br>";
echo $auta->auto[1];

// Ispis trećeg auta
echo "<br>";
echo $auta->auto[2];

echo "<hr>";
// Ispis kroz for petlju
for($j = 0; $j < sizeof($auta->auto); $j++){
    echo $auta->auto[$j] . "<br>";
}

echo "<hr>";
// Ispis kroz foreach
echo "<ul>";
    foreach($auta as $auto){
        echo "<li>" . $auto . "</li>";
    }
echo "</ul>";
