<?php
get_header();

$postId = get_queried_object_id();
$choosePodcast = get_field('choose_podcast_type', $postId);
$singlePodcast = get_field('add_single_podcast', $postId);
$singlePodcastTitle = get_field('single_podcast_title', $postId);
$playListPodcasts = get_field('podcast_play_list_repeater', $postId);
$current_user = wp_get_current_user();

$epi = 0;
if (is_array($playListPodcasts) && count($playListPodcasts) > 0) {
    foreach ($playListPodcasts as $play) {
        if ($play['podcast_file'] && $play['podcast_name']) {
            $epi++;
        }
    }
}

?>

<div class="content-page rtl-page podcast-single" data-user-id="<?= $current_user->ID ?>" data-podcast-id="<?= $postId ?>" data-podcast-name="<?= get_the_title(); ?>" data-all-episode="<?= ($choosePodcast == "single") ? '1' : $epi; ?>">

    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>
        <div class="row">

            <div class="col-sm-12 col-md-8 col-lg-9">


                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-block card-stretch card-height blog blog-detail">
                            <div class="pr-4 pt-3">

                                <h1 class="truncate-text-1"> <?= get_the_title(); ?> </h1>

                            </div>

                            <div class="card-body">
                                <div class="content-pod mb-3">
                                    <?= get_the_content(); ?>
                                </div>



                                <?php if ($singlePodcast || (is_array($playListPodcasts) && count($playListPodcasts) > 0)) : ?>
                                    <!-- Start DEMO HTML (Use the following code into your project)-->
                                    <div class="simple-audio-player" id="simp" data-config='{"shide_top":false,"shide_btm":false,"auto_load":false}'>
                                        <div class="simp-playlist">
                                            <ul>
                                                <?php
                                                if ($choosePodcast == "single") :
                                                    $image_url = get_the_post_thumbnail_url($postId);
                                                ?>
                                                    <li class="simp-active"><img src="<?= $image_url ?>" alt="">
                                                        <div class="podcast-content-play">

                                                            <span class="simp-source truncate-text-1" data-id="<?= $postId ?>_episod_1" data-src="<?= $singlePodcast ?>" data-cover="<?= $image_url ?>"><?= $singlePodcastTitle ?></span><span class="simp-desc truncate-text-1"><?= get_the_excerpt($postId); ?></span>
                                                        </div>
                                                    </li>



                                                    <?php elseif ($choosePodcast == "multiple") :
                                                    $episod = 1;
                                                    foreach ($playListPodcasts as $key => $podcast) :
                                                        if ($podcast['podcast_file'] && $podcast['podcast_name']) :
                                                    ?>
                                                            <li class="<?= ($key == 0) ? 'simp-active' : '' ?>">
                                                                <img src="<?= $podcast['podcast_image'] ?>" alt="">
                                                                <div class="podcast-content-play">
                                                                    <span class="simp-source truncate-text-1" data-id="<?= $postId ?>_episod_<?= $episod ?>" data-src="<?= $podcast['podcast_file'] ?>" data-cover="<?= $podcast['podcast_image'] ?>"><?= $podcast['podcast_name'] ?></span><span class="simp-desc truncate-text-1"><?= $podcast['podcast_descrip'] ?></span>

                                                                </div>
                                                            </li>

                                                <?php
                                                            $episod++;
                                                        endif;

                                                    endforeach;
                                                endif; ?>
                                            </ul>
                                        </div>
                                    </div>

                                <?php endif;

                                get_template_part(
                                    'templates/content/like-dislike'
                                ); ?>



                            </div>
                        </div>
                    </div>



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
            <?php dynamic_sidebar('main_sidebar'); ?>
            <?php get_sidebar() ?>

        </div>



    </div>
</div>

</div>

<?php get_footer();
