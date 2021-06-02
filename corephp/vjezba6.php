<?php

# Operator dodjele =
$varijabla = 'Neka vrijednost';

# Aritmetički operatori +,-,/,*,%
$varijabla1 = 5 + 10;
$varijabla2 = 10 - 5;
$varijabla3 = 10 / 5;
$varijabla4 = 10 * 5;
$varijabla5 = 23 % 4;

# Operatori poređenja <,>, <=, >=, ==, ===, !=, !==
if (10 > 5){ echo "Tačno1  <br>"; }
if (5 < 10){ echo "Tačno2 <br>"; }
if (5 <= 5){ echo "Tačno3 <br>"; }
if (5 >= 5){ echo "Tačno4 <br>"; }
if (5 == "5"){ echo "Tačno5 <br>"; }
if (5 === "5"){ echo "Tačno6 <br>"; }
if (5 != 10){ echo "Tačno7 <br>"; }
if (5 !== "5"){ echo "Tačno8 <br>"; }

# Spaceship operator <=>
if ((5 <=> 5) == 0 ){ echo "Tačno9 <br>";}
if (6 <=> 5){ echo "Tačno10 <br>";}
if (5 <=> 6){ echo "Tačno11 <br>";}

# String operator . (konkatenacija stringa)
$varijabla6 = "String1 " . "String2";

# Unarni operatori +=, -=, /=, *=, %=, .=
$varijabla7 = $varijabla7 + 1;
$varijabla7 += 1;

$varijabla8 = $varijabla8 - 1;
$varijabla8 -= 1;

$varijabla9 = $varijabla9 / 1;
$varijabla9 /= 1;

$varijabla10 = $varijabla10 * 1;
$varijabla10 *= 1;

$varijabla11 = $varijabla11 % 1;
$varijabla11 %= 1;

$varijabla12 = $varijabla12 . "1";
$varijabla12 .= "1";

# Inkrement ++ | Dekrement --
$varijabla13 = 5;
$varijabla13 = $varijabla13 + 1;
$varijabla13++;

$varijabla14 = 7;
$varijabla14 = $varijabla14 - 1;
$varijabla14--;

$a = 10;
$x = ++$a;
echo $x; //X će biti 11;
echo "<br>";
echo $a;

$b = 10;
$y = $b++;
echo $y; //Y će biti 10;
echo "<br>";
echo $b; 

echo "<hr>";
$t = 4;
$r = $t--;
echo ($r++)+$t;

# Logički operatori &&, ||, !
if (5 === 10 && 3 == 3){ echo "Tačno12 <br>";}
if (5 === 10 || 3 == 3){ echo "Tačno13 <br>";}
if (!(3 == 3)){ echo "Tačno14 <br>";}

# Bit operatori >>, <<, |, &, ^, ~

# Implicitna konverzija podataka
$o = 4 + "4";
echo $o;

# Eksplicitna konverzija podataka
$p = (string)4 + (int)"4";
echo $p;

# Koji tip podatka je ova varijabla:
echo gettype($p);