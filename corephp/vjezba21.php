<?php

$cars = array(
    // Prvi član vanjskog niza
    array(
        // Tri člana unutrašnjeg niza
        "Volvo", 
        15, 
        25
    ),
    // Drugi član vanjskog niza
    array(
        // Tri člana unutrašnjeg niza
        "BMW",
        27,
        43
    ),
    // Treći član vanjskog niza
    array(
        // Tri člana unutrašnjeg niza
        "Mercedes",
        31,
        68
    )
);

echo "<ul>";
for($i = 0; $i < count($cars); $i++){
    for($j = 0; $j < count($cars[$i]); $j++){
        echo "<li>" . $cars[$i][$j] . "</li>";
    }
}
echo "</ul>";

/* Slijed koraka izvršavanja vanjske i unutrašnje petlje */
// Prva iteracija vanjske petlje
    # Prva iteracija unutrašnje petlje
    # Druga iteracija unutrašnje petlje
    # Treća iteracija unutrašnje petlje
// Druga iteracija vanjske petlje
    # Prva iteracija unutrašnje petlje
    # Druga iteracija unutrašnje petlje
    # Treća iteracija unutrašnje petlje
// Treća iteracija vanjske petlje
    # Prva iteracija unutrašnje petlje
    # Druga iteracija unutrašnje petlje
    # Treća iteracija unutrašnje petlje