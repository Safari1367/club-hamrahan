<?php
$frontId = get_option('page_on_front');
$cards = get_field('cards', $frontId);
?>

<div class="col-sm-12 col-md-6 col-lg-12">
    <div class="row cart-part d-flex mb-3">

        <?php
        if (is_array($cards) && count($cards) > 0) :
            $key = 1;
            foreach ($cards as $card) :  ?>

                <div class="cart-front-target d-flex <?= $card['bg_color'] ?>  card-height ">
                    <div class="icon-box mb-2 d-flex justify-content-center">
                        <i class="<?= $card['card_icon_class'] ?>"></i>
                    </div>

                    <div class="iq-text text-box d-flex">
                        <h6 class="text-white truncate-text-1 mb-3"><?= $card['card_title'] ?></h6>
                        <h3 class="text-white"><?= $card['card_number'] ?></h3>
                    </div>

                </div>

        <?php
                $key++;
            endforeach;
        endif; ?>

    </div>
</div>