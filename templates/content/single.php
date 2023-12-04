<div class="image-block single-img-box">
    <?php $thumbnail_id = get_post_thumbnail_id(get_the_ID()); ?>
    <?= wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "img-fluid rounded w-100"]); ?>

</div>
<div class="blog-description mt-3">
   
<div class="d-flex justify-content-between mb-2 border-bottom post-details blog-meta ">
            <div class="blog-meta-date">
                <div class="date">
                    <?= get_the_date('F j, Y', get_the_ID()); ?>
                </div>

            </div>
            <div class="d-flex align-items-center">
                <div class="author truncate-text-1">

                    <i class="icon-money-check-edit pl-2"></i> نویسنده :<?= the_author(get_the_ID()); ?>
                </div>

            </div>
        </div>

    <div class="single-contnt" id="content-single">
        <?= get_the_content(); ?>
    </div>


</div>