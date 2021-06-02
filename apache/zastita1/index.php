<?php

if(isset($_GET['user'])){
    echo "Odabrali ste korisnika... " . $_GET['user'];
}else{
    echo "Nije odabran nijedan korisnik!";
}