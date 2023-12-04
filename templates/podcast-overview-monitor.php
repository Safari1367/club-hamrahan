<?php

$categories = get_categories(array(
    'taxonomy' => 'podcast_cat',
    'orderby' => 'term_id',
    'order' => 'ASC',
));

$podcast_monitor_page_id = get_posts([
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'templates/podcast-monitor-single.php'
]);


/*
Template Name: Monitor Podcast overview
*/
get_header();

?>
<div class="content-page rtl-page podcast-monitor-overview" id="podcast-monitor-overview">


    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height">
                    <?php foreach ($categories as $category) : ?>
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0"> <?= $category->name ?> </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row scroll-x no-wrap">

                                <?php

                                $args = array(
                                    'post_type' => 'podcast',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'podcast_cat',
                                            'field' => 'id',
                                            'terms' => $category->term_id,
                                        ),
                                    ),
                                );

                                $query = new WP_Query($args);

                                if ($query->have_posts()) :
                                    while ($query->have_posts()) : $query->the_post(); ?>
                                        <div class="col-xl-3 col-lg-4 col-md-6 ">
                                        <div class="g-box g-desc rounded mb-4 p-3">
                                                <?php  $podcast_monitor_url_with_param = add_query_arg('post_id', get_the_ID(), get_permalink($podcast_monitor_page_id[0]));
?>
                                                <a class="" href="<?= esc_url($podcast_monitor_url_with_param)  ?>">
                                                    <?php $thumbnail_id = get_post_thumbnail_id(get_the_ID()); ?>
                                                    <?= wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "img-fluid b-radius-top"]); ?>
                                                </a>
                                                <div class=" p-2">
                                                    <h4 class="truncate-text-1"><?= get_the_title(get_the_ID()) ?></h4>
                                                    <div class="truncate-text-2 mb-0">
                                                        <?= the_excerpt(get_the_ID()); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                    echo 'هیچ پادکستی یافت نشد.';
                                endif;
                                ?>




                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>




<?php get_footer(); ?>

