<?php
$postType = get_queried_object();
$radio_page_id = get_posts([
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'templates/podcast-overview.php'
]);

$terms;
if ($postType->ID == $radio_page_id[0]) {
    $terms = get_terms(array(
        'taxonomy' => 'podcast_cat',
        'hide_empty' => false
    ));
} elseif ($postType->post_type == 'post') {
    $terms = get_terms(array(
        'taxonomy' => 'category',
        'hide_empty' => false
    ));
} else {
    $terms = get_terms(array(
        'taxonomy' => $postType->post_type . '_cat',
        'hide_empty' => false
    ));
}


$titlePosts = get_field('sidebar_title_posts', $postType->ID);
$choosePosts = get_field('choose_posts_side', $postType->ID);

?>
<div class="col-sm-12 col-lg-3 sidebar">

    <div class="col-md-12 card bottom-right shadow-showcase pb-3 pt-3">
        <div class="header-title ">
            <h4 class="card-title">دسته بندی ها </h4>
        </div>

        <ul class="list-group list-group-flush">
            <?php foreach ($terms as $key => $term) :

        

                if ($key < 8) : ?>
                    <li class="list-group-item list-group-item-action "><a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?> <span><?= $term->count ?></span></a></li>
            <?php
                endif;
            endforeach; ?>
        </ul>
    </div>

    <?php if ($postType->post_type == 'post' || $postType->post_type == 'news' && $postType->post_content) : ?>

        <div class="col-md-12 card bottom-right shadow-showcase pb-3 pt-3 quick-access">

            <div class="header-title p-3">
                <h4> دسترسی سریع </h4>
            </div>

            <ul class="list-group scroll-list">

            </ul>
        </div>
    <?php
    endif;
    if (is_array($choosePosts) && count($choosePosts) > 0) :
    ?>
        <div class="podcast-side-box col-md-12 card bottom-right shadow-showcase pb-3 pt-3">
            <?php if ($titlePosts && !$postType->post_type == 'podcast') :

            ?>
                <div class="header-title p-3">
                    <h4><?= $titlePosts ?> </h4>
                </div>
            <?php endif;

            foreach ($choosePosts as $post) :

                if ($postType->post_type == 'podcast') {
                    get_template_part(
                        'templates/card/podcast-horizontal-card',
                        null,
                        ['id' => $post->ID]
                    );
                } else {
                    get_template_part(
                        'templates/card/vertical-card',
                        null,
                        ['id' => $post->ID]
                    );
                }


            endforeach;

            ?>


        </div>
    <?php
    endif;
    ?>


</div>