<?php
/*** Function for loading the page ***/
function load_page($page){
    // Check is page empty. If it is, load the default page
    if($page === ''){
        require 'pages/index.php';
        return;
    }
    // Create whitelist so nonexisting page cannot be loaded, and pages with third argument can be loaded without problems
    switch($page){
        // Normal pages in whitelist
        case 'login':
        case 'register':
        case 'calculators':
        case 'questions':
        case 'add_question':
        case 'create_calc':
        case 'edit':
        case 'estimate':
        case 'calculator_redirect':
        case 'archived':
        case 'examples':
            require 'pages/' . $page . '.php';
        break;  
        default:
            // Load index by default
            require 'pages/index.php';
        return;
    }
}

    if(isset($_GET['page']) && !empty($_GET['page'])){

    load_page($_GET['page']);
    }
?>