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
<div class="card card-block card-stretch card-height blog blog-list podcast-vertical">
    <div class="card-body">
        <a href="<?= get_permalink($post_id) ?>">
            <div class="d-flex flex-wrap align-items-center">

                <?php $thumbnail_id = get_post_thumbnail_id($post_id); ?>
                <?= wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "img-fluid rounded w-100"]); ?>

                <div class=" blog-description">

                    <h4 class="mb-2 truncate-text-1">
                        <?= get_the_title($post_id); ?>
                    </h4>
                    <div class="d-flex justify-content-between mb-2 border-bottom">
                        <div class="blog-meta-date">
                            <div class="date">
                                <?= get_the_date('F j, Y', $post_id); ?>
                            </div>

                        </div>
                        <div class="blog-meta d-flex align-items-center">
                            <div class="author truncate-text-1 mr-3 rtl-ml-3 rtl-mr-0">

                                <?= the_author($post_id); ?><i class="icon-money-check-edit pl-2"></i>
                            </div>
                            <?php if ($resultLikeDislike->total_likes > 0) { ?>
                            <div class="hit">
                            <?= intval($resultLikeDislike->total_likes) ?><i class="icon-heart pr-2 rtl-pl-2 rtl-pr-0"></i>
                            </div>
                            <?php      } ?>
                        </div>
                    </div>
                    <div class="truncate-text-2">

                        <?= the_excerpt($post_id); ?>

                    </div>
            

                </div>
            </div>
        </a>
    </div>
</div>