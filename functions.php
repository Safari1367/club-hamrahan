<?php
/*
* File Name:        functions.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/
const THEME_NAME = "hamrahanclub";
const THEME_VERSION = "1.3.4";
define("THEME_DIR", get_template_directory());
define("THEME_URI", get_template_directory_uri());

// disable admin bar in frontend
show_admin_bar(false);

require_once(__DIR__ . '/inc/admin-style.php');
require_once(__DIR__ . '/inc/theme-setup.php');
require_once(__DIR__ . '/inc/register.php');
require_once(__DIR__ . '/inc/widgets.php');
require_once(__DIR__ . '/inc/ajax_theme.php');
