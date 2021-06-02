<nav class="navigation d-flex jc-sb ai-c">
    <a href="<?php base(); ?>index" class="logo d-flex jc-c ai-c">
        <?php if(isset($_COOKIE['theme'])) { ?>
            <img src="<?php base(); ?>images/logo-2.png" class="logo__image" id="theme-logo" alt="Lab387 logo">
        <?php } else{ ?>
            <img src="<?php base(); ?>images/logo.png" class="logo__image" id="theme-logo" alt="Lab387 logo">
        <?php } ?>
    </a>
    <ul class="navigation__menu ai-c">
        <li class="d-flex ai-c">
            <?php if(isset($_COOKIE['theme'])) { ?>
                <img src="<?php base(); ?>images/default2.png" class="user__image" id="theme-image" alt="Default avatar">
            <?php } else{ ?>
                <img src="<?php base(); ?>images/default.png" class="user__image" id="theme-image" alt="Default avatar">
            <?php } ?>
            <a href="<?php base(); ?>index" class="navigation__link pointer"><?php echo $_SESSION['name'] ?></a>
        </li>
        <li class="pointer">
            <i class="fas fa-adjust dark-mode" id="theme-toggle"></i>
        </li>
    </ul>
</nav>
<div id="sidebar-toggle">
    <i class="fas fa-bars"></i>
</div>