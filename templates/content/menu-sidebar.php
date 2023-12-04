<div class="iq-sidebar  rtl-iq-sidebar sidebar-default mobile custom-user-dropdown">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between ">
    <?php the_custom_logo() ?>
        <div class="iq-menu-bt-sidebar">
            <i class="icon-align-justify wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar custom-scroll" data-scroll="1">

        <?php
        $current_user = wp_get_current_user();
        $user_roles = $current_user->roles;
        $menuLocation;
        if (in_array('administrator', $user_roles)) {
            $menuLocation = "admin_main_menu";
        } else {
            $menuLocation = "main_menu";
        }

        $defaults = array(
            'menu'                 => '',
            'container'            => 'nav',
            'container_class'      => 'iq-sidebar-menu',
            'container_id'         => '',
            'container_aria_label' => '',
            'menu_class'           => 'iq-menu',
            'menu_id'              => '',
            'echo'                 => true,
            'fallback_cb'          => 'wp_page_menu',
            'before'               => '',
            'after'                => '',
            'link_before'          => '',
            'link_after'           => '',
            'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'item_spacing'         => 'preserve',
            'depth'                => 0,
            'walker'               => '',
            'theme_location'       => $menuLocation,
        );


        wp_nav_menu($defaults);

        ?>

    </div>
</div>