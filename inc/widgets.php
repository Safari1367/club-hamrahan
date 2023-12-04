<?php
/*
* File Name:        widgets.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/
// Register custom navigation menus
// Add custom menu support
if (!function_exists("vanpnu_menu")) :
    function vanpnu_menu()
    {
        register_nav_menus([
            "main_menu" => __("Main menu"),
            "admin_main_menu" => __("Admin Main menu"),
    
  
        ]);
    }
    add_action("init", "vanpnu_menu");
endif;

if (!function_exists("sales_target_widget")) :
    function sales_target_widget()
    {
        register_sidebar([
            "name" => "Sales Target",
            "id" => "sales_target_widget",
            "before_widget" => "<div>",
            "after_widget" => "</div>",
            "before_title" => '<h4 class="rounded d-none">',
            "after_title" => "</h4>",
        ]);
    }
    add_action("widgets_init", "sales_target_widget");
endif;

if (!function_exists("offcanvas_menu")) :
    function offcanvas_menu()
    {
        register_sidebar([
            "name" => "Offcanvas Menu",
            "id" => "offcanvas_menu",
            "before_widget" => "<div>",
            "after_widget" => "</div>",
            "before_title" => '<h4 class="rounded d-none">',
            "after_title" => "</h4>",
        ]);
    }
    add_action("widgets_init", "offcanvas_menu");
endif;
