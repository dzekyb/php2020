<?php 
    if(isset($_SESSION['id'])) { 
        require_once('admin_nav.php');
        require_once('admin_sidebar.php');
    } else {
?>

<nav>
    <div class="index-wrapper">
        <div class="navigation d-flex jc-sb ai-c">
            <a href="index d-flex jc-c ai-c">
                <img src="<?php base(); ?>images/logo.png" class="logo__image" alt="Lab387 logo">
            </a>
            <ul class="navigation__menu">
                <li><a href="<?php base(); ?>index" class="navigation__link">Početna</a></li>            
                <li><a href="<?php base(); ?>login" class="navigation__link">Prijava</a></li>
                <li><a href="<?php base(); ?>register" class="navigation__link">Napravi nalog</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php } ?>