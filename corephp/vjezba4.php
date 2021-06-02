<?php

// Godina rođenja korisnika
$godina_rodjenja = 1978;
// Trenutna godina dobivena funkcijom date()
$godina_trenutno = date('Y');
// Broj godina korisnika
$godine_korisnika = $godina_trenutno - $godina_rodjenja;
// Ispis na izlaz
echo "<h1>" . $godine_korisnika . "</h1>";