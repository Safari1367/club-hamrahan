<?php
$frontId = get_option('page_on_front');
$heroTitle = get_field('hero_title', $frontId);
$heroImg = get_field('hero_img', $frontId);
?>
<div class="row hero">
    <div class="col-lg-12 mb-4">
        <div class="d-flex align-items-center justify-content-between welcome-content">
            <div class="navbar-breadcrumb">
                <?php if ($heroTitle) : ?>
                    <h1 class="mb-0"><?= $heroTitle ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-6 image-column">

        <?php if ($heroImg) : ?>
            <div class="card card-block card-stretch card-height p-0">
                <?= wp_get_attachment_image($heroImg, 'full', false, ["class" => "img-fluid rounded w-100"]); ?>
            </div>
        <?php endif; ?>

    </div>