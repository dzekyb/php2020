<?php

/**
 * Interface iUser provides methods for Users inside the application.
 * These methods include User login, registeration, reset and confirm 
 * password, select, insert, update and delete with status change and 
 * greeting the user and sending him email with card on his birthday.
 * 
 * @author Amar Bešlija <amar.beslija@it-academy.com>
 * @copyright 2021 Amar Bešlija
 * 
 */

interface iUser{
    /* $email and $password are coming from login form */
    public function login($email, $password);
    /* $status and $password are must have parameters.
       We can choose between $email, $phone and $username
       in user registration.
       All other parameters are optional. 
       $unique_id can accept personal id or business id.
       $birthdate can accept personal birthdate or company birthdate.
    */
    public function register($status, $email, $phone, $username, $password, $firstname, $lastname, $birthdate, $country, $city, $postal_code, $address, $unique_id, $business_vat);
    /* */
    public function reset_password($email, $phone, $username);
    public function confirm_profile($email, $phone, $username);
    public function birthday($email, $phone, $username);
    public function hello($email, $phone, $username);
    public function select($email, $phone, $username);
    public function insert($user_parameters);
    public function edit($id, $user_parameters);
    public function delete($email, $phone, $username);
    public function status($email, $phone, $username);

    /**
     * public function get_id_type(){
     *      $config = new Config;
     *      if($config['id_type'] == 'email'){
     *          return 'email';
     *      }else if ($config['id_type'] == 'phone'){
     *          return 'phone';
     *      }else{
     *          return 'username';
     *      }
     * }
     * 
     * 
     * public function get_id_type($id_type){
     *  ....
     * }
     */
}

?>