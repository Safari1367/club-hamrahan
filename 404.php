<?php
/*
* File Name:        404.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/
get_header(); ?>
<div class="content-page rtl-page">


    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card not-found-page">
                    <div class="not-found-row">

                        <div class="d-flex">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/404.png" class="img-fluid" alt="<?php bloginfo('sitename') ?>">
                        </div>
                        <div class="d-flex btn-box">

                            <h4><?php echo __('به نظر می رسد محتوای مورد نظر شما در دسترس نمی باشد.', 'artdesgin'); ?></h4>

                            <a href="/" class="btn mb-1 btn-primary"><?php echo __('صفحه اصلی', 'artdesign'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php get_footer();
