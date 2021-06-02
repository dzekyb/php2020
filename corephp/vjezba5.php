<?php

// Ispisi na ekran/izlaz

echo "Ovo je ispis!";
print "Ovo je ispis!";
print ("Ovo je ispis!");
echo "<hr>";

// Jednostruki i dvostruki navodnici + konkatenacija
echo "Ispis broj 1.";
echo 'Ispis broj 2.';
echo "<hr>";

$broj_godina = 35;
echo "<h3>Broj godina je: $broj_godina </h3>";
echo '<h3>Broj godina je: $broj_godina </h3>';

echo "<h3>Broj godina je:" . $broj_godina . "</h3>";
echo '<h3>Broj godina je:' . $broj_godina . '</h3>';

// Ispis za testiranje
var_dump($broj_godina);
echo "<hr>";

// Print_r ispis niza (u svrhe testiranja)
$niz = array(1,2,3,4,5);
print_r($niz);
echo "<hr>";

// Printf ispis (za evaluaciju promjenljivih u string)
$broj = 137;
printf("Cijeli broj: %d, Decimalni prikaz: %.3f, Binarni prikaz: %b",$broj, $broj, $broj);
echo "<hr>";

// Promjenljive i konstante
$ime = "ITAcademy";
echo $ime;
echo "<br>"; 
$ime = "InternetAcademy";
echo $ime;
echo "<br>";

define("KOMPANIJA", "LINKgroup");
echo KOMPANIJA;
define("KOMPANIJA", "noviLINKgroup"); // Neće da može!
echo KOMPANIJA;

// Promjenljive se mogu mijenjati, konstante ne mogu!
    // Konstante nemaju dolar znak
    // Nazivi konstanti se pišu velikim slovima


// Tipovi podataka (prosti)
$broj = 13;   //Integer, cjelobrojni tip
$broj = 13.3; // Decimalni, float, tip sa pokretnom tačkom
$broj = "13"; // String, odnosno tekstualni tip
$broj = '13'; // String, odnosno tekstualni tip
$broj = true; // Boolean, odnosno tačno - netačno tip
$broj = false;// Boolean, odnosno tačno - netačno tip

// Tipovi podataka (složeni)
$niz = array(1,2,3,4); // Niz
echo $niz[0];
echo $niz[1];
echo $niz[2];
echo $niz[3];

// Ni tamo, ni ovamo :D
$niz = NULL;