<?php

#echo realpath("./");
#echo "<br>";
#echo $_SERVER['DOCUMENT_ROOT'];

#$txt = file_get_contents('vjezba21.txt');
#echo $txt;
#$txt = "Hello World 2";
#file_put_contents('vjezba21.txt', $txt);

#$niz = array('crveno', 'plavo', 'zeleno');
#$nizEncoded = json_encode($niz);
#file_put_contents('vjezba22.json', $nizEncoded);

#$dodatak = 'ljubičasto';
#$json = file_get_contents('vjezba22.json');
#$jsonNiz = json_decode($json, true);
#array_push($jsonNiz, $dodatak);
#$jsonEncoded = json_encode($jsonNiz);
#file_put_contents('vjezba22.json', $jsonEncoded);

#$niz = array('prva'=>'crveno', 'druga'=>'plavo', 'treca'=>'zeleno');
#$nizEncoded = json_encode($niz);
#file_put_contents('vjezba23.json', $nizEncoded);

#$dodatak = 'ljubičasto';
#$json = file_get_contents('vjezba23.json');
#$jsonNiz = json_decode($json, true);
#$jsonNiz['četvrta'] = $dodatak;
#$jsonEncoded = json_encode($jsonNiz);
#file_put_contents('vjezba23.json', $jsonEncoded);

$jsonNiz = json_decode(file_get_contents('vjezba23.json'), true);
foreach($jsonNiz as $key => $json){
    echo $key . ":" . $json . "<br>";
}


#$dh = opendir("./");
#while (false !== ($file = readdir($dh)))
#echo $file . "<br>";



?>