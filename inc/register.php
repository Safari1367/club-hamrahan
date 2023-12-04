<?php
/*
* File Name:        functions.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/

// Register Custom Post Type
function create_custom_post_type($post_type, $singular_name, $plural_name, $menu_icon)
{
    $labels = array(
        'name' => _x($plural_name, 'Post Type General Name', 'hfc'),
        'singular_name' => _x($singular_name, 'Post Type Singular Name', 'hfc'),
        'menu_name' => _x($plural_name, 'Admin Menu text', 'hfc'),
        'name_admin_bar' => _x($singular_name, 'Add New on Toolbar', 'hfc'),
        'archives' => __($singular_name . ' Archives', 'hfc'),
        'attributes' => __($singular_name . ' Attributes', 'hfc'),
        'parent_item_colon' => __('Parent' . $singular_name, 'hfc'),
        'all_items' => __('همه ' . $singular_name, 'hfc'),
        'add_new_item' => __('افزودن ' . $singular_name, 'hfc'),
        'add_new' => __('افزودن', 'hfc'),
        'new_item' => __('جدید ' . $singular_name, 'hfc'),
        'edit_item' => __('ویرایش ' . $singular_name, 'hfc'),
        'update_item' => __('آپدیت ' . $singular_name, 'hfc'),
        'view_item' => __('دیدن ' . $singular_name, 'hfc'),
        'view_items' => __('دیدن ' . $singular_name, 'hfc'),
        'search_items' => __('جستجو ' . $singular_name, 'hfc'),
        'not_found' => __('پیدا نشد', 'hfc'),
        'not_found_in_trash' => __('Not found in Trash', 'hfc'),
        'featured_image' => __('Featured Image', 'hfc'),
        'set_featured_image' => __('Set featured image', 'hfc'),
        'remove_featured_image' => __('Remove featured image', 'hfc'),
        'use_featured_image' => __('Use as featured image', 'hfc'),
        'insert_into_item' => __('Insert into ' . $singular_name, 'hfc'),
        'uploaded_to_this_item' => __('Uploaded to this' . $singular_name, 'hfc'),
        'items_list' => __($singular_name . ' list', 'hfc'),
        'items_list_navigation' => __($singular_name . ' list navigation', 'hfc'),
        'filter_items_list' => __('Filter ' . $singular_name . ' list', 'hfc'),
    );

    $args = array(
        'label' => __($singular_name, 'hfc'),
        'description' => __('', 'hfc'),
        'labels' => $labels,
        'menu_icon' => $menu_icon,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'comments', 'trackbacks', 'page-attributes', 'post-formats'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type($post_type, $args);


    $labels_register_tag = array(
        'name' => $singular_name.' تگ ها',
        'singular_name' => $singular_name.' تگ',
        'search_items' => 'جستجو تگ'.$singular_name,
        'popular_items' => 'تگ های معروف'.$singular_name,
        'all_items' => 'همه تگ ها'.$singular_name,
        'edit_item' => 'ویرایش تگ'.$singular_name,
        'update_item' => 'آپدیت تگ'.$singular_name,
        'add_new_item' => 'افزودن تگ جدید'.$singular_name,
        'new_item_name' => 'نام تگ جدید',
        'separate_items_with_commas' => 'Separate tags with commas',
        'add_or_remove_items' => 'Add or remove tags',
        'choose_from_most_used' => 'Choose from the most used tags',
        'menu_name' => $singular_name.' تگ ها',
    );

    $args_register_tag = array(
        'hierarchical' => false,
        'labels' => $labels_register_tag,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $post_type . '-tag'),
    );

    register_taxonomy($post_type .'_tag', $post_type, $args_register_tag);


    $labels_register_cat = array(
        'name' => $singular_name.'  ها',
        'singular_name' => $singular_name.'  ها',
        'search_items' => 'جستجو دسته بندی',
        'all_items' => 'همه دسته بندی',
        'edit_item' => 'ویرایش دسته بندی',
        'update_item' => 'آپدیت دسته بندی',
        'add_new_item' => 'دسته بندی جدید',
        'new_item_name' => 'نام دسته بندی جدید',
        'menu_name' => $singular_name.' دسته بندی ها',
    );

    $args_register_cat = array(
        'hierarchical' => true,
        'labels' => $labels_register_cat,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $post_type .'-cat'),
    );

    register_taxonomy($post_type . '_cat', $post_type, $args_register_cat);

}

// create podcast post type
add_action('init', function () {
    create_custom_post_type('podcast', 'پادکست', 'پادکست ها ', 'dashicons-embed-audio');
});

// create article post type
add_action('init', function () {
    create_custom_post_type('discount', 'تخفیف', 'تخفیف ها', 'dashicons-xing');
});

//create news post type
add_action('init', function () {
    create_custom_post_type('news', 'اخبار', 'اخبار', 'dashicons-analytics');
});

//create file upload post type
add_action(
    'init',
    function () {
        create_custom_post_type('file', 'فایل', 'فایل ها', 'dashicons-portfolio');
    }

);
