<?php
get_header();

$cat = get_queried_object();

$args = array(
    'post_type' => 'podcast',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => $cat->taxonomy,
            'field' => 'id',
            'terms' => $cat->term_id,
        ),
    ),
);

$query = new WP_Query($args);
?>

<div class="content-page rtl-page archive-page radio-archive">


    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-4">
                   
                        <div class="header-title border-b pb-3 mb-3">
                            <h2 class="card-title"><?= $cat->name ?></h4>
                        </div>
                 
                                <div class="row">
                                    <?php

                                    if ($query->have_posts()) {
                                        while ($query->have_posts()) : $query->the_post();
                                    ?>
                                            <div class="col-box col-sm-6 col-md-6 col-lg-4 col-xl-3 ">

                                                <?php

                                                get_template_part(
                                                    'templates/card/podcast-card',
                                                    null,
                                                    ['id' => get_the_ID()]
                                                );
                                                ?>
                                            </div>

                                    <?php
                                        endwhile;

                                        wp_reset_postdata();
                                    } else {
                                        echo 'هیچ پادکستی در این دسته‌بندی یافت نشد.';
                                    }

                                    ?>

                                </div>    
                   
                </div>
            </div>
        </div>



    </div>
</div>

<?php
get_footer();

?>