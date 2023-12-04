<?php
$post_id = get_queried_object_id();
$fileDescription = get_field('all_description_file', $post_id);
$installDescription = get_field('install_description', $post_id);
?>
<div class="card file-download-tab">

    <div class="card-body ">

        <ul class="nav nav-tabs" id="myTab-two" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-two" data-toggle="tab" href="#home-two" role="tab" aria-controls="home" aria-selected="true">
                    <h5>فایل دانلود </h5>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-two" data-toggle="tab" href="#profile-two" role="tab" aria-controls="profile" aria-selected="false">
                    <h5>توضیحات تکمیی</h5>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab-two" data-toggle="tab" href="#contact-two" role="tab" aria-controls="contact" aria-selected="false">
                    <h5> مراحل نصب</h5>
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent-1">
            <div class="tab-pane fade show active" id="home-two" role="tabpanel" aria-labelledby="home-tab-two">
                <div class="install-file">
                    
                    <a href="<?= esc_url(get_field('file_download_item', $post_id)) ?>"><i class="icon-download"></i>برای دانلود کلیک کنید </a>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-two" role="tabpanel" aria-labelledby="profile-tab-two">
                <?= ($fileDescription) ? $fileDescription : '' ?>
            </div>
            <div class="tab-pane fade" id="contact-two" role="tabpanel" aria-labelledby="contact-tab-two">
                <?= ($installDescription) ? $installDescription : '' ?>
            </div>
        </div>
    </div>
</div>