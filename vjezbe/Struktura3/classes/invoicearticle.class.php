<?php
    
    class InvoiceArticle extends DatabaseObject {
        protected static $dbTable = 'artiklifakture';
        protected static $dbFields = array( 'ime', 'cijena', 'kolicina','rabat','bezPdv', 'pdv', 'ukupno', 'fakturaId');
        protected $id;
        public $ime;
        public $cijena;
        public $kolicina;
        public $rabat;
        public $bezPdv;
        public $pdv;
        public $ukupnp;
        public $fakturaId;

        public function __construct($args) {

            $this->id =                 $args['id'] ?? '';
            $this->ime =                $args['ime'];
            $this->cijena =             $args['cijena'];
            $this->kolicina =           $args['kolicina'];
            $this->rabat =              $args['rabat'];
            $this->bezPdv =             $args['bezPdv'] ?? 0;
            $this->pdv =                $args['pdv'] ?? 0;
            $this->ukupno =             $args['ukupno'];
            $this->fakturaId =          $args['fakturaId'];

        }
    } //end of class
?>