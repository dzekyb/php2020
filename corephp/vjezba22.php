<?php

$auta = array('Fiat', 'Mercedes', 'Audi', 'Opel');

# Veličina niza (count ili sizeof)
echo count($auta) . "<br>";

# Da li se nešto nalazi u nizu (in_array)
echo in_array('Fiat', $auta) . "<br>";

# Bijela lista
if(in_array('Fiat', $auta)){
    echo "Učitavam podatak... <br>";
}else{
    echo "Ne učitavam podatak... <br>";
}

# Crna lista
if(in_array('Mercedes', $auta)){
    echo "Ne učitavam podatak... <br>";
}else{
    echo "Učitavam podatak... <br>";
}

# Ispis član po član niza (array_walk)
array_walk($auta,"print_r");

# Popunjavanje niza statičkom vrijednošću
$statickiNiz = array_fill(0, 10, "Ne znamo šta su nizovi.");
print_r($statickiNiz);
echo "<br>";

# Zamjena ključeva/indeksa i vrijednosti
$laptopi = array('HP', 'Asus', 'Lenovo');
$laptopiFlipped = array_flip($laptopi);

print_r($laptopi);
print_r($laptopiFlipped);

$mobiteli = array('prvi' => 'Xiaomi', 'drugi' => 'Samsung', 'treci' => 'Huawei');
$mobiteliFlipped = array_flip($mobiteli);

print_r($mobiteli);
print_r($mobiteliFlipped);

# Sortiranje niza
$brojevi = array(1, 7, 8, 25, 67, 99, 13, 2);
$brojeviAsoc = array("prvi" => 1, "drugi" => 7, "treci" => 8, "cetvrti" => 25, "peti" => 67, "šesti" => 99, "sedmi" => 13, "osmi" => 2);

# Sortiranje niza po vrijednosti, rastući red
print_r(sort($brojevi));

# Sortiranje niza po vrijednosti, opadajući red
print_r(rsort($brojevi));

# Sortiranje asocijativnog niza, po vrijednosti, rastući
print_r(asort($brojeviAsoc));

# Sortiranje asocijativnog niza, po vrijednosti, opadajući
print_r(arsort($brojeviAsoc));

# Sortiranje asocijativnog niza, po ključevima, rastući
print_r(ksort($brojeviAsoc));

# Sortiranje asocijativnog niza, po ključevima, opadajući
print_r(krsort($brojeviAsoc));

# Izbacivanje posljednjeg člana niza
echo array_pop($auta) . "<br>";

# Dodavanje novog člana niza na kraj niza
array_push($auta, 'BMW');

# Izbacivanje prvog člana niza
array_shift($auta);

# Dodavanje novog člana niza na početak niza
array_unshift($auta, 'Opel');

# Mapiranje niza na proslijeđene varijable
$gradovi = array('Sarajevo', 'Pariz', 'London');
list($bosnia, $france, $england) = $gradovi;
echo $bosnia . " " . $france . " " . $england . "<br>";

# Uzimanje ključeva iz postojećeg niza u novi niz
$hrana = array('voce' => 'jabuka', 'povrce' => 'brokula', 'meso' => 'piletina');
$hranaKljucevi = array_keys($hrana);
var_dump($hranaKljucevi);

# Brisanje sekvence članova niza
$brojeviSplice = array(0, 1, 2, 3, 4, 5);
array_splice($brojeviSplice, 2,3);

# Mijenjanje sekvence članova niza
array_splice($brojeviSplice, 2,3, 99);

# Uzimanje dijelova niza u novi niz
$brojeviSlice = array(10, 20, 30, 40, 50);
$brojeviSliceIskinuto = array_slice($brojeviSlice, 1, 4);

# 





?>