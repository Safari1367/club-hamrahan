<?php

$frontId = get_option('page_on_front');
$KnowledgeTitle = get_field('Knowledge_title', $frontId);


/*
Template Name: Home
*/
get_header();
if (is_front_page()) :
?>
    <div class="content-page rtl-page front-page">
        <div class="container-fluid">


            <?php get_template_part('templates/front-page/hero-part'); ?>

            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <?php if ($KnowledgeTitle) : ?>
                            <div class="header-title">
                                <h4 class="card-title"><?= $KnowledgeTitle ?></h4>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php

                            echo do_shortcode('[betterdocs_category_box_2 column="1" nested_subcategory="false" terms="false" terms_orderby="" kb_slug="" multiple_knowledge_base="false" title_tag="h5"]');
                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php get_template_part('templates/front-page/discount-part'); ?>
        </div>
        <div class="row">

            <?php get_template_part('templates/front-page/news-part'); ?>

            <?php get_template_part('templates/front-page/radio-part'); ?>

            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="row">

                    <?php get_template_part('templates/front-page/file-part'); ?>
                    <?php get_template_part('templates/front-page/cards-part'); ?>
                </div>

            </div>
        </div>

        <?php get_template_part('templates/front-page/blog-part'); ?>



    </div>
    </div>

    </div>
    <!-- Wrapper End-->
<?php

endif;
get_footer();
?>