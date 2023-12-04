<?php
$frontId = get_option('page_on_front');
$fileTitle = get_field('file_section_title', $frontId);
$fileDescription = get_field('file_section_description', $frontId);
$argsfiles = [
    'post_type' => 'file',
    'posts_per_page' => 3,


];

$queryfiles = new WP_Query($argsfiles);

?>

<div class="col-sm-12 col-md-6 col-lg-12 file-part">
    <div class="card">
        <div class="card-header d-flex justify-content-between">

            <?php if ($fileTitle) : ?>
                <div class="header-title">
                    <h4 class="card-title truncate-text-1"><?= $fileTitle ?> </h4>
                </div>
            <?php
            endif;
            ?>
        </div>

        <div class="card-body">
            <?php
            if ($fileDescription) : ?>
                <p class="card-text  truncate-text-1"><?= $fileDescription ?></p>
            <?php endif; ?>


            <ul class="list-unstyled p-0 m-0 row">

                <?php

                if ($queryfiles->have_posts()) {
                    while ($queryfiles->have_posts()) : $queryfiles->the_post();

                        $tag_link =  get_permalink(get_the_ID());
                        $thumbnail_id = get_post_thumbnail_id(get_the_ID());

                        $img = wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "w-100 img-fluid"]); ?>
                        <li class="col-6 col-sm-6 col-md-6 col-lg-4 mt-3 pr-2 pl-2">
                            <a href="<?= esc_url($tag_link) ?>">
                                <div class="hover-effects rounded">
                                    <?= $img ?>

                                    <div class="ovrlay-3-a"></div>
                                    <div class="ovrlay-3-b p-2">
                                        <div class="d-flex justify-content-center mb-3">
                                            <h5 class="text-white truncate-text-2"><?= get_the_title(get_the_ID()) ?> </h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                <?php
                    endwhile;

                    wp_reset_postdata();
                }  ?>

            </ul>

        </div>
    </div>


</div>