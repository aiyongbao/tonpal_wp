<?php
global $wp; // Class_Reference/WP 类实例

// home.json -> widgets 数据获取
$theme_widgets = json_config_array('home', 'widgets');

// home.json -> vars 数据获取
$theme_vars = json_config_array('home', 'vars');
// widgets 数据处理

$home_carousel = $theme_widgets['carousel'];
$company_synopses = $theme_widgets['companySynopses'];

$about_us = $theme_widgets['aboutUs'];

$hot_product = $theme_widgets['featuredProducts'];

$promote_layer = $theme_widgets['promoteLayer'];

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
    <link rel="stylesheet" href="//q.zvk9.com/Model20/assets/css/swiper.min.css">
</head>

<body>
<?php get_header(); ?>

<?php if ($home_carousel['display'] == 1) { ?>
    <section id="rev_slider_3_1_wrapper" class="rev_slider_wrapper fullscreen-container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach ( $home_carousel['vars']['items']['value'] as $item ) { ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $item['link'] ?>"><img style="width:100%;" src="<?php echo $item['image'] ?>"
                             alt="<?php echo $item['title'] ?>" title="<?php echo ifEmptyText($item['title']) ?>" /></a>
                    </div>
                <?php } ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-button-prev" style="z-index: 9999;pointer-events: unset;" ></div>
            <div class="swiper-button-next" style="z-index: 9999;pointer-events: unset;" ></div>
        </div>
        <div class="page-end"></div>
    </section>
<?php } ?>

<div class="main_content index-main-content">
    <!-- company synopses -->
    <?php if ($company_synopses['display'] == 1) {
        $company_synopses_title = ifEmptyText($company_synopses['vars']['title']['value']);
        $company_synopses_bg = ifEmptyText($company_synopses['vars']['bg']['value'],'//q.zvk9.com/Model20/assets/images/sys_bg.jpg');
        $company_synopses_item = ifEmptyArray($company_synopses['vars']['items']['value']);
    ?>
        <section class="gd-layer company-synopses" style="background-image: url(<?php echo $company_synopses_bg; ?>)">
            <div class="layout wow fadeInUpA">
                <header class="index-title-bar">
                    <h2 class="index-title"><a href=""><?php echo $company_synopses_title; ?></a></h2>
                </header>
                <div class="layer-body">
                    <ul class="synopsis-slides">
                        <?php foreach ($company_synopses_item as $key => $item) {
                            if ($key > 3) return;
                            ?>
                                <li class="synopsis-item  wow fadeInUpA">
                                    <figure class="item-wrap">
                                        <span class="item-hd-line"></span>
                                        <a href="<?php echo ifEmptyText($item['link'],'javascript:;'); ?>" class="item-img"><img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['title']); ?>" style='height:199px'/></a>
                                        <figcaption class="item-info">
                                            <h2 class="item-title"><a href="<?php echo ifEmptyText($item['link'],'javascript:;'); ?>" class="limit-1-line"><?php echo ifEmptyText($item['title']) ?></a></h2>
                                            <div class="item-desc limit-3-line"><?php echo ifEmptyText($item['desc']) ?></div>
                                            <div class="item-more"><a href="<?php echo ifEmptyText($item['link'],'javascript:;'); ?>" class="read-more"><?php echo ifEmptyText($item['btn'],'READ MORE') ?></a></div>
                                        </figcaption>
                                        <span class="item-ft-line"></span>
                                    </figure>
                                </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- about us -->
    <?php if ($about_us['display'] == 1) {
        $about_us_title = ifEmptyText($about_us['vars']['title']['value']);
        $about_us_image = ifEmptyText($about_us['vars']['image']['value']);
        $about_us_link = ifEmptyText($about_us['vars']['link']['value'],'/aboutus');
        $about_us_icon = ifEmptyText($about_us['vars']['icon']['value'],'//q.zvk9.com/Model20/assets/images/about_tit_ico.png');
        $about_us_desc = ifEmptyText($about_us['vars']['desc']['value']);
        $about_us_btn = ifEmptyText($about_us['vars']['btn']['value'],'Read More');
    ?>
        <section class="gd-layer gm-sep about-us">
            <div class="layout wow fadeInUpA">
                <header class="index-title-bar">
                    <h2 class="index-title"><a href="<?php echo $about_us_link; ?>"><?php echo $about_us_title; ?></a></h2>
                </header>
                <div class="layer-body">
                    <div class="about-img">
                        <ul class="slides">
                            <li class="item"><a href="<?php echo $about_us_link; ?>"><img src="<?php echo $about_us_image; ?>" alt="<?php echo $about_us_title; ?>" /></a></li>
                        </ul>
                    </div>
                    <span class="about-tit-ico"><img src="<?php echo $about_us_icon; ?>" alt="" /></span>
                    <div class="about-detail">
                        <div class="limit-7-line" style='height:164px'>
                            <div class="text" style="text-align: left; overflow : hidden; text-overflow: ellipsis; display: -webkit-box !important; -webkit-line-clamp: 8!important; -webkit-box-orient: vertical;height:185px;">
                                <?php echo $about_us_desc; ?>
                            </div>
                        </div>
                        <div class="about-more"><a href="<?php echo $about_us_link; ?>"><?php echo $about_us_btn; ?></a></div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>


    <!-- product items -->
    <?php if ($hot_product['display'] == 1) {
        $hot_product_title = ifEmptyText($hot_product['vars']['title']['value']);
        $hot_product_item = ifEmptyArray($hot_product['vars']['items']['value']);
    ?>
        <section class="gd-layer product-items">
            <div class="layout wow fadeInUpA">
                <header class="index-title-bar">
                    <h2 class="index-title"><a><?php echo $hot_product_title ?></a></h2>
                </header>
                <div class="layer-body">
                    <ul class="items-content">
                        <?php foreach ($hot_product_item as $item) { ?>
                            <li class="product-item">
                                <figure class="item-wrap">
                                    <a href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"
                                       title="<?php echo ifEmptyText($item['title']) ?>"
                                        class="item-img" >
                                        <img src="<?php echo ifEmptyText($item['image']) ?>"
                                             alt="<?php echo ifEmptyText($item['title']) ?>" />
                                    </a>
                                    <figcaption class="item-info">
                                        <h3 class="item-title">
                                            <a href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"
                                               title="<?php echo ifEmptyText($item['title']) ?>"
                                               class="limit-2-line"><?php echo ifEmptyText($item['title']) ?>
                                            </a>
                                        </h3>
                                    </figcaption>
                                </figure>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- promote layer -->
    <?php if ($promote_layer['display'] == 1) {
    $promote_layer_title = ifEmptyText($promote_layer['vars']['title']['value']);
    $promote_layer_image = ifEmptyText($promote_layer['vars']['image']['value']);
    $promote_layer_link = ifEmptyText($promote_layer['vars']['link']['value'],'javascript:;');
    ?>
        <section class="gd-layer promote-layer" style="margin-top:80px;">
            <div class="layout wow fadeInUpA">
                <div class="layer-body">
                        <div class="promote-detail">
                            <a href='<?php echo $promote_layer_link; ?>'><p class="promote-desc"><?php echo $promote_layer_title; ?></p></a>
                        </div>
                        <div class="promote-img">
                            <a href='<?php echo $promote_layer_link; ?>'><img src="<?php echo $promote_layer_image; ?>" /></a>
                        </div>
                </div>
            </div>
        </section>
    <?php } ?>
</div>

<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>
<!--  footer end -->
</body>
<?php get_footer(); ?>
<script type="text/javascript" src="//q.zvk9.com/Model20/assets/js/swiper.min.js"></script>

<script type="text/javascript">
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
        },
        autoplay:true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
</html>