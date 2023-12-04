<?php
                if (get_the_content()) :
                ?>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card g-box g-desc">
                                <div class="card-body">
                                    <?php

                                    the_content();

                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>