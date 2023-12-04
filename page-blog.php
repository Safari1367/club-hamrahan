<?php

/*
* File Name:        blog.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/

get_header();

$pageId=get_queried_object_id();
$page_slug = 'blog';
$page = get_page_by_path($page_slug);


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = [
    'post_type' => 'post',
    'posts_per_page' => 8,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC',
    'taxonomy' => 'category',

];


$query = new WP_Query($args);

$args = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => false
));
$all_terms = new WP_Query($args);
$terms = $all_terms->query;
?>
<div class="content-page rtl-page archive-page radio-archive news-cat ">


    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>
        <div class="row">
            <div class="col-sm-12">


                <?php
                get_template_part('templates/content/content')
                ?>


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

       



                <div class="row">

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
                        } else {
                            echo 'هیچ مقاله ای  در این دسته‌بندی یافت نشد.';
                        }
                        ?>
                    </div>

                </div>

            </div>
        </div>
    </div>



</div>
</div>

<?php
get_footer();

?>