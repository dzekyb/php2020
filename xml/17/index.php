<?php
$string1 = "String1";
$string2 = 'String2';
$spojeni = $string1 . $string2;
$spojeni2 = "String1 " . "String2";
$spojeni3 = "String1 " . $string1 . " String2";

$podatak = "1234";
$lozinka = "Moja lozinka je $podatak";
$neispravna_lozinka = 'Moja lozinka je $podatak';
$lozinka2 = "Moja loznka je {$podatak}-nova";

$moja_varijabla = <<<VARIJABLA

    <xml>
        <element>Vrijednost1</element>
        <element>Vrijednost2</element>
        <element>{$string1}</element>
    </xml>

VARIJABLA;

$ime = "batman";
$$ime = 53;
echo $batman; //53

$ulazni_podatak = "  1234   ";
$ulazni_podatak = trim($ulazni_podatak); // "1234"
//ltrim briše lijevu stranu
//rtrim briše desnu stranu
//trim briše sa obje strane

$stringTrazeni = "psovka";
$stringZamjena = "*****";
$stringOriginal = "Ovo je psovka!";
echo str_replace($stringTrazeni, $stringZamjena, $stringOriginal);

// Funkcija koja čisti ulazni string od neželjenih karaktera
function cleaner($ulazniString){
    $podaci = str_replace("'", "&apos;", $ulazniString);
    $podaci = str_replace('"', "&quot;", $podaci);
    $podaci = str_replace("<", "&lt;", $podaci);
    $podaci = str_replace(">", "&gt;", $podaci);
    $podaci = str_replace("&", "&amp;", $podaci);
    return $podaci;
}

$necistiString = "<script src='index.js'></script>";
$necistiString2 = '<div class="moja-klasa">Ja & Ti</div>';

echo cleaner($necistiString);
echo cleaner($necistiString2);

function cleaner2($ulazniString){
    $podaci = str_replace("'", "/'", $ulazniString);
    $podaci = str_replace('"', '/"', $podaci);
    $podaci = str_replace('<', '&lt;', $podaci);
    $podaci = str_replace(">", "&gt;", $podaci);
    return $podaci;
}

echo "<br><br><br>";
echo strlen($necistiString); //32 karaktera u stringu

echo "<br><br><br>";
$originalniString = "Ovo je moj testni originalni string";
$trazim1 = "moj testni";
$trazim2 = "Ovo";
$trazim3 = "Nešto lijevo";

echo "Rezulat1: " . strpos($originalniString, $trazim1) . "<br>"; //7
echo "Rezultat2: " . strpos($originalniString, $trazim2) . "<br>"; //0
echo "Rezultat3: " . strpos($originalniString, $trazim3) . "<br>"; //false

//Strpos vraća false kada ne nađe, vraća broj pozicija kada nađe
// Ali ako nađe na prvom mjestu vrati nulu
// Što znači da ne smije biti klasična if provjera ako se koristi
// Provjera bi bila ovakva:
// if(strpos($originalniString, $trazim2) == 0){...}

echo "<br><br><br>";
$dugiString = "Ovo je moj pravo dugiiiii string, i tako dalje...";
$kratkiString = substr($dugiString, 0, 10);
echo $kratkiString . "<br><br>";
$kratkiString2 = substr($dugiString, 10, 20);
echo $kratkiString2  . "<br><br>";

$noviString = "Neki naš string koji je produžen!";
echo wordwrap($noviString, 1, "<br>");

$stringTekst = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore architecto nemo, non facere exercitationem asperiores officia alias qui cumque dolorem, ut ipsa quam culpa pariatur. Vero temporibus aperiam exercitationem. Suscipit esse, optio fugit iste cumque molestiae eius harum facilis. Nulla possimus quibusdam eos esse unde earum delectus, modi eligendi deleniti. Nobis laudantium illo voluptatum ipsa quasi sint numquam. Blanditiis, architecto ipsa aperiam veniam nostrum illo atque corrupti, ea explicabo quibusdam esse placeat rem soluta non, in quaerat necessitatibus. Nesciunt similique aspernatur, aut perferendis id ullam doloribus quibusdam esse quod modi, illum minima error. Ab et possimus, maiores a alias ea.";

$stringNiz = explode(".", $stringTekst);

foreach($stringNiz as $recenica){
    ?>
        <div style="border: 1px solid #d3d3d3; padding:10px; margin:5px; width:170px; float:left;">
            <?php echo (strlen($recenica)>20)?substr($recenica,0,20) . "...":$recenica; 
            // if(strlen($recenica) > 20){
            //  echo substr($recenica,0,20) . "...";    
            //}else{
            //  echo $recenica;    
            //}
            ?>
        </div>
    <?php
}

$broj = 33;
$brojString = (string) $broj;
// Broj 33 je eksplicitno konvertovan u string

$broj2 = 89;
$brojString2 = strval($broj2);
// Broj 89 je eksplicitno konvertovan u string

echo "<br><br><br>";
echo "Ovo je \"moj\" specijalni string";

echo "<br><br><br>";
echo 'Ovo je \'moj\' specijalni string';

echo "<br><br><br>";
echo addslashes("Ovo je 'moj' specijalni string!");

echo "<br><br><br>";
$xml = <<<XML
    <xml>
        <element>Vrijednost 1</element>
        <element>Vrijednost 2</element>
        <element>Vrijednost 3</element>
    </xml>
XML;

echo strip_tags($xml);

