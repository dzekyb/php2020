<?php

class Vehicle{
    public $type;
    public $year;
    public $color;
    public $seats;

    public function __construct($type, $year, $color, $seats){
        $this->type = $type;
        $this->year = $year;
        $this->color = $color;
        $this->seats = $seats;
    }

    public function upali(){
        return "Vozilo je upaljeno.";
    }
    public function kreni(){
        return "Vozilo se pokrenulo.";
    }
    public function stani(){
        return "Vozilo se zaustavilo.";
    }
    public function ubrzaj(){
        return "Vozilo je ubrzalo.";
    }
    public function uspori(){
        return "Vozilo je usporilo.";
    }
    public function skreni($gdje){
        if($gdje == 'lijevo'){
            return "Vozilo je skrenulo lijevo.";
        }else{
            return "Vozilo je skrenulo desno.";
        }
    }
    public function ugasi(){
        return "Vozilo se ugasilo.";
    }

}

// Instanciranje različitih prevoznih sredstava
$auto = new Vehicle('automobil', '2001', 'truhla višnja', '5');
$tenk = new Vehicle('tenk', '1945', 'maslinasto zelena', '3');
$romobil = new Vehicle('romobil', '2018', 'crna', '0');
$role = new Vehicle('role', '1998', 'plava', '0');
$podmornica = new Vehicle('podmornica', '1965', 'crne', '50');
$avion = new Vehicle('avion', '2005', 'bijele', '132');

// Specifičnosti
    // auto - nema neke specifičnosti
    // tenk - naoružanje, pucanje, gusjenica, cijev, nema prozora, okret glave od 360 stepeni, ulazi se odozgo, KOPNO
    // romobil - nema sjedišta, nema pogona, nema karoseriju
    // role - nema sjedišta, nema pogona, nema karoseriju, nema volan
    // podmornica - rOnja, plOva, nema točkove, naoružanje, periskop, radar, VODA 
    // avion - leta, krila, radar, autopilot, ne moRe ići unazad, VAZDUH

// Klasa PrevoznoSredstvo
// Klase Auto, Avion, Podmornica, Tenk, Romobil, Role nasljeđuju klasu PrevoznoSredstvo
// Klasa Putničko, Teretno, Sportsko nasljeđuju klasu Auto
// Klasa Mercedes, Audi, BMW nasljeđuju klasu Putničko
// Klasa BMW M4 nasljeđuje klasu BMW


?>