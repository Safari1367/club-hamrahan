<?php
/*
Template Name: introduction view
*/
get_header();


$page_id = get_queried_object_id();
$introductionDescription = get_field('new_introduction_description', $page_id);
$introductionLinkBtn = get_field('form_page_link', $page_id);

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
                            <h4 class="card-title">معرفی همکار جدید</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($introductionDescription) : ?>
                            <div class="truncate-text-3">
                                <?= $introductionDescription; ?>

                            </div>
                        <?php endif;
                        if ($introductionLinkBtn) : ?>
                            <a href="<?= $introductionLinkBtn ?>" class="btn mb-1 btn-primary mt-3">
                                فرم معرفی همکار
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <?php


                    the_content();

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();

?>