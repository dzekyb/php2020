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
        case 'firms':
        case 'add_firm':
        case 'update_firm':
        case 'articles':
        case 'add_article':
        case 'clients':
        case 'add_client':
        case 'update_client':
        case 'bills':
        case 'add_bill':
        case 'invoices':
        case 'add_invoice':
        case 'update_invoice':
        case 'render_pdf':
        case 'pdf_preview':
            require 'pages/' . $page . '.php';
        break;
        default:
            // Load index by default
            require 'pages/index.php';
        return;
    }
}

    if(isset($_GET['page']) && !empty($_GET['page'])){


    /*** Call loading function from includes/functions.php ***/
    load_page($_GET['page']);
    }
?>