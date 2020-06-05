<?php

$carousel_vars = get_query_var('home_carousel');
$carouse = ifEmptyArray($carousel_vars['vars']['items']['value']);

if ($carousel_vars['display'] == 1) { ?>
    <section id="rev_slider_3_1_wrapper" class="rev_slider_wrapper fullscreen-container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if ($carouse !== []) { ?>
                    <?php foreach ($carouse as $item) { ?>
                        <div class="swiper-slide" style="width: 100%; padding-bottom: 30%; position: relative; display: inline-block">
                                <img style="position: absolute; width: 100%; height: 100%; object-fit: cover;top: 0; left: 0" src="<?php echo $item['image'] ?>" alt="<?php echo $item['title'] ?>">
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="swiper-slide"><img style="width:100%;" src="https://q.zvk9.com/25060/2019/09/27/banner.jpg"></div>
                <?php } ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

<?php } ?>