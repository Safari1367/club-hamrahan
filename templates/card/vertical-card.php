<?php
$post_id = '';
if ($args['id']) {
    $post_id = $args['id'];
}

//get like and dislike
$queryLikeDislike = $wpdb->prepare(
    "SELECT SUM(like_post) AS total_likes, SUM(dislike) AS total_dislikes
    FROM {$wpdb->prefix}like_dislike_post_type
    WHERE post_type_id = %d",
    $post_id
);
$resultLikeDislike = $wpdb->get_row($queryLikeDislike);


?>
<div class="card card-block card-stretch card-height blog blog-date vertical-card">
    <div class="card-body">
        <div class="image-block position-relative">
            <a href="<?= get_permalink($post_id) ?>">
                <?php $thumbnail_id = get_post_thumbnail_id($post_id); ?>
                <?= wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "img-fluid rounded w-100"]); ?>

                <div class="blog-meta-date">
                    <?= get_the_date('j F Y', $post_id); ?>

                </div>
            </a>
        </div>
        <div class="blog-description mt-3">
            <h4 class="mb-2 truncate-text-1"> <?= get_the_title($post_id); ?></h4>
            <div class="blog-meta d-flex align-items-center justify-content-between mb-2">
                <div class="author truncate-text-1"><i class="ri-user-fill pr-2"></i> <?= the_author($post_id); ?></div>
                <?php if ($resultLikeDislike->total_likes > 0) { ?>
                    <div class="hit"><?= intval($resultLikeDislike->total_likes) ?><i class="icon-heart pl-2"></i> </div>
                <?php      } ?>

            </div>
            <a href="<?= get_permalink($post_id) ?>">

            </a>
            <div class="truncate-text-3"> <?= the_excerpt($post_id); ?></div>
        </div>
    </div>
</div>