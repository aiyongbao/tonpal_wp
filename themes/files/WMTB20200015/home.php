<?php
global $wp; // Class_Reference/WP 类实例

// home.json -> widgets 数据获取
$theme_widgets = json_config_array('home', 'widgets');

// home.json -> vars 数据获取
$theme_vars = json_config_array('home', 'vars');
// widgets 数据处理

$home_carousel = $theme_widgets['carousel'];

$home_about = $theme_widgets['aboutLeft'];

$home_adv = $theme_widgets['aboutRight'];

$home_collections = $theme_widgets['featuredCollections'];

$home_products = $theme_widgets['featuredProducts'];

$home_news = $theme_widgets['news'];

// SEO
$seo_Title = ifEmptyText($theme_vars['seoTitle']['value'], 'Home');
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
// 当前页面url
$page_url = get_full_path();
?>
<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <title><?php echo $seo_Title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php get_template_part('templates/components/head') ?>
</head>

<body>
    <div class="container">
        <?php get_header(); ?>
        <section class="web_main index_main">
            <!-- banner -->
            <?php if ($home_carousel['display'] == 1) {
                $home_carousel_items = ifEmptyArray($home_carousel['vars']['items']['value']);
            ?>
                <section class="slider_banner">
                    <div class="swiper-wrapper">
                        <?php foreach ($home_carousel_items as $item) { ?>
                            <div class="swiper-slide">
                                <a href="<?php echo ifEmptyText($item['link'], 'javascript:;'); ?>">
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




            <div class="index_layer">
                <div class="layout">
                    <?php if ($home_about['display'] == 1) {
                        $widget_vars = ifEmptyArray($home_about['vars']);
                    ?>
                        <!-- index_company_intr -->
                        <div class="index_company_intr wow fadeInLeftA">
                            <div class="index_title">
                                <h2><?php echo $widget_vars['title']['value'] ?></h2>
                                <h4><?php echo $widget_vars['desc']['value'] ?></h4>
                            </div>
                            <div class="company_intr_text"><?php echo $widget_vars['content']['value'] ?></div>
                            <a class="company_intr_more sys_btn" target="_blank" href="<?php echo $widget_vars['link']['value'] ?>">More About Us</a>
                        </div>
                    <?php } ?>
                    <!-- index_promote -->

                    <?php if ($home_adv['display'] == 1) {
                        $widget_vars = ifEmptyArray($home_adv['vars']);
                    ?>
                        <div class="index_promote wow fadeInRightA">
                            <div class="promote_item anm_shine">
                                <figure>
                                    <span class="item_img"><a href="<?php echo $widget_vars['link']['value'] ?>"><img src="<?php echo $widget_vars['image']['value'] ?>" alt=""></a></span>
                                    <figcaption class="item_info">
                                        <h3 class="item_title"><?php echo $widget_vars['title']['value'] ?></h3>
                                        <p class="item_desc"><?php echo $widget_vars['desc']['value'] ?></p>
                                    </figcaption>
                                </figure>
                            </div>
                            <h3 class="promote_tit"><?php echo $widget_vars['extra_title']['value'] ?></h3>
                            <div class="promote_desc"><?php echo $widget_vars['extra_desc']['value'] ?></div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <?php if ($home_collections['display'] == 1) {
                $widget_vars = ifEmptyArray($home_collections['vars']);
            ?>
                <div class="index_ad" style="background-image: url(<?php echo ifEmptyText($widget_vars['bg']['value']) ?>">
                    <div class="layout">
                        <div class="index_title wow fadeInUpA" data-wow-delay=".1s">
                            <h2><?php echo $widget_vars['title']['value'] ?></h2>
                            <h4><?php echo $widget_vars['desc']['value'] ?></h4>
                        </div>
                        <div class="index_bd">
                            <ul class="ad_items">
                                <?php foreach ($widget_vars['items']['value'] as $key => $item) { ?>

                                    <li class="ad_item wow fadeInUpA anm_shine" data-wow-delay=".1s">
                                        <figure>
                                            <span class="item_img"><img src="<?php echo $item['image'] ?>" alt=""></span>
                                            <figcaption class="item_info">
                                                <span class="item_ico"><?php echo $key + 1 ?></span>
                                                <h3 class="item_title"><a href=""><?php echo $item['title'] ?></a></h3>
                                                <span class="item_text">
                                                    <?php echo $item['desc'] ?>
                                                </span>
                                            </figcaption>
                                        </figure>
                                    </li>

                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>


            <!-- index_product -->
            <?php if ($home_products['display'] == 1) {
                $widget_vars = ifEmptyArray($home_products['vars']);
            ?>
                <div class="index_product">
                    <div class="layout">
                        <div class="index_title wow fadeInUpA" data-wow-delay=".1s">
                            <h2><?php echo $widget_vars['title']['value'] ?></h2>
                            <h4><?php echo $widget_vars['desc']['value'] ?></h4>
                        </div>
                        <div class="index_bd">
                            <div class="product_slider">
                                <ul class="swiper-wrapper">

                                    <?php foreach ($widget_vars['items']['value'] as $key => $item) { ?>
                                        <li class="swiper-slide product_item wow fadeInUpA">
                                            <figure> <span class="item_img"><img src="<?php echo $item['image'] ?>" alt="" /><a target="_blank" href="<?php echo $item['link'] ?>"></a></span>
                                                <figcaption>
                                                    <h3 class="item_title"><a href="<?php echo $item['link'] ?>"><?php echo $item['desc'] ?></a></h3>
                                                </figcaption>
                                            </figure>
                                        </li>
                                    <?php } ?>

                                </ul>
                                <div class="swiper-button-prev"><i></i></div>
                                <div class="swiper-button-next"><i></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($home_news['display'] == 1) {
                $widget_vars = ifEmptyArray($home_news['vars']);
            ?>
                <div class="index_news">
                    <div class="layout">
                        <div class="index_title wow fadeInUpA">
                            <h2><?php echo $widget_vars['title']['value'] ?></h2>
                            <h4><?php echo $widget_vars['title']['sub_title'] ?></h4>
                        </div>
                        <div class="index_bd">

                            <?php foreach ($widget_vars['items']['value'] as $key => $item) { ?>
                                <?php if ($key == 0) {  ?>
                                    <div class="news_wide">
                                        <div class="news_item wow fadeInUpA">
                                            <div class="item_img"><a href=""><img src="<?php echo $item['image'] ?>" alt=""></a></div>
                                            <div class="item_inner">
                                                <time class="item_time"><?php echo $item['date'] ?> </time>
                                                <h3 class="item_tit"><a target="_blank" href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></h3>
                                                <p class="item_desc"><?php echo $item['desc'] ?></p>
                                                <a class="sys_btn" target="_blank" href="<?php echo $item['link'] ?>">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="news_side">
                                        <div class="news_item wow fadeInUpA">
                                            <div class="item_inner">
                                                <time class="item_time"><?php echo $item['date'] ?> </time>
                                                <h3 class="item_tit"><a target="_blank" href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a></h3>
                                                <p class="item_desc"><?php echo $item['desc'] ?></p>
                                                <a class="sys_btn" target="_blank" href="<?php echo $widget_vars['link'] ?>">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </section>

        <!-- web_footer start -->
        <?php get_template_part( 'templates/components/footer' ); ?>
        <!--// web_footer end -->

    </div>


</body>
<?php get_footer(); ?>
</html>