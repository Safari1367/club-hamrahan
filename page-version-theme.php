<?php

/*
* File Name:        version-theme.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/

get_header();
$pageId = get_queried_object_id();

$versions = get_field('add_new_version', $pageId);

?>

<div class="content-page rtl-page">


    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h2 class="card-title"><?= get_the_title(); ?></h4>
                        </div>
                    </div>

                    <?php get_template_part('templates/content/content'); ?>
                    <div class="card-body">
                        <?php if (is_array($versions) && count($versions) > 0) :
                            foreach ($versions as $version) : ?>
                                <div class="row version-row">

                                    <div class="col-md-12">
                                        <div class="version-info  d-flex mb-3">
                                            <div class="version-num d-flex">
                                                <h5>ورژن : </h5>
                                                <span><?= $version['version_number'] ?></span>
                                            </div>
                                            <div class="version-date d-flex">
                                                <h5>تاریخ انتشار : </h5>
                                                <span><?=   date("F j, Y", strtotime($version['version_date'])) ?></span>
                                            </div>

                                        </div>
                                        <ul class="list-group rtl-list-group">
                                            <?php foreach ($version['changes_item'] as $item) : ?>
                                                <li class="mb-2 d-flex">
                                                    <i class="icon-check"></i><span><?= $item['changes_item_title'] ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                </div>
                        <?php
                            endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

<?php
get_footer();

?>