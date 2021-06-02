<?php

$superheroes = array(
    "Batman",
    "Superman",
    "Spiderman",
    "Wonder Woman"
);

$names = array(
    "Bruce Wayne",
    "Clark Kent",
    "Peter Parker",
    "Princess Diana"
);  

echo "<ul>";
for($i = 0; $i < count($names); $i++){
    echo "<li>" . $names[$i] . " : " . $superheroes[$i] . "</li>";
}
echo "</ul>";

// Rad sa foreach petljom
echo "<ul>";
foreach($names as $name){
    echo "<li>" . $name . "</li>";
}
echo "</ul>";

// Rad sa foreach i asocijativnim nizom
$superheroji  = array(
    "Batman" => "Bruce Wayne",
    "Superman" => "Clark Kent",
    "Spiderman" => "Peter Parker",
    "Wonder Woman" => "Princess Diana"
);

echo "<ul>";
    foreach($superheroji as $heroj => $ime){
        echo "<li>" . $heroj . " : " . $ime . "</li>";
        //echo "<li> $heroj : $ime </li>"; -> Alternativa
    }
echo "</ul>";

// Mapiranje dva niza iste dužine za ispis odjednom
echo "<ul>";
    array_map(function($superheroes, $names){
        echo "<li> $superheroes : $names </li>";
    }, $superheroes, $names);
echo "</ul>";

// While petlja sa prva dva niza u vježbi
echo "<ul>";
    $brojac = 0;
    while($brojac < count($superheroes)){
        echo "<li> $superheroes[$brojac] : $names[$brojac] </li>";
        $brojac++;
    }
echo "</ul>";   