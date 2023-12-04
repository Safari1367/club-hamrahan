<!doctype html>
<html dir="rtl">


<head >
    <!-- <meta charset="<?php bloginfo('charset'); ?>"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php the_title(); ?></title>

    <!-- Favicon -->
    <!-- <link rel="stylesheet" href="http://hamrahanclub.local/wp-content/themes/club/assets/css/backend-plugin.min28b5.css?v=2.0.0"> -->
    <?php wp_head(); ?>


</head>
<?php 
  $user_roles = wp_get_current_user()->roles;
?>
      
<body class=" " id= " <?= is_user_logged_in() && in_array('administrator', $user_roles) ? 'user-is-admin': ''?>">
    <!-- loader Start -->


    <div id="loading">
        <div class="iq-loader-box">
            <div class="iq-loader-13"></div>
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->


    <div class="wrapper">

        <?php
        get_template_part('templates/content/menu-sidebar')

        ?>
        <div class="iq-top-navbar rtl-iq-top-navbar ">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="icon-align-justify wrapper-menu"></i>
                        <a href="index.html" class="header-logo">
                            <!-- <img src="https://www.hamrahanefarda.com/wp-content/themes/hamrahanefarda/assets/img/logo.png" class="mobile img-fluid rounded-normal light-logo" alt="logo"> -->

                        </a>
                    </div>
                    <div class="iq-search-bar device-search">

                        <form class="searchbox" role="search" method="get" id="searchform" action="<?= get_bloginfo('url') ?>">
                            <div class="search-input">
                                <i class="icon-search"></i>
                                <input type="text" value="" name="s" id="s" class="text" placeholder="جستجو ...">
                            </div>
                        </form>
                    </div>
                    <div class="d-flex align-items-center">

                        <button class="navbar-toggler iq-user-toggle" id="custom-navbar-account" type="button">
                            <i class="icon-user-cog"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="mobile-toggle-active">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">

                                <li class="nav-item nav-icon dropdown">

                                </li>
                                <li class="nav-item iq-full-screen"><a href="#" class="" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a></li>

                                <?php
                                get_template_part('templates/content/user-account');
                                ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>