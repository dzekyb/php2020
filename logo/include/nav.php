<header>
    <nav class="navigation index-nav">
        <a href="index" class="navigation__link logo">LOGOTIP</a>
        <ul class="navigation__menu">
            <?php if(isset($_SESSION['id'])) { ?>
                <li><a href="<?php base(); ?>calculators" class="navigation__link">Dashboard</a></li>
                <li><a href="<?php base(); ?>include/logout.inc.php" class="navigation__link">Logout</a></li>
            <?php } else { ?>
                <li><a href="<?php base(); ?>login" class="navigation__link">Login</a></li>
                <li><a href="<?php base(); ?>register" class="navigation__link">Register</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>