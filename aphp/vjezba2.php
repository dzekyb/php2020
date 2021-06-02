<?php

interface iKorisnik{
    public function login();
    public function register($username, $password, $firstname, $lastname, $phone, $email);
    public function reset_password($email, $phone);
    public function edit_profile($key, $value);
    public function insert_profile($username, $password, $firstname, $lastname, $phone, $email);
    public function delete_profile($email);
}

abstract class Korisnik implements iKorisnik{
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;

    public function __construct($username, $password, $firstname, $lastname, $email, $phone){
         $this->username = $username;
         $this->password = $password;
         $this->firstname = $firstname;
         $this->lastname = $lastname;
         $this->email = $email;
         $this->phone = $phone;
    }


    public function login(){
        return "User with username" . $this->username . " and password " . $this->password . " is logged in!";
    }
    public function register($username, $password, $firstname, $lastname, $phone, $email){
        return "User with username " . $username . " and password " . $password . " is registered!";
    }
    public function reset_password($email, $phone){
        return "User with email " . $email . " is going to reset his password!";
    }
    public function edit_profile($key, $value){
        return "User will edit this key " . $key . " and add this value: " . $value;
    }
    public function insert_profile($username, $password, $firstname, $lastname, $phone, $email){
        return "The system will insert new user profile with this data: " . $username . ", " . $password . ", " . $firstname . ", " . $lastname . ", " . $phone . ", " . $email;
    }
    public function delete_profile($email){
        return "User with this email " . $email . " will delete his profile!";
    }
}

class Administrator extends Korisnik{ 
    public $type;
    public function __construct($username, $password, $firstname, $lastname, $email, $phone, $type){
        parent::__construct($username, $password, $firstname, $lastname, $email, $phone);
        $this->type = $type;
    }
}

class Polaznik extends Korisnik{
    public $type;
    public function __construct($username, $password, $firstname, $lastname, $email, $phone, $type){
        parent::__construct($username, $password, $firstname, $lastname, $email, $phone);
        $this->type = $type;
    }
}


$amar = new Polaznik("amar", "1234", "Amar", "Be", "a@b.com", "033", "2");
echo $amar->login();
