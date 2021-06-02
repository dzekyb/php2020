<?php

/*** Function for loading the page ***/
function load_page($page, $data = null){
    // Check is page empty. If it is, load the default page
    if($page === ''){
        require 'pages/index.page.php';
        return;
    }
    // Create whitelist so nonexisting page cannot be loaded, and pages with third argument can be loaded without problems
    switch($page){
        // Normal pages in whitelist
        case 'login':
        case 'register':
        case 'password-reset':
            require 'pages/' . $page . '.page.php';
        break;
        // Example of the page with third argument ($data)
        case 'confirm-account':
            // Call the function to confirm account first and send it data
            // That function will know is this token for confirming account real or not (we are not interested in that here)
            // It should return true or false
            if(confirm_account($data)){
                require 'pages/confirm-account-success.page.php';
            }else{
                require 'pages/confirm-account-failed.page.php';
            }
        break;
        case 'confirm-password':
            // Call the function to confirm password first and send it data
            // That function will know is this token for confirming password real or not (we are not interested in that here)
            // It should return true or false
            if(confirm_password($data)){
                require 'pages/confirm-password-success.page.php';
            }else{
                require 'pages/confirm-password-failed.page.php';
            }
        break;
        default:
            // Load index by default
            require 'pages/index.page.php';
        return;
    }
}

function setLanguage(){}