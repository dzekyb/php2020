<?php
    
    class FirmInformations extends DatabaseObject { 
        protected $id;
        public $ime;
        public $jib;
        public $logo;
        public $pdv;
        public $pib;
        public $vlasnik;
        public $adresa;
        public $mjesto;
        public $telefon;
        public $email;
        public $racun;
        public $banka;
        public $userId;

        public function __construct($args) {
            $this->id =                 $args['id'] ?? '';
            $this->ime =                $args['ime'];
            $this->jib =                $args['jib'];
            $this->pdv =                $args['pdv'];
            $this->pib =                $args['pib'] ?? '';
            $this->logo =               $args['logo'];
            $this->vlasnik =            $args['vlasnik'];
            $this->adresa =             $args['adresa'];
            $this->mjesto =             $args['mjesto'];
            $this->telefon =            $args['telefon'];
            $this->email =              $args['email'];
            $this->racun =              $args['racun'];
            $this->banka =              $args['banka'];
            $this->userId =             $args['userId'];
            if($this->logo) {
                $image = new Image($this->logo);
                $this->logo = $image->getImage();
            }
        }

        public function setId($id) {
            $this->id = $id;
        }

    } //end of class