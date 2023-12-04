<?php

get_header();
?>
<div class="content-page rtl-page">


    <div class="container-fluid">
        <?php
        get_template_part('templates/content/breadcrumb');
        ?>
        <div class="row">

            <div class="col-sm-12 col-lg-9">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card card-block card-stretch card-height blog blog-detail">
                                <div class="pr-4 pt-3">

                                    <h1 class=""><?= get_the_title(); ?></h1>

                                </div>

                                <div class="card-body">

                                    <?php

                                    get_template_part('templates/content/single');

                                    if (get_queried_object()->post_type == 'file') :
                                        get_template_part('templates/content/file-single');

                                    endif;

                                    get_template_part('templates/content/like-dislike'); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) : ?>



                            <div class="col-md-12">
                                <div class="card card-block card-stretch card-height blog user-comment">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">نظر کاربران</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="card-transparent card-block card-stretch card-height blog">
                                                    <?php
                                                    comments_template();
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>


                <?php
                endwhile;
                ?>


            </div>

            <?php dynamic_sidebar('main_sidebar'); ?>
            <?php get_sidebar() ?>
        </div>



    </div>
</div>

</div>

<?php get_footer();
