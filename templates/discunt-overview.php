<?php

/*
Template Name: discount overview
*/

get_header();

$termArgs = get_terms(array(
    'taxonomy' => 'discount_cat',
    'hide_empty' => false
));
$all_terms = new WP_Query($termArgs);
$discountTerms = $all_terms->query;


?>

<div class="content-page rtl-page discount-overview">
    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>

        <?php
        get_template_part('templates/content/content')
        ?>



        <div class="row">
            <?php
            if (is_array($discountTerms) && count($discountTerms) > 0) :
                foreach ($discountTerms as $term) :
                    $discountTermArgs = array(
                        'post_type' => 'discount',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'discount_cat',
                                'field' => 'id',
                                'terms' => $term->term_id,

                            ),
                        ),
                    );

                    $discountTermQuery = new WP_Query($discountTermArgs);


                    if ($discountTermQuery->have_posts()) {
                        $discountPostCount = $discountTermQuery->found_posts;
            ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="card card-height">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="d-flex discubt-card-head">
                                        <i class="icon-folder-open"></i>
                                        <h3 class="truncate-text-1"> <?= $term->name ?> </h3>
                                    </div>
                                    <span class=""><?= $discountPostCount ?> </span>
                                </div>
                                <div class="card-body">

                                    <ul class="list-group">
                                        <?php

                                        $disuntNum = 1;
                                        while ($discountTermQuery->have_posts()) :  $discountTermQuery->the_post();
                                            if ($disuntNum < 3) :
                                        ?>

                                                <li class="truncate-text-1 list-group-item d-flex">
                                                    <i class="icon-tablet-rugged"></i>
                                                    <a href="<?= get_permalink(get_the_ID()); ?>"><span> <?= get_the_title() ?></span> </a>
                                                </li>

                                        <?php
                                            endif;
                                            $disuntNum++;
                                        endwhile;

                                        ?>


                                    </ul>

                                    <a class="btn btn-outline-primary rounded-pill mt-2" href="<?= get_term_link($term->term_id) ?>">
                                        تخفیف بیشتر</a>

                                </div>
                            </div>
                        </div>

            <?php
                        wp_reset_postdata();
                    }
                //  else {
                //     echo 'هیچ تخفیفی در این دسته‌بندی یافت نشد.';
                // }    
                endforeach;

            endif; ?>
        </div>
    </div>
</div>



<?php get_footer(); ?>