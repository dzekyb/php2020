<?php 

    spl_autoload_register('myAutoloader');

    function myAutoloader($className) {
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $ext = '.class.php';
        if(strpos($url, 'include')) {
            $path = '../classes/';
        } else {
            $path = 'classes/';
        }
        $className = strtolower($className);
        $fullName = $path . $className . $ext;
        if(!file_exists($fullName)) {
            return;
        }
        require_once $fullName;
    }
?>