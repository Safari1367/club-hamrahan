<?php
/*
Template Name: Auth page
*/

?>


    <!doctype html>
    <html dir="rtl">


    <head>
        <!-- <meta charset="<?php bloginfo('charset'); ?>"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php the_title(); ?></title>
        <?php wp_head(); ?>


    </head>

<body class="  ">


<div class="wrapper">
    <section class="auth-content">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100 auth-content">
                <div class="col-12">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-lg-6">

                            <?php
                            the_content();
                            ?>
                        </div>
                        <div class="col-sm-12 col-lg-6 mb-lg-0 mb-4 mt-lg-0 mt-4">
                            <img src="<?= get_stylesheet_directory_uri() ?>/assets/img/01.png" class="img-fluid w-80"
                                 alt="login-page">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>






<?php

wp_footer();