<?php

$parametri = "drzava=Francuska";
$akcija = "obrisi";
$host = "localhost";
$port = 80;
$servis = "amarbeslija/xml/15/index.php";
// Vratit ćemo se na servis radi linka

// Otvaranje konekcije ka serveru
$response = "";
$fp = fsockopen($host, $port);

// Prikaz rezultata (GET)
if($akcija == "prikazi"){
    fputs($fp, "GET /$servis HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Connection: close\r\n\r\n");

// Prikaz određenih rezultata (GET)
}else if($akcija == "prikaziOdredeni"){
    fputs($fp, "GET /{$servis}?$parametri HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Connection: close\r\n\r\n");

// Unos podataka (POST)
}else if($akcija == "unesi"){
    fputs($fp, "POST /$servis HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: " . strlen($parametri) . "\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $parametri);

// Update podataka (PUT)
}else if($akcija == "azuriraj"){
    fputs($fp, "PUT /$servis HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: " . strlen($parametri) . "\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $parametri);

// Brisanje podataka (DELETE)
}else if($akcija == "obrisi"){
    fputs($fp, "DELETE /{$servis}?$parametri HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: " . strlen($parametri) . "\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $parametri);
}

while(!feof($fp)){
    $response .= fgets($fp);
}
fclose($fp);

$result = explode("\r\n\r\n", $response);
$responseZaglavlje = explode("\r\n", $result[0]);
$responseTijelo = $result[1];
var_dump($responseZaglavlje);
echo "<br><br><br>";
echo $responseTijelo;