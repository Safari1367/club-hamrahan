<?php $current_user = wp_get_current_user(); ?>
<li class="caption-content" id="user-hamrah-profile">
    <a href="#" class="iq-user-toggle">

        <?php

        if ($current_user) :
        ?>

            <img src="<?php echo esc_url(get_avatar_url($current_user->ID)); ?>" />

            <span><?php echo 'سلام، ' . $current_user->user_login  . " عزیز "; ?></span>

        <?php endif; ?>
    </a>


    <div class="iq-user-dropdown ">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center mb-0">
                <div class="header-title">
                    <h4 class="card-title mb-0">حساب کاربری</h4>
                </div>
                <div class="close-data text-right badge badge-primary cursor-pointer"><i class="icon-times"></i></div>
            </div>
            <div class="data-scrollbar " data-scroll="2">
                <div class="card-body">
                    <div class="profile-header">
                        <div class="cover-container ">
                            <div class="media align-items-center mb-4 custom-account-info-img">
                                <div class="um-account-meta-img uimob800-hide">
                                    <a href="<?php echo esc_url(um_user_profile_url()); ?>">
                                        <?php echo get_avatar(um_user('ID'), 120); ?>
                                    </a>
                                </div>

                                <?php if (UM()->mobile()->isMobile()) { ?>

                                    <div class="um-account-meta-img-b uimob800-show" title="<?php echo esc_attr(um_user('display_name')); ?>">
                                        <a href="<?php echo esc_url(um_user_profile_url()); ?>">
                                            <?php echo get_avatar(um_user('ID'), 120); ?>
                                        </a>
                                    </div>

                                <?php } else { ?>

                                    <div class="um-account-meta-img-b uimob800-show um-tip-<?php echo is_rtl() ? 'e' : 'w'; ?>" title="<?php echo esc_attr(um_user('display_name')); ?>">
                                        <a href="<?php echo esc_url(um_user_profile_url()); ?>">
                                            <?php echo get_avatar(um_user('ID'), 120); ?>
                                        </a>
                                    </div>

                                <?php } ?> <div class="media-body profile-detail ml-3 rtl-mr-3 rtl-ml-0">
                                    <h3> <?= $current_user->user_login ?></h3>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6  col-6 pl-2 ">
                                <div class="profile-details text-center">
                                    <a href="<?= um_user_profile_url(); ?>" class="iq-sub-card bg-primary-light rounded-small p-2">
                                        <div class="rounded iq-card-icon-small">
                                            <i class="icon-user-alt"></i>
                                        </div>
                                        <h6 class="mb-0 truncate-text-1">حساب کاربری من</h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6 col-6 pr-2">
                                <div class="profile-details text-center">
                                    <a href="<?= site_url(); ?>/account" class="iq-sub-card bg-danger-light rounded-small p-2">
                                        <div class="rounded iq-card-icon-small">
                                            <i class="icon-user-cog"></i>
                                        </div>
                                        <h6 class="mb-0 truncate-text-1">ویرایش حساب کاربری</h6>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            <!-- <p class="mb-1">حسابدار</p> -->
                            <a href="<?= wp_logout_url(home_url()); ?>" class=" ml-3 rtl-mr-3 rtl-ml-0 logout-btn">خروج</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</li>