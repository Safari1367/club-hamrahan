<?php
$pageId = get_queried_object_id();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$argsPodcast = array(
    'post_type' => 'podcast',
    'paged' => $paged,
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC',
);

$allPodcast = new WP_Query($argsPodcast);



/*
Template Name: Radio overview
*/
get_header();

?>
?>
<div class="content-page rtl-page radio-overview">
    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>

        <div class="row">

            <div class="col-sm-12 col-md-8 col-lg-9">

                <div class="card card-block card-stretch card-height blog blog-detail">
                    <div class="card-header pr-4 pt-3 radio-logo d-flex">

                        <h1> <?= get_the_title(); ?> </h1>
                        <img src="<?= get_stylesheet_directory_uri() ?>/assets/img/radio-show.png" alt="">
                    </div>

                    <div class="card-body">

                        <?php
                        get_template_part('templates/content/content');

                        if ($allPodcast->have_posts()) :
                        ?>

                            <div class="row podcast-row">
                                <?php

                                while ($allPodcast->have_posts()) {
                                    $allPodcast->the_post(); ?>
                                    <div class="col-box col-sm-6 col-md-6 col-lg-4 col-xl-3 card-height pr-2 pl-2 ">
                                        <?php

                                        get_template_part(
                                            'templates/card/podcast-card',
                                            null,
                                            ['id' => get_the_ID()]
                                        );
                                        ?>
                                    </div>
                                <?php

                                } ?>

                              
                            </div>
                            <?php
                            echo '<div class="pagination">';
                            echo paginate_links(array(
                                'total' => $allPodcast->max_num_pages,
                                'current' => $paged,
                                'prev_text' => 'قبلی',
                                'next_text' => 'بعدی',
                                'end_size' => 1,
                                'mid_size' => 1,
                            ));
                            echo '</div>';


                        endif; ?>
                    </div>
                </div>



            </div>
            <?php dynamic_sidebar('main_sidebar'); ?>
            <?php get_sidebar() ?>

        </div>


    </div>
</div>

<?php get_footer(); ?>