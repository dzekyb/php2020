<?php

$xmlTekst = <<<XML
<izdanja>
    <knjiga id="01" isbn="12345678">
        <naslov>Majstor i Margarita</naslov>
        <autor>Mihail Bulgakov</autor>
    </knjiga>
    <knjiga id="02" isbn="23456789">
        <naslov>Zločin i kazna</naslov>
        <autor>Fjodor M. Dostojevski</autor>
    </knjiga>
</izdanja>
XML;

$xml = new SimpleXMLElement($xmlTekst);
foreach($xml->children() as $knjiga){
    echo "Naslov: " . $knjiga->naslov . "<br>";
    echo "Autor: " . $knjiga->autor . "<br>";
    echo "ID: " . $knjiga['id'] . "<br>";
    echo "ISBN: " . $knjiga['isbn'] . "<br>";
    echo "<br><br>";
}

echo "<hr><hr><hr>";

$xml = new SimpleXMLElement(
    "http://rss.cnn.com/rss/cnn_world.rss",
    null,
    true
);

#var_dump($xml);
# Ostalo za zadaću

echo "<hr><hr><hr>";
// Kreiranje XML dokumenta kroz Simple XML
$xmlKreiranje = new SimpleXMLElement(
    '<?xml version="1.0" encoding="UTF-8" ?>
    <izdanja></izdanja>'
);
// Dodavanje nove knjige
$knjiga = $xmlKreiranje->addChild("knjiga");

// Dodavanje atributa novoj knjizi
$knjiga->addAttribute("id", "03");
$knjiga->addAttribute("isbn", "34567890");

// Dodavanje podelemenata elementu "knjiga"
$naslov = $knjiga->addChild("naslov", "Madam Bovary");
$autor = $knjiga->addChild("autor", "Gustav Flaubert");

// Druga knjiga sa kreiranjem, atributima i podelementima
$knjiga2 = $xmlKreiranje->addChild("knjiga");
$knjiga2->addAttribute("id", "04");
$knjiga2->addAttribute("isbn", "4567890123");
$naslov2 = $knjiga2->addChild("naslov", "Ana Karenjina");
$autor2 = $knjiga2->addChild("autor", "Lav Nikolajevič Tolstoj");

// Exportovanje
echo $xmlKreiranje->asXML();
// Exportovanje u fajl
    $xmlKreiranje->asXML("knjige2.xml");

echo "<hr><hr><hr>";
$kupacXml = new SimpleXMLElement(
    '<?xml version="1.0" encoding="UTF-8" ?>
    <kupci></kupci>'
);
$kupac = $kupacXml->addChild("kupac");
$kupac->addAttribute("id", "181102398");
$ime = $kupac->addChild("ime", "Pero");
$prezime = $kupac->addChild("prezime", "Djetlić");
$grad = $kupac->addChild("grad", "Sarajevo");
$kartica = $kupac->addChild("kartica", "1111 2222 3333 4444");
$registracija = $kupac->addChild("registracija", "08.05.2021");

$kupac2 = $kupacXml->addChild("kupac");
$kupac2->addAttribute("id", "6356456456");
$ime2 = $kupac2->addChild("ime", "Duško");
$prezime2 = $kupac2->addChild("prezime", "Dugouško");
$grad2 = $kupac2->addChild("grad", "Zenica");
$kartica2 = $kupac2->addChild("kartica", "2222 3333 4444  5555");
$registracija2 = $kupac2->addChild("registracija", "07.05.2021");

echo $kupacXml->asXML("kupci.xml");