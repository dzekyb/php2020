<?php

    class Bill extends DatabaseObject {

        protected static $dbTable = 'fiskalniRacun';
        protected static $dbFields = ['broj', 'datum', 'slika', 'userId', 'firmaId'];
        protected $id;
        public $broj;
        public $datum;
        public $slika;
        public $userId;
        public $firmaId;

        public function __construct($args) {
            $this->id =               $args['id'] ?? '';
            $this->broj =             $args['broj'];
            $this->datum =            $args['datum'];
            $this->slika =            $args['slika'];
            $this->userId =           $args['userId'];
            $this->firmaId =           $args['firmaId'];
            if($this->slika) {
                $imageClass = new Image($this->slika);
                $this->slika = $imageClass->getImage();
            }
        }
    }