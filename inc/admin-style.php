<?php
/*
* File Name:        admin-style.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/

add_action('admin_head', 'admin_style');
function admin_style()
{
    $folder_path = get_template_directory_uri() . '/inc/admin/';
    $font_path = get_template_directory_uri() . '/assets/fonts/yekan/staticfonts/';
    echo '<style>
    @font-face {
        font-family: dana;
        src: url(' . $font_path . 'IRANYekanX-Regular.woff) format("woff");
        font-weight: normal;
        font-style: normal;
    }
    @font-face {
        font-family: dana;
        src: url(' . $font_path . 'IRANYekanX-Bold.woff) format("woff");
        font-weight: bold;
        font-style: normal;
    }
    </style>';
    echo '<style type="text/css">
    /****** Start Style ******/
    html {
    font-size: 14px !important;
    overflow-x: hidden;
    }
    
    body {
        font-size: 1rem !important;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    a,
    code,
    li,
    ul,
    strong,
    select,
    option,
    button,
    p,
    input,
    textarea,
    html,
    body {
        font-family: dana !important;
        font-weight: normal;
        letter-spacing: 0;
    }
    
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    strong {
        font-weight: bold;
        font-family: dana !important;
    }
    
    .ab-label {
        font-weight: normal;
        font-family: dana !important;
    }
    
    .widefat td,
    .widefat td ol,
    .widefat td p,
    .widefat td ul {
        font-size: 1rem !important;
    }
    
    body.rtl,
    body.rtl .press-this a.wp-switch-editor {
        font-family: dana;
    }
    
    .rtl #wpadminbar * {
        font-family: dana;
        font-size: 1rem !important;
    }
    
    p {
        font-size: 1rem;
        line-height: 1.8;
        margin: 1em 0;
    }
    .ihc-dashboard-wrap .ihc-admin-header .ihc-top-menu-section .ihc-dashboard-menu .ihc-page-title , .uap-dashboard-wrap .uap-admin-header .uap-top-menu-section .uap-dashboard-menu .uap-page-title{
  font-size: 1rem;
  font-family: dana !important;
  font-weight: normal !important;
  line-height: inherit !important;
  letter-spacing: 0 !important;
}
    .uap-additional-help {
  display: none;
  visibility:hidden
}
.uap-dashboard-logo {
  display: none;
    visibility:hidden
}
.betterdocs-pro-notice.wpdeveloper-licensing-notice.notice.notice-error {
  display: none;
  visibility: hidden;
}
    /****** End Style ******/
    </style>';
}
