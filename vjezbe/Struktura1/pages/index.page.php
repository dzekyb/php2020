
<!-- For every page we need to have class to know which page is it (example: index-page, login-page") -->
<main id="main" class="index-page"> 

    <?php
        // Here we are going to see is user logged in or not, to know which type of index to load and what to show user
        // All pages who require for user to be logged in, need to have a check on the top of it to see is he logged in or not
        if(check_user_login('index')){
            require 'pages/index-logged.page.php';
        }else{
            require 'pages/index-unlogged.page.php';
        }
    ?>

</main> 