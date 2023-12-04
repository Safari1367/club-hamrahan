<?php
$frontId = get_option('page_on_front');
$discountTitle = get_field('discount_section_title', $frontId);

$discounts = get_field('choose_discounts', $frontId);

$alldiscount = [];
if (is_array($discounts) && count($discounts) > 0) {
    foreach ($discounts as $item) :
        $alldiscount[] = $item->ID;

    endforeach;
} else {
    $discounts = wp_get_recent_posts(['post_type' => 'discount', 'posts_per_page' => 10]);

    foreach ($discounts as $item) :
        $alldiscount[] = $item['ID'];
    endforeach;
}
?>
<div class="col-sm-6 col-md-6 col-lg-3 discount-part">
    <div class="card card-block card-stretch card-height">
        <div class="card-header d-flex justify-content-between">
            <?php if ($discountTitle) : ?>
                <div class="header-title">
                    <h4 class="card-title"><?= $discountTitle ?></h4>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">

            <ul class="list-group rtl-list-group">
                <?php

                foreach ($alldiscount as $item) : ?>
                    <li class="list-group-item "><a href="<?= get_permalink($item); ?>" class=""><?= get_the_title($item); ?></a></li>
                <?php endforeach;

                ?>
            </ul>

        </div>
    </div>
</div>