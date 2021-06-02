<?php
// Podaci sa kojima ćemo raditi
$podaci = array(
    "Bosna i Hercegovina" => array(
        "GlavniGrad" => "Sarajevo",
        "Kontinent" => "Europa"
    ),
    "Francuska" => array(
        "GlavniGrad" => "Pariz",
        "Kontinent" => "Europa"
    ),
    "Nevada" => array(
        "GlavniGrad" => "Carson City",
        "Kontinent" => "Amerika"
    )
);

// Preuzimanje metoda koji je poslan
$metod = strtolower($_SERVER['REQUEST_METHOD']);

// Razlikovanje metoda i aktiviranje koda na osnovu toga
switch($metod){
    // Dobavljanje podataka (GET)
    case "get":
        if(count($_GET) == 0){
            print_r($podaci);
        }
        if(count($_GET) > 0){
            print_r($podaci[$_GET['drzava']]);
        }
    break;
    // Ubacivanje podataka
    case "post":
        $podaci[$_POST['drzava']] = array(
            "GlavniGrad" => $_POST['GlavniGrad'],
            "Kontinent" => $_POST['Kontinent']
        );
        print_r($podaci);
    break;
    case "put":
        $parametri = file_get_contents("php://input");
        $parovi = explode("&", $parametri);
        $rezultat = array();

        foreach($parovi as $par){
            $par = explode("=", $par);
            $kljuc = $par[0];
            $vrijednost = $par[1];
            $rezultat[$kljuc] = $vrijednost;
        }

        $podaci[$rezultat['drzava']] = array(
            "GlavniGrad" => $rezultat['GlavniGrad'],
            "Kontinent" => $rezultat['Kontinent']
        );

        print_r($podaci);
    break;
    case "delete":
        unset($podaci[$_REQUEST['drzava']]);
        print_r($podaci);
    break;
}