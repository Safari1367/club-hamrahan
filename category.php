<?php
$pageId = get_queried_object_id();

$page_slug = 'blog';
$page = get_page_by_path($page_slug);

$args = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => false
));
$all_terms = new WP_Query($args);
$terms = $all_terms->query;


$cat = get_queried_object();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => $cat->taxonomy,
            'field' => 'id',
            'terms' =>  $cat->term_id,

        ),
    ),
);

$query = new WP_Query($args);

get_header();

?>
<div class="content-page rtl-page category-page  news-cat ">

    <div class="container-fluid">
        <?php
        get_template_part('templates/components/breadcrumb');
        ?>
        <div class="row">
            <div class="col-sm-12">

                <div class="header-title border-b pb-3 mb-3">
                    <h2 class="card-title"><?= get_queried_object()->name ?></h4>
                </div>

                <!--mobile drop down -->
                <select class="cat-drop-down form-control">
                    <option value="<?= the_permalink($page->ID); ?>" <?= ($pageId == $page->ID) ? 'selected' : ''; ?>>همه
                    </option>
                    <?php foreach ($terms as $key => $cat) :
                        if ($key < 4) :
                    ?>
                            <option <?= ($pageId == $cat->term_id)  ? 'selected' : ''; ?> value="<?= get_term_link($cat->term_id) ?>"><?= $cat->name ?> </option>
                    <?php
                        endif;
                    endforeach; ?>
                </select>
                <ul class="d-flex cat-li">
                    <li class="category-tab  <?= ($pageId == $page->ID) ? 'active-cat' : ''; ?>">
                        <a href="<?= the_permalink($page->ID); ?>">همه</a>
                    </li>

                    <?php foreach ($terms as $key => $cat) :
                        if ($key < 4) :
                    ?>
                            <li class="category-tab <?= ($pageId == $cat->term_id) ? 'active-cat' : ''; ?>">
                                <a href="<?= get_term_link($cat->term_id) ?>"><?= $cat->name ?></a>
                            </li>
                    <?php
                        endif;
                    endforeach; ?>
                </ul>

                <div class="col-md-12">
                    <?php if ($query->have_posts()) { ?>
                    <div class="row">
                        <?php

                        
                            while ($query->have_posts()) : $query->the_post();
                        ?>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <?php

                                    get_template_part(
                                        'templates/card/vertical-card',
                                        null,
                                        ['id' => get_the_ID()]
                                    );
                                    ?>
                                </div>

                        <?php
                            endwhile;
                        ?>

                    </div>
                        <?php 
                          echo '<div class="pagination">';
                          echo paginate_links(array(
                              'total' => $query->max_num_pages,
                              'current' => $paged,
                              'prev_text' => 'قبلی',
                              'next_text' => 'بعدی',
                              'end_size' => 1,
                              'mid_size' => 1,
                          ));
                          echo '</div>';
                          
                        wp_reset_postdata();
                        } else {
                            echo 'هیچ مقاله ای  در این دسته‌بندی یافت نشد.';
                        }
                        ?>
                </div>

            </div>
        </div>


    </div>
</div>

<?php
get_footer();

?>