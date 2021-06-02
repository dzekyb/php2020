<?php

/* Nazivi varijabli/promjenljivih */

// Idealno za matematičke promjenljive
$a = 1;
$b = 2;
$c = 3;

// Primjer za korisničko ime i username
$username  = "Username1";
$userName  = "Username2";
$user_name = "Username3";

$password = "Password1";

// Drugi primjeri
$username1 = "Username 4"; //Može, ali nije dobro
$username_client = "Username5"; // Dobra opisna varijabla
$username_database = "Username6"; // Isto

/* Šta ne može!!! */
/*
$ varijabla = "Test";
$?varijable = "Test";
$4varijabla = "Test";
$vari jabla = "Test";
$varijabla? = "Test";
$varij$bla  = "Test";
*/

/* Case sensitive problem */
$korisnicko_ime = "Username1";
echo $korisnicko_Ime;  //Razlika u velikom slovu I, ali ne radi

// Jednolinijski komentar
# Jednolinijski komentar
/*
    Više
    linijski
    komentar
*/

/**
 * Više
 * Linijski
 * Komentar
 */


?>