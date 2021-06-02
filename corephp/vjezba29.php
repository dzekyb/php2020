<?php
    class Product{
        public $title;
        public $price;
        public $color;
        public $memory;

        public function __construct($title, $price, $color){
            $this->title = $title;
            $this->price = $price;
            $this->color = $color;
        }

        public function info(){
            return "Title: " . $this->title . ". Price: " . $this->price . ". Color: " . $this->color . ". Memory: " . $this->memory . "<br>";
        }

        public function setMemory($memory){
            if(!is_integer($memory)){
                die('Poslao si memoriju u stringu. CCC');
            } 
            $this->memory = $memory;
            
        }
    }

    $samsung = new Product('Galaxy Note 20', 3000, "black");
    $iphone = new Product('iPhone 12 Pro Max', 3000, "grey");
    $xiaomi = new Product('Redmi Note 11 Pro', 1500, "purple");
    
    $iphone->setMemory(256);

    echo $samsung->info();
    echo $iphone->info();
    echo $xiaomi->info();

    
?>