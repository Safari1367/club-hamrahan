<?php


$userId = wp_get_current_user()->ID;

$form_entry_id = '';
$post_id = '';
$resultUseridPostid = '';

if (isset($args['form_entry_id']) && isset($args['form_id'])) {
    $post_id = $args['form_id'];
    $form_entry_id = $args['form_entry_id'];

    //like or dislike active for current user 
    global $wpdb;
    $queryUseridPostid = $wpdb->prepare(
        "SELECT like_post, dislike FROM {$wpdb->prefix}like_dislike_post_type
    WHERE user_id = %d AND entry_form_id = %s",
        $userId,
        $form_entry_id
    );

    $resultUseridPostid = $wpdb->get_row($queryUseridPostid);
} else {

    $post_id = get_queried_object_id();
    $form_entry_id = NULL;
    
    //like or dislike active for current user 
    global $wpdb;
    $queryUseridPostid = $wpdb->prepare(
        "SELECT like_post, dislike FROM {$wpdb->prefix}like_dislike_post_type
    WHERE user_id = %d AND post_type_id = %s",
        $userId,
        $post_id
    );

    $resultUseridPostid = $wpdb->get_row($queryUseridPostid);
}




$likePostValue = 0;
$dislikePostValue = 0;
if ($resultUseridPostid) {
    $likePostValue = $resultUseridPostid->like_post;
    $dislikePostValue = $resultUseridPostid->dislike;
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

<div class="row_ins_5  p-4 custom-like-dislike" id="custom-like-dislike" data-post-id="<?= $post_id ?>" data-user-id=" <?= $userId ?>" data-form-entry-id="<?= ($form_entry_id) ? $form_entry_id : '0'; ?>">

    <div class="like-box box_red">
        <i id="discount-dislike" class="icon-thumbs-down <?= ($dislikePostValue == 1) ? 'active' : '' ?> "></i> <span id="dislike-value"><?= intval($resultLikeDislike->total_dislikes); ?></span>
    </div>
    <div class="like-box box_gri">
        <i id="discount-like" class="icon-thumbs-up <?= ($likePostValue == 1) ? 'active' : '' ?>"></i> <span id="like-value"><?= intval($resultLikeDislike->total_likes) ?></span>
    </div>
</div>