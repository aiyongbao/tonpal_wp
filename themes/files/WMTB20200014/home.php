<?php
global $wp; // Class_Reference/WP 类实例

// home.json -> widgets 数据获取
$theme_widgets = json_config_array('home','widgets');

// home.json -> vars 数据获取
$theme_vars = json_config_array('home','vars');
// widgets 数据处理

$home_carousel = $theme_widgets['carousel'];
$home_modular_one = $theme_widgets['modularOne'];

$home_special = $theme_widgets['special'];
$home_about = $theme_widgets['about'];
$home_hot_product = $theme_widgets['hotProduct'];
$home_modular_two = $theme_widgets['modularTwo'];
$home_modular_three = $theme_widgets['modularThree'];
$home_news = $theme_widgets['news'];

// SEO
$seo_Title = ifEmptyText($theme_vars['seoTitle']['value'],'Home');
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
// 当前页面url
$page_url = get_full_path(1);
?>
<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <title><?php echo $seo_Title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <link rel="canonical" href="<?php echo $page_url;?>" />
    <?php get_template_part( 'templates/components/head' )?>
</head>
<body>
<div class="container">

    <!-- web_head start -->
    <?php get_header(); ?>
    <!--// web_head end -->



    <!-- web_main start -->
    <section class="web_main index_main">

        <!-- banner -->
        <?php if ($home_carousel['display'] == 1) {
            $home_carousel_items = ifEmptyArray($home_carousel['vars']['items']['value']);
            ?>
            <section class="slider_banner">
                <div class="swiper-wrapper">
                    <?php foreach ($home_carousel_items as $item ) { ?>
                        <div class="swiper-slide">
                            <a href="<?php echo ifEmptyText($item['link'],'javascript:;');?>">
                                <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['title']); ?>" title="<?php echo ifEmptyText($item['title']); ?>" />
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="index-swiper-buttons">
                    <div class="swiper-button-prev swiper-button-white"><span class="slide-page-box"></span></div>
                    <div class="swiper-button-next swiper-button-white"><span class="slide-page-box"></span></div>
                </div>
                <div class="slider_swiper_control">
                    <div class="swiper-pagination swiper-pagination-white">
                        <div class="layout">
                            <div class="pagination-box"></div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- index_advantage -->
        <?php if ($home_special['display'] == 1) {
            $home_special_title = ifEmptyText($home_special['vars']['title']['value']);
            $home_special_image = ifEmptyText($home_special['vars']['image']['value']);
            $home_special_items = ifEmptyArray($home_special['vars']['items']['value']);
            ?>
            <section class="index_advantage">
                <div class="index_bd">
                    <div class="layout">
                        <ul class="advantage_items flex_row">
                            <?php foreach ($home_special_items as $key=>$item) { ?>
                                <li class="advantage_item flex_row wow <?php echo ($key == 0 || $key == 2) ? 'fadeInLeftA' : 'fadeInRightA';?>" data-wow-delay="<?php echo ($key == 0 || $key == 1) ? '0.1' : '0.2'; ?>" data-wow-duration=".8s">
                                    <div class="item_hd">0<?php echo $key+1; ?></div>
                                    <div class="item_bd">
                                        <h3 class="item_title"><a class="ellipsis-1" href="<?php echo ifEmptyText($item['link']); ?>"><?php echo ifEmptyText($item['title']); ?></a></h3>
                                        <p class="item_desc ellipsis-3"><?php echo ifEmptyText($item['desc']); ?></p>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="advantage_img wow fadeInDownA" data-wow-delay=".1s" data-wow-duration=".8s">
                            <div style="display: inline-block; width: 100%; padding-bottom: 100%; position: absolute; vertical-align: middle; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                <img style="width: 85%; height: 85%; object-fit: cover; position:absolute; left: 7.5%; top: 7.5%" src="<?php echo $home_special_image; ?>" alt="<?php echo $home_special_title; ?>" title="<?php echo $home_special_title; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- index_product -->
        <?php if ($home_hot_product['display'] == 1) {
            $home_hot_product_title = ifEmptyText($home_hot_product['vars']['title']['value']);
            $home_hot_product_items = ifEmptyArray($home_hot_product['vars']['items']['value']);
            ?>
            <section class="index_product">
                <div class="index_hd">
                    <div class="layout">
                        <h2 class="hd_title ellipsis-1"><?php echo $home_hot_product_title; ?></h2>
                    </div>
                </div>
                <div class="index_bd">
                    <div class="layout">
                        <ul class="product_items sys_row flex_row">
                            <?php foreach ($home_hot_product_items as $item) { ?>
                                <li class="product_item wow fadeInLeftA" data-wow-delay=".<?php echo $key+1; ?>s" data-wow-duration=".8s">
                                    <figure>
                                    <span class="item_img">
                                        <img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['title']); ?>" />
                                        <a href="<?php echo ifEmptyText($item['link']); ?>"></a>
                                    </span>
                                        <figcaption>
                                            <h3 class="item_title"><a class="ellipsis-2" href="<?php echo ifEmptyText($item['link']); ?>"><?php echo ifEmptyText($item['title']); ?></a></h3>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- index_product -->
        <?php if ($home_modular_one['display'] == 1) {
            $home_modular_one_image = ifEmptyText($home_modular_one['vars']['image']['value']);
            $home_modular_one_title = ifEmptyText($home_modular_one['vars']['title']['value']);
            $home_modular_one_desc = ifEmptyText($home_modular_one['vars']['desc']['value']);
            ?>
            <section class="index_counter" style="background-image: url(<?php echo $home_modular_one_image; ?>)">
                <div class="index_bd">
                    <div class="layout">
                        <ul class="couner_items sys_row flex_row">
                            <li class="counter_item">
                                <div class="couner_num">
                                    <span class="count-title ellipsis-3"><?php echo $home_modular_one_title; ?></span>
                                </div>
                                <div class="couner_bd ellipsis-8">
                                    <?php echo $home_modular_one_desc; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- index_company_intr -->
        <?php if ($home_about['display'] == 1) {
            $home_about_image = ifEmptyText($home_about['vars']['image']['value']);
            $home_about_title = ifEmptyText($home_about['vars']['title']['value']);
            $home_about_link = ifEmptyText($home_about['vars']['link']['value'],'javascript:;');
            $home_about_items = ifEmptyArray($home_about['vars']['items']['value']);
            ?>
            <section class="index_company_intr">
                <div class="index_bd">
                    <div class="layout">
                        <div class="sys_row flex_row flex-box">
                            <div class="company_intr_img">
                                <div class="intr_img_box">
                                    <div class="company_intr_slider">
                                        <a href="<?php echo $home_about_link; ?>">
                                            <img src="<?php echo $home_about_image; ?>" alt="<?php echo $home_about_title; ?>" title="<?php echo $home_about_title; ?>" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="company_intr_cont">
                                <h2 class="company_intr_title ellipsis-1"><?php echo $home_about_title; ?></h2>
                                <ul class="company_intr_group">
                                    <?php foreach ($home_about_items as $key => $item) { ?>
                                        <li class="intr_group_item wow fadeInRightA <?php if ($key == 0) echo 'active'; ?>" data-wow-delay=".<?php echo $key+1; ?>s" data-wow-duration=".5s">
                                            <div class="intr_group_hd">
                                                <i class="fa group_hd_arrow"></i>
                                                <h4 class="group_hd_title ellipsis-1"><?php echo ifEmptyText($item['title']); ?></h4>
                                            </div>
                                            <div class="intr_group_bd">
                                                <div class="intr_group_cont">
                                                    <p class="ellipsis-5"><?php echo ifEmptyText($item['desc']); ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- index_ad -->
        <?php if ($home_modular_two['display'] == 1) {
            $home_modular_two_items = ifEmptyArray($home_modular_two['vars']['items']['value']);
        ?>
        <section class="index_ad">
            <div class="index_bd">
                <div class="layout">
                    <ul class="ad_items sys_row flex_row flex-box">
                        <?php foreach ($home_modular_two_items as $key => $item) { ?>
                            <li class="ad_item wow fadeInUpA" data-wow-delay=".<?php echo $key+1; ?>s" data-wow-duration=".8s">
                                <figure class="item_inner">
                                    <span class="item_img"><img src="<?php echo get_template_directory_uri()?>/assets/images/index_ad_0<?php echo $key+1; ?>.png" alt="" /><img src="<?php echo get_template_directory_uri()?>/assets/images/index_ad_0<?php echo $key+1; ?>.png" alt="" /></span>
                                    <figcaption class="item_info">
                                        <h3 class="item_title"><a href="<?php echo ifEmptyText($item['link'],'javascript:;');?>"><?php echo ifEmptyText($item['title']); ?></a></h3>
                                        <p class="item_desc"><?php echo ifEmptyText($item['desc']);?></p>
                                    </figcaption>
                                    <i class="corner_left"></i>
                                    <i class="corner_right"></i>
                                </figure>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
        </section>
        <?php } ?>

        <!-- company_subscribe -->
        <?php if ($home_modular_three['display'] == 1) {
            $home_modular_three_title = ifEmptyText($home_modular_three['vars']['title']['value']);
            $home_modular_three_desc = ifEmptyText($home_modular_three['vars']['desc']['value']);
            $home_modular_three_link = ifEmptyText($home_modular_three['vars']['link']['value']);
            $home_modular_three_image = ifEmptyText($home_modular_three['vars']['image']['value']);
        ?>
        <section class="company_subscribe" style="background-image: url(<?php echo $home_modular_three_image; ?>)">
            <div class="index_bd">
                <div class="layout">
                    <div class="sys_row flex_row">
                        <div class="subscribe_cont">
                            <h3 class="subscribe_title ellipsis-2"><?php echo $home_modular_three_title; ?></h3>
                            <p class="subscribe_desc ellipsis-8"><?php echo $home_modular_three_desc; ?></p>
                        </div>
                        <?php if ($home_modular_three_link != '') {
                            $home_modular_three_btn = ifEmptyText($home_modular_three['vars']['btn']['value']);
                            ?>
                            <div class="learn_more">
                                <a class="sys_btn button ellipsis-1" href="<?php echo $home_modular_three_link; ?>"><?php echo $home_modular_three_desc; ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>

        <!-- index_news -->
        <?php if ($home_news['display'] == 1) {
        $home_news_title = ifEmptyText($home_news['vars']['title']['value']);
        $home_news_item = ifEmptyArray($home_news['vars']['items']['value']);
        ?>
        <section class="index_news">
            <div class="index_hd">
                <div class="layout">
                    <h2 class="hd_title ellipsis-1"><?php echo $home_news_title; ?></h2>
                </div>
            </div>
            <div class="index_bd">
                <div class="layout">
                    <div class="news_slider">
                        <ul class="swiper-wrapper news_items sys_row">
                            <?php foreach ($home_news_item as $key => $item ) { ?>
                                <li class="swiper-slide news_item wow <?php echo $key == 1 ? 'fadeInUpA' : 'fadeInDownA'; ?>" data-wow-delay=".<?php echo $key+1; ?>s" data-wow-duration=".8s">
                                    <figure class="item_inner">
                                        <span class="item_img"><a href="<?php echo ifEmptyText($item['link']); ?>"><img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['title']); ?>"></a></span>
                                        <figcaption class="item_info">
                                            <h3 class="item_title"><a href=""><?php echo ifEmptyText($item['title']); ?></a></h3>
                                            <p class="item_desc"><?php echo ifEmptyText($item['desc']); ?></p>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="swiper-control index_swiper_control">
                            <div class="swiper-buttons">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
    </section>
    <!--// web_main end -->


    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--  footer end -->

    <!-- web_footer start -->

</div>
</body>
<?php get_footer(); ?>
</html>


