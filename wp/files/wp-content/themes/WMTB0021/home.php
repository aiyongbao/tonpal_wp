<?php
// widgets 数据处理
$theme_widgets = json_config_array(__FILE__,'widgets');
set_query_var('home_carousel', $theme_widgets['carousel']);

// home.json -> vars 数据获取
$theme_vars = json_config_array(__FILE__,'vars');
// Array 数据处理
$home_special = $theme_widgets['special'];
$home_about = $theme_widgets['about'];
$home_hotProduct = $theme_widgets['hotProduct'];
$home_modularFour = $theme_widgets['modularFour'];
$home_modularFive = $theme_widgets['modularFive'];
$home_modularSix = $theme_widgets['modularSix'];
$home_modularSeven = $theme_widgets['modularSeven'];

// SEO
$seo_Title = ifEmptyText($theme_vars['seoTitle']['value'],'Home');
$seo_Description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_Keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
global $wp;
// 当前页面url
$page_url = get_lang_page_url();
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_Title; ?></title>
    <meta name="keywords" content="<?php echo $seo_Description; ?>" />
    <meta name="description" content="<?php echo $seo_Keywords; ?>" />

    <link rel="canonical" href="<?php echo $page_url;?>" />
    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .hero-section {
            padding: 300px 0 290px;
        }
        .card-title {
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .card-body > p {
            height: 56px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
<!-- preloader start -->
<div class="preloader">
    <img src="<?php echo get_template_directory_uri()?>/assets/images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

<!-- header -->
<?php get_header()?>
<!-- /header -->

<!-- carousel -->
<?php get_template_part( 'templates/components/carousel' ); ?>
<!-- /carousel -->

<!-- banner-feature -->
<?php if ($home_special['display'] == 1) {
    $home_special_imag = ifEmptyText($home_special['var']['imag']['value']);
    $home_special_item = ifEmptyArray($home_special['var']['item']['value']);
    ?>
    <section class="bg-gray">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-4 col-lg-5 align-self-end">
                    <img class="img-fluid w-100" src="<?php echo $home_special_imag?>" alt="banner-feature">
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="row feature-blocks bg-gray justify-content-between">
                        <?php foreach ($home_special_item as $key => $item) { ?>
                            <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
                                <i class="mb-xl-4 mb-lg-3 mb-4">
                                    <img src="<?php echo ifEmptyText($item['icon']) ?>" width="50" height="50" alt="" />
                                </i>
                                <?php
                                if (ifEmptyText($item['link'] !== ''))
                                {
                                    ?>
                                    <a href="<?php echo ifEmptyText($item['link'],'##') ?>">
                                        <h3 class="mb-xl-4 mb-lg-3 mb-4"><?php echo ifEmptyText($item['title'],'This is title') ?></h3>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <h3 class="mb-xl-4 mb-lg-3 mb-4"><?php echo ifEmptyText($item['title'],'This is title') ?></h3>
                                    <?php
                                }
                                ?>
                                <p><?php echo ifEmptyText($item['desc'],'This is desc') ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!-- /banner-feature -->

<!-- about us -->
<?php if ($home_about['display'] == 1) {
    $home_about_title = ifEmptyText($home_about['var']['title']['value']);
    $home_about_desc1 = ifEmptyText($home_about['var']['desc1']['value']);
    $home_about_desc2 = ifEmptyText($home_about['var']['desc2']['value']);
    $home_about_image = ifEmptyText($home_about['var']['image']['value']);
    $home_about_btn = ifEmptyText($home_about['var']['btn']['value']);
    $home_about_link = ifEmptyText($home_about['var']['link']['value'],'##');
?>
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-2 order-md-1">
                <h2 class="section-title"><?php echo $home_about_title; ?></h2>
                <p><?php echo $home_about_desc1; ?></p>
                <p><?php echo $home_about_desc2; ?></p>
                <a href="<?php echo $home_about_link; ?>" class="btn btn-primary-outline"><?php echo $home_about_btn; ?></a>
            </div>
            <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                <img class="img-fluid w-100"
                     src="<?php echo $home_about_image ?>"
                     alt="<?php echo $home_about_title ?>">
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- /about us -->

<!-- courses -->
<?php if ($home_hotProduct['display'] == 1) {
$home_hotProduct_title = ifEmptyText($home_hotProduct['var']['title']['value']);
$home_hotProduct_btn = ifEmptyText($home_hotProduct['var']['btn']['value']);
$home_hotProduct_link = ifEmptyText($home_hotProduct['var']['link']['value'],'##');
$home_hotProduct_item = ifEmptyArray($home_hotProduct['var']['item']['value']);
?>
<section class="section-sm">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center section-title justify-content-between">
                    <h2 class="mb-0 text-nowrap mr-3"><?php echo $home_hotProduct_title?></h2>
                    <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                    <div>
                        <a href="<?php echo $home_hotProduct_link ?>"
                           class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block"><?php echo $home_hotProduct_btn ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- course list -->
        <div class="row justify-content-center">
            <!-- course item -->
            <?php foreach ($home_hotProduct_item as $key => $item) { ?>
                <div class="col-lg-4 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <img class="card-img-top rounded-0"
                             src="<?php echo ifEmptyText($item['image'],'https://iph.href.lu/350x350?text=350x350') ?>"
                             alt="<?php echo ifEmptyText($item['title']) ?>">
                        <div class="card-body">
                            <a href="<?php echo ifEmptyText($item['link']) ?>">
                                <h4 class="card-title"><?php echo ifEmptyText($item['title'],'This is title') ?></h4>
                            </a>
                            <p class="card-text mb-4"><?php echo ifEmptyText($item['desc'],'This is desc') ?></p>
                            <a href="<?php echo ifEmptyText($item['link'],'##') ?>" class="btn btn-primary btn-sm"><?php echo ifEmptyText($item['btn']) ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- /course list -->
        <!-- mobile see all button -->
        <div class="row">
            <div class="col-12 text-center">
                <a href="<?php echo $home_hotProduct_link ?>" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block"><?php echo $home_hotProduct_btn ?></a>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<!-- /courses -->

<!-- cta -->
<?php if ($home_modularFour['display'] == 1) {
    $home_modularFour_desc1 = ifEmptyText($home_modularFour['var']['desc1']['value']);
    $home_modularFour_desc2 = ifEmptyText($home_modularFour['var']['desc2']['value']);
    $home_modularFour_btn = ifEmptyText($home_modularFour['var']['btn']['value']);
    $home_modularFour_link = ifEmptyText($home_modularFour['var']['link']['value'],'##');
?>
<section class="section bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h6 class="text-white font-secondary mb-0"><?php echo $home_modularFour_desc1 ?></h6>
                <h2 class="section-title text-white"><?php echo $home_modularFour_desc2 ?></h2>
                <a href="<?php echo $home_modularFour_link ?>" class="btn btn-secondary"><?php echo $home_modularFour_btn ?></a>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<!-- /cta -->

<!-- success story -->
<?php if ($home_modularFive['display'] == 1) {
    $home_modularFive_title = ifEmptyText($home_modularFive['var']['title']['value']);
    $home_modularFive_desc1 = ifEmptyText($home_modularFive['var']['desc1']['value']);
    $home_modularFive_desc2 = ifEmptyText($home_modularFive['var']['desc2']['value']);
    $home_modularFive_video = ifEmptyText($home_modularFive['var']['video']['value'],"##");
    $home_modularFive_bg = ifEmptyText($home_modularFive['var']['bg']['value']);
?>
    <section class="section bg-cover" data-background="<?php echo $home_modularFive_bg ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-4 position-relative success-video">
                    <a class="play-btn venobox" href="<?php echo $home_modularFive_video ?>" data-vbtype="video">
                        <i class="ti-control-play"></i>
                    </a>
                </div>
                <div class="col-lg-6 col-sm-8">
                    <div class="bg-white p-5">
                        <h2 class="section-title"><?php echo $home_modularFive_title ?></h2>
                        <p><?php echo $home_modularFive_desc1 ?></p>
                        <p><?php echo $home_modularFive_desc2 ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!-- /success story -->

<!-- events -->
<?php if ($home_modularSix['display'] == 1) {
    $home_modularSix_title = ifEmptyText($home_modularSix['var']['title']['value']);
    $home_modularSix_link = ifEmptyText($home_modularSix['var']['link']['value'],'##');
    $home_modularSix_btn = ifEmptyText($home_modularSix['var']['btn']['value']);
    $home_modularSix_item = ifEmptyArray($home_modularSix['var']['item']['value']);
?>
<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center section-title justify-content-between">
                    <h2 class="mb-0 text-nowrap mr-3"><?php echo $home_modularSix_title ?></h2>
                    <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                    <div>
                        <a href="<?php echo $home_modularSix_link ?>" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block"><?php echo $home_modularSix_btn ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- event -->
            <?php foreach ($home_modularSix_item as $key => $item) { ?>
                <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card border-0 rounded-0 hover-shadow">
                        <div class="card-img position-relative">
                            <img class="card-img-top rounded-0" src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['title']) ?>">
                            <?php
                            if (ifEmptyText($item['customTop']) !== '' && ifEmptyText($item['customBtm'] !== '' )) {
                                ?>
                                <div class="card-date">
                                    <span><?php echo ifEmptyText($item['customTop']) ?></span><br><?php echo ifEmptyText($item['customBtm']) ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <!-- location -->
                            <p><i class="ti-location-pin text-primary mr-2"></i><?php echo ifEmptyText($item['desc'],'This is desc') ?></p>
                            <a href="<?php echo ifEmptyText($item['link'],'##') ?>"><h4 class="card-title"><?php echo ifEmptyText($item['title']) ?></h4></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- mobile see all button -->
        <div class="row">
            <div class="col-12 text-center">
                <a href="<?php echo $home_modularSix_link ?>" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block"><?php echo $home_modularSix_btn ?></a>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<!-- /events -->

<!-- blog -->
<?php if ($home_modularSeven['display'] == 1) {
    $home_modularSeven_title = ifEmptyText($home_modularSeven['var']['title']['value']);
    $home_modularSeven_item = ifEmptyArray($home_modularSeven['var']['item']['value']);
?>
<section class="section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title"><?php echo $home_modularSeven_title ?></h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- blog post -->
            <?php foreach ($home_modularSeven_item as $key => $item) { ?>
                <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                    <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                        <img class="card-img-top rounded-0" src="<?php echo ifEmptyText($item['image'],'https://iph.href.lu/350x263?text=350x263') ?>" alt="<?php echo ifEmptyText($item['title'],'##') ?>">
                        <div class="card-body">
                            <!-- post meta -->
                            <ul class="list-inline mb-3">
                                <!-- post date -->
                                <li class="list-inline-item mr-3 ml-0"><?php echo ifEmptyText($item['time'],'This is time') ?></li>
                                <!-- author -->
                                <li class="list-inline-item mr-3 ml-0">By <?php echo ifEmptyText($item['author'],'This is author') ?></li>
                            </ul>
                            <a href="blog-single.html">
                                <h4 class="card-title"><?php echo ifEmptyText($item['title'],'This is title') ?></h4>
                            </a>
                            <p class="card-text"><?php echo ifEmptyText($item['desc'],'This is desc') ?></p>
                            <a href="<?php echo ifEmptyText($item['link'],'##') ?>" class="btn btn-primary btn-sm">read more</a>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<!-- /blog -->
<!-- footer -->
<?php get_template_part( 'templates/components/footer' ); ?>

</body>
<?php get_footer(); ?>

</html>

