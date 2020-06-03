<?php
$carousel_vars = get_query_var('home_carousel');
if ($carousel_vars['display'] == 1) {
    $carouse = ifEmptyArray($carousel_vars['vars']['items']['value']);
?>
    <section class="slider_banner">
        <div class="swiper-wrapper">
            <?php if ($carouse !== []) { ?>
                <?php foreach ($carouse as $item) { ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $item['link'] ?>">
                            <img style="width:100%;" src="<?php echo $item['image'] ?>" alt="<?php echo $item['title'] ?>">
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <div class="slider_swiper_buttons">
            <div class="swiper-button-prev swiper-button-white"><span class="slide-page-box"></span></div>
            <div class="swiper-button-next swiper-button-white"><span class="slide-page-box"></span></div>
        </div>
        <div class="slider_swiper_control">
            <div class="swiper-pagination swiper-pagination-white"> </div>
        </div>
    </section>

<?php } ?>