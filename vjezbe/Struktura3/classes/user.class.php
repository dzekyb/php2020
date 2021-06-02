<?php

    require_once('database.class.php');

    class User extends DatabaseObject {

        protected static $dbTable = 'user';
        protected static $dbFields = array('name', 'email', 'password');
        protected $id;
        protected $name;
        protected $email;
        protected $password;
        
        public function __construct($name, $email, $password) {
            $this->name = $name;
            $this->email = $email;
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }

        /**
         * search for user in database
         * if user found check if provided password matches with the found user password
         *          
         * @param [string] $email
         * @param [string] $password
         * @return void
         */
        public static function login($email, $password) {
            $user = self::findByEmail($email);
            if(!$user) {
                Message::addError('error', 'Wrong email or password');
                return;
            }
            if(!password_verify($password, $user['password'])) {
                Message::addError('error', 'Wrong email or password');
                return;
            }
            
            return $user;
        }

        /**
         * search for user in database where email is equal to provided email parameter
         *
         * @param [string] $email
         * @return string|void
         */
        public static function findByEmail($email) {
            $database = Database::instance();
            $connection = $database->connect();
            $sql = "SELECT * FROM user WHERE email = :email";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            if($result) {
                return $result;
            }
            return;
        }

    }