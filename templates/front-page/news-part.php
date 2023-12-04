<?php
$frontId = get_option('page_on_front');
$newsTitle = get_field('news_section_title', $frontId);
$news = get_field('choose_news', $frontId);

$allNews = [];
if (is_array($news) && count($news) > 0) {
    foreach ($news as $item) :
        $allNews[] = $item->ID;

    endforeach;
} else {
    $news = wp_get_recent_posts(['post_type' => 'news', 'posts_per_page' => 4]);

    foreach ($news as $item) :
        $allNews[] = $item['ID'];
    endforeach;
}

?>

<div class="col-sm-12 col-md-6 col-lg-4 news-part">
    <div class="card card-block card-stretch card-height">

        <div class="card-header d-flex justify-content-between">
            <?php if ($newsTitle) : ?>
                <div class="header-title">
                    <h4 class="card-title"><?= $newsTitle ?></h4>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <ul class="list-inline m-0 p-0  d-flex ">
                <?php foreach ($allNews as $key => $news) : ?>
                    <li class="mb-2">
                        <div class="blog-half d-flex align-items-center">
                            <a href="<?= get_permalink($news); ?>" class="  d-flex">
                                <div class="blog-meta">
                                    <?php $thumbnail_id = get_post_thumbnail_id($news); ?>
                                    <?= wp_get_attachment_image($thumbnail_id, 'full', false, ["class" => "d-block w-100"]); ?>
                                </div>
                            </a>
                            <div class="blog-description">
                                <a href="<?= get_permalink($news); ?>">
                                    <h5 class="mb-2 truncate-text-1"><?= get_the_title($news) ?></h5>
                                </a>
                                <div class="truncate-text-1"><?= get_the_excerpt($news); ?></div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>



            </ul>




        </div>
    </div>
</div>