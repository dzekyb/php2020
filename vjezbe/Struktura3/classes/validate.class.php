<?php 

    class Validate {

        /**
         * array for file upload errors, more user friendly
         *
         * @var array
         */
        public static $fileUploadError = array(
            UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
            UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
            UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
            UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload.");
        
        /**
         * if string is empty add error message
         * if string does not match the pattern add error message
         * allowed alfanumeric characters, spaces and / . -
         *
         * @param [string] $key
         * @param [string] $string
         * @return void
         */
        public static function validateString($key, $string) {
            if(empty($string)) {
                Message::addError($key, 'Polje ne smije biti prazno');
                return;
            }
            if(!preg_match('/^[a-zA-Z\p{L}0-9\-\/\s,\.\?]*$/u', $string)) {
                Message::addError($key, 'Polje može da sadrži slova, brojeve, razmake i specijalne karaktere . / ? -');
                return;
            }
        }

        /**
         * if username empty add error message
         * if username does not match pattern add error message
         * allowed alfanumeric characters and spaces
         *
         * @param [string] $string
         * @return void
         */
        public static function validateUsername($string) {
            if(empty($string)) {
                Message::addError('username', 'Polje ne smije biti prazno');
                return;
            }
            if(!preg_match('/^[a-zA-Z0-9\s]*$/', $string)) {
                Message::addError('username', 'Polje može da sadrži samo slova i brojeve');
                return;
            }
        }

        /**
         * if email empty add error message
         * if email not valid add error message
         *
         * @param [string] $email
         * @return void
         */
        public static function validateEmail($email) {
            if(empty($email)) {
                Message::addError('email', 'Email polje ne smije biti prazno');
                return;
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Message::addError('email', 'Email nije validan');
                return;
            }
        }

        /**
         * if passsword empty add error message
         * if password does not match confirm add error message
         * if password is not at least 6 characters long add error message
         * if password does not have one lowercase, one uppercase character add error message
         * if password does not have one number add error message
         *
         * @param [string] $password
         * @param [string] $confirm
         * @return void
         */
        public static function passwordMatch($password, $confirm) {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
    
            if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
                Message::addError('password', 'Lozinka more da sadrži 6 karaktera, 1 broj,
                                  1 veliko i 1 malo slovo');
                return;
            }
            if(empty($password)) {
                Message::addError('password', 'Polje ne smije biti prazno');
                return;
            }
            if($password !== $confirm) {
                Message::addError('password', 'Lozinke nisu iste');
                return;
            }
        }

        /**
         * validate if user input is numeric
         *
         * @param [string] $key
         * @param [int] $number
         * @return void
         */
        public static function validateNumber($key, $number){
            if(!is_numeric($number)) {
                Message::addError($key, 'Please provide valid price');
                return;
            }
        }

        /**
         * if file not uploaded just return
         * allowed file extensions are 'jpg, jpeg, png'
         * if file extension not in allowed file extensions add error message
         * if file error code not equal to 0 or 4 add error message
         * if file size greater than 2000000 add error message
         *
         * @param [type] $key
         * @param [type] $k
         * @return void
         */
        public static function validateFile($key, $k){
            if($_FILES[$k]['error'] == 4) {
                return;
            }
            $allowed = array('jpg', 'jpeg', 'png');
            $extension = pathinfo($_FILES[$k]["name"], PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if(!in_array($extension, $allowed) && !empty($extension)) {
                Message::addError($key, 'Dozvoljeni su samo JPG, JPEG, PNG formati slike.');
                return;
            } 
            if($_FILES[$k]['error'] != 4 && $_FILES[$k]['error'] != 0) {
                Message::addError($key, Validate::$fileUploadError[ $_FILES[$k]['error']]);
                return;
            }
            if (($_FILES[$k]["size"] > 2000000)) {
                Message::addError($key, "Veličina slike ne smije biti veća od 2MB");
                return;
            }
        }
    } // end of class
?>