<div class="row">
    <div class="col-sm-12">
        <!-- <nav aria-label="breadcrumb">
                            <ol class="breadcrumb rtl-home">
                                <li class="breadcrumb-item"><a href="#"><i
                                            class="icon-house-window mr-1 float-left rtl-ml-1 rtl-mr-0"></i>Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#"><i class="icon-arrow-left-long"></i>Library</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><i class="icon-arrow-left-long"></i>Data</li>
                            </ol>
                        </nav> -->

        <?php
        // Add bread crumb with rank math
        if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs();
        ?>

    </div>

</div>