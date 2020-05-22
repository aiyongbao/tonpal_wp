<?php

$carousel_vars = get_query_var('home_carousel');

if($carousel_vars['display'] == 1) {
    ?>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ( $carousel_vars['vars']['items']['value'] as $item ) { ?>
                <div class="swiper-slide">
                    <img src="<?php echo $item['image'] ?>"
                         alt="<?php echo $item['title'] ?>" title="<?php echo ifEmptyText($item['title']) ?>" />
                </div>
            <?php } ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

<?php } ?>