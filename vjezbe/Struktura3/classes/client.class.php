<?php
    
    class Client extends FirmInformations {
        protected static $dbTable = 'klijent';
        protected static $dbFields = array('ime', 'jib', 'logo', 'pdv', 'pib', 'vlasnik', 'adresa','mjesto', 'telefon', 'email', 'racun', 'banka','userId');

    } //end of class
?>