<?php

    class Message {
        
        private static $error;

        public static function addError($key, $error) {
            self::$error[$key] = $error;
        }
        public static function getError() {
            return self::$error;
        }
    }

?>