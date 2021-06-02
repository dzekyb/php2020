<?php

    class Sanitize {

        /**
         * sanitize user input
         *
         * @param [mixed] $value
         * @return mixed
         */
        public static function sanitizeString($value) {
            $value = trim($value);
            $value = htmlspecialchars($value);
            return $value;
        }

    }

?>