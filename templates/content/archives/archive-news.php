<?php
get_header();

$catObject = get_queried_object();
$taxonomy = $catObject->taxonomy;

$template_mapping = array(
    'discount_cat' => 'templates/discount-overview.php',
    'news_cat' => 'templates/news-overview.php',
);

// Get the template for the current taxonomy
$template = isset($template_mapping[$taxonomy]) ? $template_mapping[$taxonomy] : '';

// Get the post type for the current taxonomy
$postType = ($taxonomy == 'discount_cat') ? 'discount' : 'news';

// Get the overview page ID for the current template
$overview_page_id = get_posts(array(
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => $template,
));

// Get all terms for the current taxonomy
$args = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false
));
$all_terms = new WP_Query($args);
$terms = $all_terms->query;

// Query posts based on the current term and post type
$termArgs = array(
    'post_type' => $postType,
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => $taxonomy,
            'field' => 'id',
            'terms' =>  $catObject->term_id,
        ),
    ),
);

$TermQuery = new WP_Query($termArgs); ?>

<div class="content-page rtl-page news-cat">

    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <!--mobile drop down -->
                <select class="cat-drop-down form-control">
                    <option value="<?= the_permalink($overview_page_id[0]); ?>" <?= ($catObject->term_id  == $overview_page_id[0]) ? 'selected' : ''; ?>>همه
                    </option>
                    <?php foreach ($terms as $key => $cat) :
                        if ($key < 4) : ?>
                            <option <?= ($catObject->term_id  == $cat->term_id)  ? 'selected' : ''; ?> value="<?= get_term_link($cat->term_id) ?>"><?= $cat->name ?> </option>
                    <?php
                        endif;
                    endforeach; ?>
                </select>
                <ul class="d-flex cat-li">
                    <li class="category-tab  <?= ($catObject->term_id == $overview_page_id[0]) ? 'active-cat' : ''; ?>">
                        <a href="<?= the_permalink($overview_page_id[0]); ?>">همه</a>
                    </li>

                    <?php foreach ($terms as $key => $cat) :
                        if ($key < 4) : ?>
                            <li class="category-tab <?= ($catObject->term_id == $cat->term_id) ? 'active-cat' : ''; ?>">
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

                    if ($TermQuery->have_posts()) {
                        while ($TermQuery->have_posts()) : $TermQuery->the_post();
                    ?>
                            <div class="card-box col-lg-6">
                                <?php
                                if ($catObject->taxonomy == 'discount_cat') {

                                ?>

                                    <div class="card card-block card-stretch card-height blog blog-list">
                                        <div class="card-body">
                                            <div class="d-flex flex-wrap align-items-center">
                                                <div class="col-md-3 p-2">
                                                    <?php $thumbnail_id = get_post_thumbnail_id(get_the_ID()); ?>
                                                    <?= wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "img-fluid rounded w-100"]); ?>

                                                </div>
                                                <div class="col-md-9 mt-3 mt-md-0 p-2">
                                                    <div class="blog-description">
                                                        <a href="<?= get_permalink(get_the_ID()) ?>">
                                                            <h4 class="mb-2 truncate-text-1">
                                                                <?= get_the_title(get_the_ID()); ?>
                                                            </h4>
                                                        </a>

                                                        <div class="truncate-text-1  mb-2 border-bottom">

                                                            <?= the_excerpt(get_the_ID()); ?>
                                                        </div>
                                                        <div class="d-flex justify-content-between  pb-2">
                                                            <div class="blog-meta-date">
                                                                <div class="date">
                                                                    اعتبار
                                                                    <?= get_the_date('F j, Y', get_the_ID()); ?>
                                                                </div>

                                                            </div>
                                                            <div class="blog-meta d-flex align-items-center">

                                                                <a href="<?= get_permalink(get_the_ID()) ?>" class="btn btn-outline-primary rounded-pill mt-2" <?= get_permalink(get_the_ID()) ?>" tabindex="-1">بخوانید <i class="ri-arrow-right-s-line"></i></a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                } else {
                                    get_template_part(
                                        'templates/card/horizontal-card',
                                        null,
                                        ['id' => get_the_ID()]
                                    );
                                }

                                ?>


                            </div>

                    <?php
                        endwhile;

                        wp_reset_postdata();
                    } else {
                        echo 'هیچ آیتمی در این دسته‌بندی یافت نشد.';
                    }

                    ?>
                </div>

            </div>

        </div>

    </div>



</div>
</div>

<?php get_footer(); ?>