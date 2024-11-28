<?php

use proyecto\app\utils\Utils;
?>

<!-- header-start -->
<header>
    <div class="header-area">
        <div id="sticky-header" class="main-header-area">
            <div class="container">
                <div class="row align-items-center" style="background-color: grey; padding: 10px; border-radius: 20px;">
                    <!-- Logo -->
                    <div class="col-xl-3 col-lg-2">
                        <div class="logo">
                            <a href="/">
                                <img src="../../public/img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <!-- Navigation Menu -->
                    <div class="col-xl-6 col-lg-7">
                        <div class="main-menu white_text d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li class="<?= Utils::esOpcionMenuActiva('/') ? 'active' : '' ?>">
                                        <a href="/">home</a>
                                    </li>
                                    <li class="<?= Utils::esOpcionMenuActiva('/about') ? 'active' : '' ?>">
                                        <a href="/about">about</a>
                                    </li>
                                    <li class="<?= Utils::esOpcionMenuActiva('/recipes') ? 'active' : '' ?>">
                                        <a href="/recipes">recipes</a>
                                    </li>
                                    <li class="<?= Utils::esOpcionMenuActiva('/blog') ? 'active' : '' ?>">
                                        <a href="/blog">blog</a>
                                    </li>

                                    <?php if (is_null($app['user'])): ?>
                                        <!-- Links for guests -->
                                        <li class="<?= Utils::esOpcionMenuActiva('/login') ? 'active' : '' ?>">
                                            <a href="/login">login</a>
                                        </li>
                                        <li class="<?= Utils::esOpcionMenuActiva('/registro') ? 'active' : '' ?>">
                                            <a href="/registro">register</a>
                                        </li>
                                    <?php else: ?>
                                        <!-- Links for logged-in users -->
                                        <li class="<?= Utils::esOpcionMenuActiva('/profile') ? 'active' : '' ?>">
                                            <a href="/profile">profile</a>
                                        </li>
                                        <li class="<?= Utils::esOpcionMenuActiva('/logout') ? 'active' : '' ?>">
                                            <a href="/logout">logout: <?= $app['user']->getUsername() ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                        <!-- Additional space for future functionality -->
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- header-end -->