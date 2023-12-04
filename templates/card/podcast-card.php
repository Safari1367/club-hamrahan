<?php

$post_id = '';
if ($args['id']) {
    $post_id = $args['id'];
}

$post = get_post($post_id);

$taxonomy = $post->post_type . '_cat';

$categories = wp_get_post_terms($post_id, $taxonomy);

//get like and dislike
$queryLikeDislike = $wpdb->prepare(
    "SELECT SUM(like_post) AS total_likes, SUM(dislike) AS total_dislikes
    FROM {$wpdb->prefix}like_dislike_post_type
    WHERE post_type_id = %d",
    $post_id
);
$resultLikeDislike = $wpdb->get_row($queryLikeDislike);

?>

<div class="g-box g-desc rounded mb-4 podcast-custom-card p-2">

    <a class="image-content" href="<?= get_the_permalink($post->ID)  ?>">
        <?php $thumbnail_id = get_post_thumbnail_id($post->ID); ?>
        <?= wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "img-fluid b-radius-top"]); ?>
    </a>
    <div class=" p-2">
        <h4 class="truncate-text-1"><?= $post->post_title ?></h4>
        <div class="truncate-text-2 pb-2 border-bottom height-7">
            <?= $post->post_excerpt; ?>
        </div>
    </div>

    <?php if (!empty($categories)) :
        $first_category = $categories[0];
    ?>
        <div class="d-flex align-items-center pr-3 pl-3 justify-content-between">
            <div class=" truncate-text-1 mr-3 rtl-ml-3 rtl-mr-0">

                <a href="<?= get_term_link($first_category); ?>"><i class="icon-tags pl-2"></i> <?= $first_category->name; ?></a>
            </div>

            <?php if ($resultLikeDislike->total_likes > 0) { ?>
                <div class="hit">
                    <?= intval($resultLikeDislike->total_likes) ?><i class="icon-heart pr-2 rtl-pl-2 rtl-pr-0"></i>
                </div>
            <?php      } ?>
        </div>
    <?php endif; ?>

</div>