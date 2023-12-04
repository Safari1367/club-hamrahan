<?php

if (is_post_type_archive('news')) {
    get_template_part('templates/news-overview');
} elseif (is_post_type_archive('post')) {

    get_template_part('page-blog');
} elseif (is_post_type_archive('podcast')) {

    get_template_part('templates/podcast-overview');
} elseif (is_post_type_archive('discount')) {

    get_template_part('templates/discount-overview');
} elseif (is_post_type_archive('file')) {

    get_template_part('templates/file-overview');
} elseif (is_tax('podcast_cat')) {

    get_template_part('templates/content/archives/archive-podcast');
} elseif (is_tax('category')) {

    get_template_part('category');
} elseif (is_tax('news_cat') || is_tax('discount_cat')) {

    get_template_part('templates/content/archives/archive-news');
}
