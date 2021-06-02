<!-- For every page we need to have class to know which page is it (example: index-page, login-page") -->
<main id="main" class="edit-profile-page"> 
    <?php
        // This is example of the page for which user needs to be logged in in the system, so we need to check that
        session_start();
        check_user_login();

        // check_user_login() without arguments should redirect user to the index page if user is not logged in so it won't include any files at all
        // check_user_login('index') with 'index' argument should return true or false because that is how we know which index to load

        // If everythin is allright, we should load modules here
        // require 'module/sidebar.module.php'; etc....
    ?>
</main>