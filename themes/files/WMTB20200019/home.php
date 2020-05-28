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
                <div class="slider_swiper_buttons index_swiper_control">
                    <div class="swiper-button-prev swiper-button-white"><span class="slide-page-box"></span></div>
                    <div class="swiper-button-next swiper-button-white"><span class="slide-page-box"></span></div>
                </div>
                <div class="slider_swiper_control">
                    <div class="swiper-pagination swiper-pagination-white"></div>
                </div>
            </section>
        <?php } ?>

        <!-- index_business -->
        <?php if ($home_special['display'] == 1) {
            $home_special_title = ifEmptyText($home_special['vars']['title']['value']);
            $home_special_icon = ifEmptyText($home_special['vars']['icon']['value']);
            $home_special_desc = ifEmptyText($home_special['vars']['desc']['value']);
            $home_special_btn = ifEmptyText($home_special['vars']['btn']['value']);
            $home_special_link = ifEmptyText($home_special['vars']['link']['value'],'javascript:;');
            $home_special_items = ifEmptyArray($home_special['vars']['items']['value']);
            ?>
            <section class="index_business">
                <div class="index_bd">
                    <div class="layout">
                        <div class="sys_row flex_row">
                            <div class="sys_col business_cont">
                                <div class="business_hd">
                                    <h2 class="business_title">
                                        <?php if (!empty($home_special_icon)) { ?>
                                            <i class="title_ico" style="background-image: url('<?php echo $home_special_icon; ?>')"></i>
                                        <?php } ?>
                                        <em class="title_txt"><?php echo $home_special_title; ?></em>
                                    </h2>
                                </div>
                                <div class="business_desc"><?php echo $home_special_desc; ?></div>
                                <div class="learn_more">
                                    <a href="<?php echo $home_special_link; ?>" class="sys_btn"><?php echo $home_special_btn; ?></a>
                                </div>
                            </div>
                            <div class="sys_col business_img">
                                <div class="business_slider">
                                    <div class="swiper-container">
                                        <ul class="swiper-wrapper">
                                            <?php foreach ($home_special_items as $item) { ?>
                                                <li class="swiper-slide"><img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['alt']); ?>"></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="swiper-control index_swiper_control">
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- index_product -->
        <?php if ($home_hot_product['display'] == 1) {
            $product_title = ifEmptyText($home_hot_product['vars']['title']['value']);
            $product_icon = ifEmptyText($home_hot_product['vars']['icon']['value']);
            $product_items = ifEmptyArray($home_hot_product['vars']['items']['value']);
            ?>
            <section class="index_product">
                <div class="index_hd">
                    <div class="layout">
                        <h2 class="hd_title"><?php echo $product_title; ?></h2>
                        <?php if (!empty($product_icon)) { ?>
                            <i class="title_ico" style="background-image: url('<?php echo $product_icon; ?>')"></i>
                        <?php } ?>
                    </div>
                </div>
                <div class="index_bd">
                    <div class="layout">
                        <div class="product_slider">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper product_items">
                                    <?php foreach ($product_items as $item) { ?>
                                        <li class="swiper-slide product_item">
                                            <figure>
                                                <span class="item_img">
                                                  <img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['title']) ?>" />
                                                  <a href="<?php echo ifEmptyText($item['link'],'javascript:;'); ?>"></a>
                                                </span>
                                                <figcaption>
                                                    <h3 class="item_title"><a href="<?php echo ifEmptyText($item['link'],'javascript:;'); ?>"><?php echo ifEmptyText($item['title']); ?></a></h3>
                                                </figcaption>
                                            </figure>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="swiper_control index_swiper_control">
                                <div class="swiper_buttons">
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

        <!-- index_product -->
        <?php if ($home_modular_one['display'] == 1) {
            $modular_one_image = ifEmptyText($home_modular_one['vars']['image']['value']);
            $modular_one_title = ifEmptyText($home_modular_one['vars']['title']['value']);
            $modular_one_btn = ifEmptyText($home_modular_one['vars']['btn']['value']);
            $modular_one_link = ifEmptyText($home_modular_one['vars']['link']['value'],'javascript:;');
            ?>
            <section class="company_subscribe" style="background-image: url(<?php echo $modular_one_image; ?>)">
                <div class="index_bd">
                    <div class="layout">
                        <h2 class="subscribe_title"><?php echo $modular_one_title; ?></h2>
                        <div class="learn_more">
                            <a href="<?php echo $modular_one_link; ?>" class="button sys_btn"><?php echo $modular_one_btn; ?></a>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- index_company_intr -->
        <?php if ($home_about['display'] == 1) {
            $home_about_title = ifEmptyText($home_about['vars']['title']['value']);
            $home_about_icon = ifEmptyText($home_about['vars']['icon']['value']);
            $home_about_link = ifEmptyText($home_about['vars']['link']['value'],'javascript:;');
            $home_about_desc = ifEmptyText($home_about['vars']['desc']['value']);
            $home_about_btn = ifEmptyText($home_about['vars']['btn']['value']);
            $home_about_items = ifEmptyArray($home_about['vars']['items']['value']);
            ?>
            <section class="index_company_intr">
                <div class="index_bd">
                    <div class="layout">
                        <div class="sys_row flex_row">
                            <div class="sys_col company_intr_img">
                                <div class="company_intr_slider">
                                    <div class="swiper-container">
                                        <ul class="swiper-wrapper">
                                            <?php foreach ($home_about_items as $item) { ?>
                                                <li class="swiper-slide"><a href="<?php echo ifEmptyText($item['link'],'javascript:;'); ?>"><img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['alt']); ?>"></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="swiper-control index_swiper_control">
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="sys_col company_intr_cont">
                                <div class="company_intr_hd">
                                    <h2 class="company_intr_title">
                                        <?php if (!empty($home_about_icon)) { ?>
                                            <i class="title_ico" style="background-image: url('<?php echo $home_about_icon; ?>')"></i>
                                        <?php } ?>
                                        <em class="title_txt"><?php echo $home_about_title; ?></em>
                                    </h2>
                                </div>
                                <div class="company_intr_desc"><?php echo $home_about_desc; ?></div>
                                <div class="learn_more">
                                    <a href="<?php echo $home_about_link; ?>" class="sys_btn"><?php echo $home_about_btn; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!-- index_news -->
        <?php if ($home_news['display'] == 1) {
            $news_title = ifEmptyText($home_news['vars']['title']['value']);
            $news_icon = ifEmptyText($home_news['vars']['icon']['value']);
            $news_image = ifEmptyText($home_news['vars']['image']['value']);
            $news_image_title = ifEmptyText($home_news['vars']['imageTitle']['value']);
            $news_item = ifEmptyArray($home_news['vars']['items']['value']);
        ?>
            <section class="index_news">
                <div class="index_hd">
                    <div class="layout">
                        <h2 class="hd_title"><?php echo $news_title ?></h2>
                        <?php if (!empty($news_icon)) { ?>
                            <i class="title_ico" style="background-image: url('<?php echo $news_icon; ?>')"></i>
                        <?php } ?>
                    </div>
                </div>
                <div class="index_bd">
                    <div class="layout">
                        <div class="sys_row flex_row">
                            <div class="sys_col news_main">
                                <?php foreach ($news_item as $item) { ?>
                                    <figure class="news_cell flex_row">
                                        <div class="cell_img">
                                            <a href="<?php echo ifEmptyText($item['link'],'javascript:;'); ?>">
                                                <img src="<?php echo ifEmptyText($item['image']); ?>" alt="<?php echo ifEmptyText($item['title']); ?>">
                                            </a>
                                        </div>
                                        <figcaption class="cell_bd">
                                            <div class="cell_bd_inner">
                                                <time class="news_time"><?php echo ifEmptyText($item['date']); ?></time>
                                                <h3 class="news_title"><a href=""><?php echo ifEmptyText($item['title']); ?></a></h3>
                                                <p class="news_desc"><?php echo ifEmptyText($item['desc']); ?></p>
                                            </div>
                                        </figcaption>
                                    </figure>
                                <?php } ?>
                            </div>
                            <div class="sys_col news_side">
                                <!-- swiper -->
                                <div class="news_thumbs">
                                    <div class="swiper-container">
                                        <ul class="swiper-wrapper">
                                            <li class="swiper-slide">
                                                <figure class="thumbs_item">
                                                    <div class="thumbs_img">
                                                        <a href="">
                                                            <img src="<?php echo $news_image; ?>" alt="<?php echo $news_image_title; ?>">
                                                            <i class="mask_bg mask_bg_1"></i><i class="mask_bg mask_bg_2"></i><i class="mask_bg mask_bg_3"></i><i class="mask_bg mask_bg_4"></i>
                                                        </a>
                                                    </div>
                                                    <figcaption class="thumbs_info">
                                                        <h4 class="thumbs_title"><em><?php echo $news_image_title; ?></em></h4>
                                                    </figcaption>
                                                </figure>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="swiper_control index_swiper_control">
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
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

</div>
<?php get_footer(); ?>

</body>
</html>


