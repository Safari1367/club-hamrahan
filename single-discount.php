<?php
get_header();

$terms = wp_get_post_terms(get_the_ID(), 'discount_cat');
$validityDate = get_field('validity_date', get_the_ID());
$disLikeNumber = get_field('dis_like_number', get_the_ID());


$cat;
if (is_array($terms) && count($terms) > 0) {
    $cat = $terms[0];
}



//get like and dislike
$queryLikeDislike = $wpdb->prepare(
    "SELECT SUM(like_post) AS total_likes, SUM(dislike) AS total_dislikes
    FROM {$wpdb->prefix}like_dislike_post_type
    WHERE post_type_id = %d",
    get_the_ID()
);
$resultLikeDislike = $wpdb->get_row($queryLikeDislike);


// change string to object 
$targetDate = DateTime::createFromFormat('d/m/Y', $validityDate);

$validity;
if ($targetDate instanceof DateTime) {

    // now date
    $currentDate = new DateTime();

    //date calculation
    $interval = $currentDate->diff($targetDate);

    if (($currentDate > $targetDate && intval($resultLikeDislike->total_dislikes) > intval($disLikeNumber)) || (intval($resultLikeDislike->total_dislikes) > intval($disLikeNumber) || $currentDate > $targetDate)) {
        $validity = 'نامعتبر';
    } else {

        $interval = $currentDate->diff($targetDate);
        $validity = 'معتبر تا : ' . $interval->format('%a') . ' روز دیگر';
    }
}




?>
<div class="content-page rtl-page">
    <?php

    ?>
    <div class="container-fluid discount-single" id=discount-single>
        <?php
        get_template_part('templates/components/breadcrumb');
        ?>
        <div class="row">

            <div class="col-sm-6 col-md-6 col-lg-7">
                <div class="card p-4">
                    <div class="row_ins_1">
                        <?php $thumbnail_id = get_post_thumbnail_id(get_the_ID()); ?>
                        <?= wp_get_attachment_image($thumbnail_id, 'thumbnail', false, ["class" => "img-fluid rounded "]); ?>
                        <div class="box_ch_1">
                            <h3 class="truncate-text-2 mb-3"><?= get_the_title(); ?></h3>

                            <h5>دسته بندی : <a href=""><?= $cat->name ?></a></h5>
                        </div>
                        <!-- <div class="box_ch_2">
                                <i class="icon-heart"></i><span>افزودن به علاقه مندی ها</span>
                            </div> -->
                    </div>
                    <div class="row_ins_2">

                        <div class="discrip_codeT"><?= get_the_content(); ?></div>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-5 ">
                <div class="card p-4">
                    <?php if (get_field('date_of_release', get_the_ID()) &&  $validity) : ?>
                        <div class="row_ins_3 mb-3">
                            <h4 class="time_d_T cRed"> <?= $validity ?></h4>
                            <h4 class="time_d_T">تاریخ انتشار: <?= get_field('date_of_release', get_the_ID()); ?></h4>

                        </div>
                    <?php endif; ?>
                    <div class="row_ins_4 pb-4 border-bottom">
                        <button id="discount-copy-btn" class="btn btn-outline-primary rounded-pill">کپی کنید</button>
                        <div id="discount_code" class="bpr_dash_2p" data-copy="<?= get_field('discount_code', get_the_ID()); ?>"><?= get_field('discount_code', get_the_ID()); ?></div>
                        <span id="tooltip">کپی شد</span>
                    </div>

                    <?php
                    get_template_part('templates/content/like-dislike'); ?>

                </div>
            </div>

        </div>

        <div class="row">
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) : ?>



                <div class="col-md-12">
                    <div class="card card-block card-stretch card-height blog user-comment">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">نظر کاربران</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="card-transparent card-block card-stretch card-height blog">
                                        <?php
                                        comments_template();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>

</div>
</div>

<?php get_footer();
