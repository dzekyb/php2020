<?php

/*** First: Load language JSON File, convert it to the associative array and save to the variable ***/

if(isset($_GET['language']) && !empty($_GET['language'])){
    // Load the language file if exists
}else{
    // Load the default language file
}
    // Convert the file and save


/*** Second: Load the page user wanted to visit ***/
if(isset($_GET['page']) && !empty($_GET['page'])){
    
    /*** Get the third argument ***/
    @$data = $_GET['data'];

    /*** Call loading function from includes/functions.php ***/
    load_page($_GET['page'], $data);
}

