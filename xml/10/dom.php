<?php
// Kreiranje jednostavnog XML dokumenta
$xml = <<<XML
    <elementi>
        <element>Vrijednost 1</element>
        <element>Vrijednost 2</element>
        <element>Vrijednost 3</element>
    </elementi>
XML;

// Instanciranje u objekat sa XML stringom
$dom = new DOMDocument();
$dom->loadXML($xml);
// Preuzimanje elemenata kroz ime elementa
$element = $dom->getElementsByTagName("element");
// Uzimanje vrijednosti iz preuzetih elemenata
echo $element->item(0)->nodeValue;
echo "<br>";
echo $element->item(1)->nodeValue;
echo "<br>";
echo $element->item(2)->nodeValue;
echo "<hr>";

// Preuzimanje korištenjem for petlje
$element = $dom->getElementsByTagName("element");
for($i = 0; $i < $element->length; $i++){
    echo $element->item($i)->nodeValue . "<br>";
}
echo "<hr>";

// Preuzimanje kroz foreach petlju
$elementi = $dom->getElementsByTagName("element");
foreach($elementi as $element){
    echo $element->nodeValue . "<br>";
}
echo "<hr>";

