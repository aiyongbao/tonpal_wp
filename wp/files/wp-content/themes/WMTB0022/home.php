<?php
// home.json -> widgets 数据获取
$theme_widgets = json_config_array(__FILE__,'widgets');
set_query_var('home_carousel', $theme_widgets['carousel']);

// home.json -> vars 数据获取
$theme_vars = json_config_array(__FILE__,'vars');
// widgets 数据处理
$home_modularOne = $theme_widgets['modularOne'];

$home_special = $theme_widgets['special'];
$home_about = $theme_widgets['about'];
$home_hotProduct = $theme_widgets['hotProduct'];
$home_modularTwo = $theme_widgets['modularTwo'];
$home_news = $theme_widgets['news'];

// SEO
$seo_Title = ifEmptyText($theme_vars['seoTitle']['value'],'Home');
$seo_Description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_Keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
global $wp;
// 当前页面url
$page_url = get_lang_page_url();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $seo_Title; ?></title>
    <meta name="keywords" content="<?php echo $seo_Description; ?>" />
    <meta name="description" content="<?php echo $seo_Keywords; ?>" />

    <link rel="canonical" href="<?php echo $page_url;?>" />
    <?php get_template_part( 'templates/components/head' )?>
</head>
<body>
<div class="container">
    <!-- header -->
    <?php get_header()?>
    <!-- /header -->

    <!-- carousel -->
    <?php get_template_part( 'templates/components/carousel' ); ?>
    <!-- /carousel -->

    <!-- main_content start -->

    <div class="main_content index-main-content">
        <?php if ($home_modularOne['display'] == 1) {
        $home_modularOne_title = ifEmptyText($home_modularOne['vars']['title']['value']);
        $home_modularOne_desc = ifEmptyText($home_modularOne['vars']['desc']['value']);
        $home_modularOne_item = ifEmptyArray($home_modularOne['vars']['items']['value']);
        ?>
        <section class="lead-panel">
            <div class="layout">
                <div class="layer-body">
                    <div class="layer-cont" style="text-align:center; text-transform:uppercase">
                        <div class="layer-desc"><?php echo $home_modularOne_title ?></div>
                    </div>

                </div>
            </div>
        </section>
        <!-- best products -->
        <section class="gd-layer product-items layer-best">
            <div class="layout">
                <header class="index-title-bar">
                    <div class="title-desc"><?php echo $home_modularOne_desc ?></div>
                </header>
                <div class="layer-body">
                    <ul class="items-content">
                        <?php foreach ($home_modularOne_item as $item) { ?>
                            <li class="product-item indexproduct">
                                <figure class="item-wrap">
                                    <a href="<?php echo ifEmptyText($item['link']) ?>" class="item-img"
                                       style="width:280px;height:280px;display:table-cell;vertical-align:middle;">
                                        <img src="<?php echo ifEmptyText($item['image']) ?>"/>
                                    </a>
                                    <figcaption class="item-info">
                                        <h3 class="item-title">
                                            <a href="<?php echo ifEmptyText($item['link']) ?>" title="<?php echo ifEmptyText($item['title']) ?>">
                                                <?php echo ifEmptyText($item['title']) ?>
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
        <!-- company synopses -->
        <?php if ($home_special['display'] == 1) {
        $home_special_title = ifEmptyText($home_special['vars']['title']['value']);
        $home_special_item = ifEmptyArray($home_special['vars']['items']['value']);
        ?>
        <section class="gd-layer company-synopses">
            <div class="layout">
                <header class="index-title-bar">
                    <h2 class="index-title"><?php echo $home_special_title ?></h2>
                </header>
                <div class="layer-body">
                    <div class="synopses-list">
                        <ul>
                            <?php foreach ($home_special_item as $item) { ?>
                                <li class="synopsis-item">
                                    <div class="item-wrap">
                                        <figure class="item-img"><img src="<?php echo ifEmptyText($item['icon']) ?>" alt="icon"></figure>
                                        <figcaption class="item-info">
                                            <h2 class="item-title"><?php echo ifEmptyText($item['title']) ?></h2>
                                            <div class="item-desc"><?php echo ifEmptyText($item['desc']) ?></div>
                                        </figcaption>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php }?>
        <!-- about us -->
        <?php if ($home_about['display'] == 1) {
        $home_about_title = ifEmptyText($home_about['vars']['title']['value']);
        $home_about_desc = ifEmptyText($home_about['vars']['desc']['value']);
        $home_about_image = ifEmptyText($home_about['vars']['image']['value']);
        $home_about_btn = ifEmptyText($home_about['vars']['btn']['value']);
        $home_about_link = ifEmptyText($home_about['vars']['link']['value'],'##');
        ?>
            <section class="gd-layer about-us">
                <div class="layout">
                    <div class="layer-body">
                        <div class="about-detail">
                            <h2 class="about-title"><?php echo $home_about_title ?></h2>
                            <div class="about-desc">
                                <dl class="desc-item">
                                    <dd><?php echo $home_about_desc ?></dd>
                                </dl>
                            </div>
                            <div class="gd-btn-box">
                                <a class="gd-btn-7 gd-btn" href="<?php echo $home_about_link ?>"><?php echo $home_about_btn ?></a>
                            </div>
                        </div>
                        <div class="about-img">
                            <img src="<?php echo $home_about_image ?>" alt="<?php echo $home_about_title ?>"/>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <!-- featured products -->
        <?php if ($home_hotProduct['display'] == 1) {
        $home_hotProduct_title = ifEmptyText($home_hotProduct['vars']['title']['value']);
        $home_hotProduct_item = ifEmptyArray($home_hotProduct['vars']['items']['value']);
        ?>
            <section class="gd-layer product-items layer-featured">
                <div class="layout">
                    <header class="index-title-bar">
                        <h2 class="index-title"><?php echo $home_hotProduct_title ?></h2>
                    </header>
                    <div class="layer-body">
                        <ul class="items-content">
                            <?php foreach ($home_hotProduct_item as $item) { ?>
                                <li class="product-item indexproduct">
                                    <figure class="item-wrap">
                                        <a href="<?php echo $item['link'] ?>" title="<?php echo $item['title'] ?>"
                                        class="item-img">
                                        <img src="<?php echo $item['image'] ?>_thumb_262x262.jpg"
                                             alt="<?php echo $item['title'] ?>"/>
                                        </a>
                                        <figcaption class="item-info">
                                            <h3 class="item-title">
                                                <a href="<?php echo $item['link'] ?>" title="<?php echo $item['link'] ?>">
                                                    <?php echo $item['title'] ?>
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
        <!-- inquiry -->
        <?php if ($home_modularTwo['display'] == 1) {
            $home_modularTwo_title = ifEmptyText($home_modularTwo['vars']['title']['value']);
            $home_modularTwo_desc = ifEmptyText($home_modularTwo['vars']['desc']['value']);
            $home_modularTwo_btn = ifEmptyText($home_modularTwo['vars']['btn']['value']);
            $home_modularTwo_link = ifEmptyText($home_modularTwo['vars']['link']['value']);
        ?>
            <section class="inquiry-panel">
                <div class="layout">
                    <div class="layer-body">
                        <div class="layer-cont">
                            <h2 class="layer-title"><?php echo $home_modularTwo_title ?></h2>
                            <div class="layer-desc"><?php echo $home_modularTwo_desc ?></div>
                        </div>
                        <div class="layer-ft">
                            <div class="gd-btn-box">
                                <a href="<?php echo $home_modularTwo_link ?>" class="gd-btn"><?php echo $home_modularTwo_btn ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <!-- news -->
        <?php if ($home_news['display'] == 1) {
            $home_news_title = ifEmptyText($home_news['vars']['title']['value']);
            $home_news_item = ifEmptyText($home_news['vars']['items']['value']);
        ?>
        <section class="gd-layer promote-banners">
            <div class="layout">
                <header class="index-title-bar">
                    <h2 class="index-title"><?php echo $home_news_title ?></h2>
                </header>
                <div class="layer-body">
                    <div class="banner-list">
                        <?php foreach ($home_news_item as $item ) { ?>
                            <div class="banner-item">
                                <a href="<?php echo $item['link'] ?>" class="item-inner">
                                    <figure class="banner-img" style="width:387px;height:199px">
                                        <img style="width:387px;height:199px"
                                             src="<?php echo $item['image'] ?>"
                                             alt="<?php echo $item['title'] ?>">
                                    </figure>
                                    <figcaption class="banner-info">
                                        <h4 class="item-tit"><?php echo $item['title'] ?></h4>
                                        <div class="item-desc"><?php echo $item['desc'] ?></div>
                                    </figcaption>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part( 'templates/components/footer' ); ?>
        <!--  footer end -->
    </div>
    <!--// container end -->

    <?php get_footer(); ?>

    <script type="text/javascript" src="//q.zvk9.com/Model15/assets/js/swiper.min.js"></script>

    <script type="text/javascript">
        var swiper = new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
            },
            autoplay: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</div>
</body>
</html>


