<?php
$knjigeString = file_get_contents("knjige.xml");
$knjigeXml = new SimpleXMLElement($knjigeString);

foreach($knjigeXml as $knjiga){
    // Dobavljanje djece od elementa
    $children = $knjiga->children();
    // Ispis djece kroz obični niz (indeksirani niz)
    echo "Naslov: " . $children[0] . "<br>";
    echo "Autor: " . $children[1] . "<br>";
    echo "<br><br>";
}

echo "<hr><hr><hr>";
// Primjer sa automobilima i children metodom kao i simplexml_load_file
$automobiliXml = simplexml_load_file("automobili.xml");

// Dobavljanje automobila
foreach($automobiliXml as $automobil){
    $children1 = $automobil->children();
    echo "Proizvođač: " . $children1[0] . "<br>";
    echo "Model: " . $children1[1] . "<br>";
    echo "Cijena: " . $children1[2] . "<br>";
    
    // Uzeli smo djecu od podelementa "specifikacija"
    $children2 = $children1[3]->children();
    echo "Tip: " . $children2[0] . "<br>";
    echo "Gorivo: " . $children2[1] . "<br>";
    echo "Godina: " . $children2[2] . "<br>";
    
    // Uzeli smo djecu od podelementa potrošnja
    $children3 = $children2[3]->children();
    echo "Gradska: " . $children3[0] . "<br>";
    echo "Otvorena: " . $children3[1] . "<br>";

    echo "<br><br>";
}