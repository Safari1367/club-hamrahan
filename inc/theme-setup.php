<?php
/*
* File Name:        enqueue-scripts.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/




// VenusITC Setup Theme
function civiup_setup()
{
    // Make theme available for translation.
    load_theme_textdomain('THEME_NAME', get_template_directory() . '/languages');

    //add custom logo
    add_theme_support('custom-logo');
    // title-tag
    add_theme_support('title-tag');

    // Add theme support for Featured Images
    add_theme_support('post-thumbnails');

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Enqueue editor styles.
    add_editor_style('style-editor.css');

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // feed links
    //add_theme_support('automatic-feed-links');

    // Add theme support for post format
    add_theme_support(
        'post-formats',
        array(
            'aside',
            'audio',
            'image',
            'gallery',
            'link',
            'quote',
            'status',
            'video'
        )
    );

    // Add theme support for HTML5 Semantic Markup
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
        )
    );
}
add_action('after_setup_theme', 'civiup_setup');

// change $limit for more and less character
function custom_short_excerpt($excerpt)
{
    $limit = 250;
    if (strlen($excerpt) > $limit) {
        return substr($excerpt, 0, strpos($excerpt, ' ', $limit));
    }
    return $excerpt;
}
add_filter('the_excerpt', 'custom_short_excerpt');



// Add thumbnail return functions to theme
if (!function_exists("hamrahanefarda_thumbnail_return")) {
    function hamrahanefarda_thumbnail_return()
    {
?>
        <?php //if (is_singular() || is_archive()) :
        ?>
        <figure class="post_thumbnail">
            <?php the_post_thumbnail("post-thumbnail", [
                "class" => "img-fluid venus_post_thumbnail",
            ]); ?>
        </figure>
        <?php //endif;
        ?>
    <?php
    }
}
function comment_support_for_my_custom_post_type()
{
    add_post_type_support('my_post_type', 'podcast');
}
add_action('init', 'comment_support_for_my_custom_post_type');


// use classic editor
add_filter('use_block_editor_for_post', '__return_false');

// use classic widget
add_filter('use_widgets_block_editor', '__return_false');



function theme_enqueue_scripts()
{
    // Include CSS libraries
    wp_register_style('styles', THEME_URI . '/assets/css/backend28b5.css', [], '');
    wp_enqueue_style('styles');

    wp_register_style('icons', THEME_URI . '/assets/css/font-icons.css', [], '');
    wp_enqueue_style('icons');

    wp_register_style('play-list', THEME_URI . '/assets/css/play-list.css', [], '');
    wp_enqueue_style('play-list');

    wp_register_style('custom', THEME_URI . '/assets/css/custom-style.css', [], '');
    wp_enqueue_style('custom');




    wp_register_script('backend-bundle', THEME_URI . '/assets/js/backend-bundle.min.js', [], THEME_VERSION, true);
    wp_enqueue_script('backend-bundle');

    wp_register_script('slider', THEME_URI . '/assets/js/slider.js', [], THEME_VERSION, true);
    wp_enqueue_script('slider');

    wp_register_script('app', THEME_URI . '/assets/js/app.js', [], THEME_VERSION, true);
    wp_enqueue_script('app');

    wp_register_script('play', THEME_URI . '/assets/js/play-list.js', [], THEME_VERSION, true);
    wp_enqueue_script('play');

    wp_register_script('menu', THEME_URI . '/assets/js/menu.js', [], THEME_VERSION, true);
    wp_enqueue_script('menu');
    wp_register_script('custom', THEME_URI . '/assets/js/custom.js', [], THEME_VERSION, true);
    wp_enqueue_script('custom');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


//add ajax url to header
function add_ajax_url_to_head()
{ ?>
    <script type='text/javascript'>
        var ajax_var = {
            url: `<?php echo admin_url('admin-ajax.php') ?>`,
            nonce: `<?php echo wp_create_nonce('ajax-nonce') ?>`
        }
    </script>
<?php
}


add_action('wp_head', 'add_ajax_url_to_head', 100);


//********************create table for podcast playlist

function create_users_podcasts_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}users_podcasts` (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) unsigned NOT NULL,
        podcast_id int(11) NOT NULL,
        podcast_name varchar(255) NOT NULL,
        all_episode int(11)  NOT NULL,
        episode_id  varchar(255)  NOT NULL,
        listen_status boolean DEFAULT FALSE NOT NULL,
        listen_time varchar(10) NOT NULL,
        podcast_time varchar(10)  NOT NULL,
        listen_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL, 
    
        PRIMARY KEY  (id)
        FOREIGN KEY (user_id) REFERENCES `{$wpdb->base_prefix}users`  (ID)

    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_setup_theme', 'create_users_podcasts_table');


// add active class to curent menu
function custom_menu_item_classes($classes, $item)
{

    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'custom_menu_item_classes', 10, 2);




/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hfc_content_width()
{
    $GLOBALS['content_width'] = apply_filters('hfc_content_width', 640);
}
add_action('after_setup_theme', 'hfc_content_width', 0);

if (!function_exists('hfc_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function hfc_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('Posted on %s', 'post date', 'hfc'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if (!function_exists('hfc_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function hfc_posted_by()
    {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('by %s', 'post author', 'hfc'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if (!function_exists('hfc_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function hfc_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'hfc'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'hfc') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'hfc'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'hfc') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hfc'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'hfc'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (!function_exists('hfc_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function hfc_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    array(
                        'alt' => the_title_attribute(
                            array(
                                'echo' => false,
                            )
                        ),
                    )
                );
                ?>
            </a>

        <?php
        endif; // End is_singular().
    }
endif;

if (!function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
endif;
add_action('wp_enqueue_scripts', 'sl2_enqueue_scripts');
function sl2_enqueue_scripts()
{
    wp_enqueue_script('add-public-js', get_template_directory_uri() . '/js/add-to-list.js', array('jquery'), '0.5', false);
    wp_localize_script('add-public-js', 'simpleLikes', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'like' => __('قبلا پادکست ها را گوش کرده اید.', 'hfc'),
        'unlike' => __('Unlike', 'hfc')
    ));
}
add_action('wp_ajax_nopriv_process_add_to_list', 'process_add_to_list');
add_action('wp_ajax_process_add_to_list', 'process_add_to_list');
function process_add_to_list()
{
    // Security
    $nonce = isset($_REQUEST['nonce']) ? sanitize_text_field($_REQUEST['nonce']) : 0;
    if (!wp_verify_nonce($nonce, 'add-to-list-nonce')) {
        exit(__('Not permitted', 'bp'));
    }
    $disabled = (isset($_REQUEST['disabled']) && $_REQUEST['disabled'] == true) ? true : false;
    $user_id = $_REQUEST['user_id'];
    $post_id = $_REQUEST['post_id'];
    $type = $_REQUEST['to'];
    if (get_current_user_id() == $user_id) {
        user_btn_set2($post_id, $user_id, $type);
        $response['status'] = "done";
    } else {
        exit(__('Not permitted', 'hfc'));
    }
    if ($disabled == true) {
        wp_redirect(get_permalink($post_id));
        exit();
    } else {
        wp_redirect(get_permalink($post_id));
        exit();
    }
}

function get_add_to_list($post_id, $user_id, $type, $text, $icon, $class = '')
{
    $nonce = wp_create_nonce('add-to-list-nonce'); // Security
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $post_ids = array();
        $post_ids = get_user_meta($user_id, $type, true);
        if (already_added($post_id, $user_id))
            echo '<div class="' . $class . ' bg-success text-white"><i class="icon-check"></i> ' . $text . '</div>';
        else
            echo '<a href="' . admin_url('admin-ajax.php?action=process_add_to_list' . '&post_id=' . $post_id . '&nonce=' . $nonce . '&to=' . $type . '&user_id=' . $user_id) . '" class="' . $class . ' add-to-link  sl-button-' . $post_id . '" data-nonce="' . $nonce . '" data-user-id="' . $user_id . '" data-post-id="' . $post_id . '"  data-to="' . $type . '""><i class="' . $icon  . '"></i> ' . $text  . '</a><span id="at-loader-' . $type . '"></span>';
    } else {
        $login_page_id = UM()->options()->get('core_login');
        echo '<div class="' . $class . '"><a href="' . get_the_permalink($login_page_id) . '"><i class="' . $icon  . '"></i> ' . $text . '</a></div>';
        //$output = '<a href="' . wp_login_url() . '" class="btn btn-sm btn-danger color-1" title="' . $title . '">' . $icon . $count . '</a>';
    }
}

// insert into user btn
function user_btn_set2($post_id, $user_id, $type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_btn';
    $result = $wpdb->query(
        $wpdb->prepare(
            "
			 INSERT INTO $table_name
			 (post_id,user_id,date,type)
			 VALUES(%d,%d,%s,%s)
			",
            $post_id,
            $user_id,
            date('Y-m-d H:i:s'),
            $type
        )
    );
}


function already_added($post_id, $user_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_btn';
    $result = $wpdb->get_results("SELECT btn_id FROM $table_name WHERE post_id = $post_id AND user_id = $user_id");
    if (empty($result))
        return false;
    else
        return true;
}

function get_btn_count2($post_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_btn';
    $like_count = count($wpdb->get_results("SELECT * FROM $table_name WHERE post_id = $post_id"));
    $like_count = (isset($like_count) && is_numeric($like_count)) ? $like_count : 0;
    return $like_count;
}



function the_post_likes($post_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_btn';
    $user_likes = $wpdb->get_results("SELECT user_id FROM $table_name WHERE post_id = $post_id");
    if (!empty($user_likes)) {
        ?>
        <div class="inner-section-style">
            <div class="">
                <div><i class="icon-people-group align-middle"></i> کاربرانی که به این پادکست ها گوش داده اند:</div>
                <div class="mt-2">
                    <?php
                    foreach ($user_likes[0] as $user_like) {
                        $user = get_user_by('ID', $user_like);
                        um_fetch_user($user_like);

                    ?>
                        <a href="<?php echo um_user_profile_url(); ?>" class="user-liked-link"><i class="icon-headphones align-middle"></i> <?php echo um_user('display_name'); ?></a>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
}
// Add thumbnail return functions to theme
if (!function_exists("hamrahanefarda_thumbnail_return")) {
    function hamrahanefarda_thumbnail_return()
    {
    ?>
        <?php //if (is_singular() || is_archive()) :
        ?>
        <figure class="post_thumbnail">
            <?php the_post_thumbnail("post-thumbnail", [
                "class" => "img-fluid venus_post_thumbnail",
            ]); ?>
        </figure>
        <?php //endif;
        ?>
<?php
    }
}




//******************************** create table for post type like and dislike
function create_like_dislike_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . 'like_dislike_post_type';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id int(11) NOT NULL,
        post_type_id int(11) NOT NULL,
        like_post TINYINT(1) NOT NULL DEFAULT 0,
        dislike TINYINT(1) NOT NULL DEFAULT 0,
        entry_form_id INT(11) DEFAULT NULL,
        create_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL, 
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_setup_theme', 'create_like_dislike_table');


