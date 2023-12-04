<?php
$frontId = get_option('page_on_front');
$blogTitle = get_field('blog_section_title', $frontId);
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'DESC'
);

$latest_posts_query = new WP_Query($args);
?>

<div class="row blog-part">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <?php if ($blogTitle) : ?>
                    <div class="header-title">
                        <h4 class="card-title truncate-text-1"><?= $blogTitle ?> </h4>
                    </div>
                <?php
                endif;
                ?>
            </div>

                <?php

                if ($latest_posts_query->have_posts()) : ?>
                    <div class="card-body blog-row">
                        <div class="row">

                            <?php
                            while ($latest_posts_query->have_posts()) :
                                $latest_posts_query->the_post(); ?>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <?php

                                    get_template_part(
                                        'templates/card/vertical-card',
                                        null,
                                        ['id' => get_the_ID()]
                                    );
                                    ?>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata(); ?>



                        </div>

                    </div>

                <?php
                endif;
                ?>
            </div>
        </div>

    </div>