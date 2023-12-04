<?php
$s = get_search_query();
$args = array(
    's' => $s
);
// count search query
$the_query = new WP_Query($args);
$count = 0;
foreach ($the_query->posts as $post) {

    $count++;
}


get_header()
?>

<div class="content-page rtl-page">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h3 class="card-title"> نتیجه جستجو برای( <?= get_search_query(); ?> )</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <?php if ($count <= 0) : ?>
                                <div class="col-md-12">
                                    <h4>متاسفانه چیزی یافت نشد</h4>
                                    <div class="col-sm-12 text-center align-self-center mt-4">
                                        <div class="iq-error position-relative">
                                            <img src="<?= get_stylesheet_directory_uri() ?>/assets/img/empty.png" alt="" class="img-fluid">

                                        </div>
                                    </div>

                                </div>
                            <?php else : ?>

                                <?php if (have_posts()) :
                                    while (have_posts()) : the_post(); ?>

                                        <div class="col-lg-6">
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
                                endif;
                                ?>

                            <?php endif; ?>


                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>