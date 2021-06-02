<aside class="sidebar">
    <ul>
        <li class="sidebar__dropdown-toggle">
            <div class="sidebar__menu-link d-flex ai-c relative sidebar__border">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                </span>
                <span  class="sidebar__menu-text">Firme <i class="sidebar__arrow fas fa-angle-left"></i></span>
            </div>
            <ul class="sidebar__menu-dropdown list-style-none">
                <li class="sidebar__border">
                    <a href="<?php base(); ?>firms" class="sidebar__menu-link d-flex ai-c">
                        <span>
                            <span class="sidebar__menu-icon">
                                <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="sidebar__menu-text">Firme</span>
                    </a>
                </li>
                <li class="sidebar__border">
                    <a href="<?php base(); ?>add_firm" class="sidebar__menu-link d-flex ai-c">
                        <span class="d-iblock">
                            <span class="sidebar__menu-icon">
                                <i class="fas fa-plus"></i>
                            </span>
                        </span>
                        <span class="sidebar__menu-text">Dodajte firmu</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar__dropdown-toggle">
            <div class="sidebar__menu-link d-flex ai-c relative  sidebar__border">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-users"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Klijenti <i class="sidebar__arrow  fas fa-angle-left"></i></span>
            </div>
            <ul class="sidebar__menu-dropdown list-style-none">
                <li class="sidebar__border">
                    <a href="<?php base(); ?>clients" class="sidebar__menu-link d-flex ai-c">
                        <span class=" ">
                            <span class="sidebar__menu-icon">
                            <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="sidebar__menu-text">Klijenti</span>
                    </a>
                </li>
                <li class="sidebar__border">
                    <a href="<?php base(); ?>add_client" class="sidebar__menu-link d-flex ai-c">
                    <span class="d-iblock">
                        <span class="sidebar__menu-icon">
                        <i class="fas fa-plus"></i>
                        </span>
                    </span>
                    <span class="sidebar__menu-text">Dodaj klijenta</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar__dropdown-toggle">
            <div class="sidebar__menu-link d-flex ai-c relative  sidebar__border">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Fiskalni računi <i class="sidebar__arrow  fas fa-angle-left"></i></span>
            </div>
            <ul class="sidebar__menu-dropdown list-style-none">
                <li class="sidebar__border">
                    <a href="<?php base(); ?>bills" class="sidebar__menu-link d-flex ai-c">
                        <span class=" ">
                            <span class="sidebar__menu-icon">
                            <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="sidebar__menu-text">Fiskalni računi </span>
                    </a>
                </li>
                <li class="sidebar__border">
                    <a href="<?php base(); ?>add_bill" class="sidebar__menu-link d-flex ai-c">
                    <span class="d-iblock">
                        <span class="sidebar__menu-icon">
                        <i class="fas fa-plus"></i>
                        </span>
                    </span>
                    <span class="sidebar__menu-text">Dodaj račun</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar__dropdown-toggle">
            <div class="sidebar__menu-link d-flex ai-c relative sidebar__border ">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-archive"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Artikli <i class="sidebar__arrow  fas fa-angle-left"></i></span>
            </div>
            <ul class="sidebar__menu-dropdown list-style-none">
                <li class="sidebar__border">
                    <a href="<?php base(); ?>articles" class="sidebar__menu-link d-flex ai-c">
                        <span class=" ">
                            <span class="sidebar__menu-icon">
                            <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="sidebar__menu-text">Artikli</span>
                    </a>
                </li>
                <li class="sidebar__border">
                    <a href="<?php base(); ?>add_article" class="sidebar__menu-link d-flex ai-c">
                    <span class="d-iblock">
                        <span class="sidebar__menu-icon">
                        <i class="fas fa-plus"></i>
                        </span>
                    </span>
                    <span class="sidebar__menu-text">Dodaj artikal</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar__dropdown-toggle">
            <div class="sidebar__menu-link d-flex ai-c relative sidebar__border ">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-file-invoice"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Fakture <i class="sidebar__arrow  fas fa-angle-left"></i></span>
            </div>
            <ul class="sidebar__menu-dropdown list-style-none">
                <li class="sidebar__border">
                    <a href="<?php base(); ?>invoices" class="sidebar__menu-link d-flex ai-c">
                        <span class=" ">
                            <span class="sidebar__menu-icon">
                            <i class="fas fa-list"></i>
                            </span>
                        </span>
                        <span class="sidebar__menu-text">Fakture</span>
                    </a>
                </li>
                <li class="sidebar__border">
                    <a href="<?php base(); ?>add_invoice" class="sidebar__menu-link d-flex ai-c">
                        <span class="d-iblock">
                            <span class="sidebar__menu-icon">
                            <i class="fas fa-plus"></i>
                            </span>
                        </span>
                        <span class="sidebar__menu-text">Kreiraj fakturu</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar__border">
            <a href="<?php base(); ?>include/logout.inc.php" class="sidebar__menu-link d-flex ai-c relative  ">
                <span class="d-iblock">
                    <span class="sidebar__menu-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                </span>
                <span class="sidebar__menu-text">Izloguj se</span>
            </a>
        </li>
    </ul>
</aside>
<div class="sidebar-overlay"></div>