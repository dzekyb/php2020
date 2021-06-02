<!-- index landing page -->
<?php session_start(); ?>

<!DOCTYPE html>
<?php require_once('include/head.php'); ?>
<body>
<?php if(isset($_SESSION['fullName'])) {
        require_once('include/admin/admin_nav.php');
        require_once('include/admin/admin_sidebar.php');
} else {
    require_once('include/nav.php'); 
}?>
<div class="hero">
    <div class="hero__text">
        <h1>Pricing calculator</h1>
        <p>
            Create your calculator. Configure and provide the estimate costs of your logotip creation services.
        </p>
        <a href="examples" class="intro__button">Examples</a>
        <?php if(!isset($_SESSION['fullName'])) { ?>
            <a href="register" class="intro__button">Sign up</a>
        <?php } ?>
    </div>
    <div class="hero__image">
        <img src="images/finance.svg" alt="Personal finance">
    </div>
</div>
<script src="<?php base(); ?>js/sidebar.js"></script>
</body>
</html>