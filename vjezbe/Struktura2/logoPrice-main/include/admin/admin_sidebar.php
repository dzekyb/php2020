<aside class="sidebar">
    <div class="sidebar__user">
        <img src="<?php base(); ?>images/avatar.png" alt="">
        <h4><?php echo $_SESSION['fullName']; ?></h4>
    </div>
    <ul class="sidebar__menu">
        <li>
            <a href="<?php base(); ?>calculators" class="sidebar__menu-link">
                <span>
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                </span>
                <span  class="sidebar__menu-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php base(); ?>create_calc" class="sidebar__menu-link">
                <span>
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Create Calculator</span>
            </a>
        </li>
        <li>
            <a href="<?php base(); ?>archived" class="sidebar__menu-link">
                <span>
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-archive"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Archived Calculators</span>
            </a>
        </li>
    </ul>
</aside>
<div class="sidebar-overlay"></div>