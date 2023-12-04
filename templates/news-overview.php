<?php


/*
Template Name: News overview
*/
get_header();

$pageId = get_queried_object_id();
$news_page_id = get_posts([
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'templates/news-overview.php'
]);

$args = get_terms(array(
    'taxonomy' => 'news_cat',
    'hide_empty' => false
));
$all_terms = new WP_Query($args);
$terms = $all_terms->query;



$args = [
    'post_type' => 'news',
    'posts_per_page' => -1,
    'taxonomy' => 'news_cat',

];
$query = new WP_Query($args);

?>

<div class="content-page rtl-page news-cat">

    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>



        <?php
        get_template_part('templates/content/content')
        ?>

        <div class="row">
            <div class="col-sm-12">
                <!--mobile drop down -->
                <select class="cat-drop-down form-control">
                    <option value="<?= the_permalink($news_page_id[0]); ?>" <?= ($pageId == $news_page_id[0]) ? 'selected' : ''; ?>>همه
                    </option>
                    <?php foreach ($terms as $key => $cat) :
                        if ($key < 4) :
                    ?>
                            <option <?= ($pageId == $cat->term_id)  ? 'selected' : ''; ?> value="<?= get_term_link($cat->term_id) ?>"><?= $cat->name ?> </option>
                    <?php
                        endif;
                    endforeach; ?>
                </select>
                <ul class="d-flex cat-li">
                    <li class="category-tab  <?= ($pageId == $news_page_id[0]) ? 'active-cat' : ''; ?>">
                        <a href="<?= the_permalink($news_page_id[0]); ?>">همه</a>
                    </li>

                    <?php foreach ($terms as $key => $cat) :
                        if ($key < 4) :
                    ?>
                            <li class="category-tab <?= ($pageId == $cat->term_id) ? 'active-cat' : ''; ?>">
                                <a href="<?= get_term_link($cat->term_id) ?>"><?= $cat->name ?></a>
                            </li>
                    <?php
                        endif;
                    endforeach; ?>
                </ul>

            </div>
            <div class="col-sm-12">
                <div class="row">
                    <?php

                    if ($query->have_posts()) {
                        while ($query->have_posts()) : $query->the_post();
                    ?>
                            <div class="card-box col-lg-6">
                                <?php

                                get_template_part(
                                    'templates/card/horizontal-card',
                                    null,
                                    ['id' => get_the_ID()]
                                );
                                ?>


                            </div>

                    <?php
                        endwhile;

                        wp_reset_postdata();
                    } else {
                        echo 'هیچ خبری در این دسته‌بندی یافت نشد.';
                    }

                    ?>
                </div>

            </div>
        </div>

    </div>



</div>
</div>

<?php get_footer(); ?>