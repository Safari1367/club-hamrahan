<?php
/*
* File Name:        index.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/
get_header(); ?>
<div class="row">
    <div class="col-lg-12">
        <main class="main-box main-container error_404">
            <h1>
                <?php echo __('پیدا نشد!', 'artdesign'); ?>
            </h1>
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/404.png" class="img-fluid" alt="<?php bloginfo('sitename') ?>">
                <div class="error_404_text">
                    <?php echo __('به نظر می رسد محتوای مورد نظر شما در دسترس نمی باشد.', 'artdesgin'); ?>
                </div>
                <div class="error_404_btn">
                    <a href="/"><?php echo __('صفحه اصلی', 'artdesign'); ?></a>
                </div>
            </div>
        </main>
    </div>
</div>
<?php get_footer();
