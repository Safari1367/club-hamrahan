<?php
$frontId = get_option('page_on_front');
$radioTitle = get_field('radio_section_title', $frontId);
$radioDescription = get_field('radio_section_description', $frontId);
$radios = get_field('choose_radios', $frontId);


$allRadios = [];
if (is_array($radios) && count($radios) > 0) {
    foreach ($radios as $item) :
        $allRadios[] = $item->ID;

    endforeach;
} else {
    $radios = wp_get_recent_posts(['post_type' => 'podcast', 'posts_per_page' => 6]);

    foreach ($radios as $item) :
        $allRadios[] = $item['ID'];
    endforeach;
}
?>

<div class="col-sm-12 col-md-6 col-lg-4 front-radio">
    <div class="card card-block card-stretch card-height">
        <div class="card-header d-flex justify-content-between">
            <?php if ($radioTitle) : ?>
                <div class="header-title">
                    <h4 class="card-title truncate-text-1"><?= $radioTitle ?> </h4>
                </div>
            <?php
            endif;
            ?>
        </div>
        <div class="card-body">
            <?php if ($radioDescription) : ?>
                <p class="mb-0 truncate-text-2"><?= $radioDescription ?> </p>
            <?php
            endif;
            ?>
            <ul class="list-unstyled p-0 m-0 row">

                <?php
                if ($allRadios && !is_wp_error($allRadios)) {
                    foreach ($allRadios as $radio) :
                        $tag_link =  get_permalink($radio);
                        $thumbnail_id = get_post_thumbnail_id($radio);

                        $img = wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "w-100 img-fluid"]); ?>

                        <li class="col-6 col-sm-6 col-md-6 col-lg-4 mt-3 pr-2 pl-2">
                            <a href="<?= esc_url($tag_link) ?>">
                                <div class="hover-effects rounded">
                                    <?= $img ?>

                                    <div class="ovrlay-3-a"></div>
                                    <div class="ovrlay-3-b p-2">
                                        <div class="d-flex justify-content-center mb-3">
                                            <h5 class="text-white truncate-text-2"><?= get_the_title($radio) ?> </h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                <?php endforeach;
                } else {
                    echo 'هیچ پادکستی یافت نشد.';
                } ?>

            </ul>
        </div>
    </div>
</div>