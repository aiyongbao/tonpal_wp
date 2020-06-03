<?php
global $wp;
// home.json 数据获取
$theme_vars = json_config_array('home', 'vars');
$theme_widgets = json_config_array('home', 'widgets');
set_query_var('home_carousel', $theme_widgets['carousel']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'], 'Home');
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
// 当前页面url
$page_url = get_full_path();
$readBtn = ifEmptyText(json_config_array('header', 'vars', 1)['readBtn']['value'])
?>

<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php get_template_part('templates/components/head') ?>
    <style>
        .item-main {
            height: 320px;
            width: 300px
        }

        .item-main span {
            height: 215px
        }

        .item-main span img {
            height: 100%
        }

        .fontOTW {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .company_img_box figure iframe {
            width: 100%
        }

        .company_img_box figure {
            display: flex
        }

        .index_main .news_thumbs ul.swiper-wrapper li a img {
            width: 490px !important;
            height: 322px !important;
        }

        .home-product-span {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            float: left;
        }

        @media only screen and (max-width: 950px) {
            .index_main .news_thumbs ul.swiper-wrapper li a img {
                width: 490px !important;
                height: 322px !important;
            }
        }

        @media only screen and (max-width: 450px) {
            .index_main .news_thumbs ul.swiper-wrapper li a img {
                width: 100% !important;
                height: 322px !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- header -->
        <?php get_header() ?>

        <!-- main_content start -->
        <section class="web_main index_main font-microsoft">
            <!-- carousel -->
            <?php get_template_part('templates/components/carousel') ?>

            <!-- index_promote -->
            <?php $homePromote = $theme_widgets['modularTwo'];
            if ($homePromote['display'] == 1) {
                $homePromote_vars = ifEmptyArray($homePromote['vars']);
                $home_promote_mTitle = ifEmptyText($homePromote_vars['mTitle']['value']);
                $home_promote_mSubTitle = ifEmptyText($homePromote_vars['mSubTitle']['value']);
                $homePromoteTitle = ifEmptyText($homePromote_vars['title']['value']);
                $homePromoteDesc = ifEmptyText($homePromote_vars['desc']['value']);
                $homePromoteLink = ifEmptyText($homePromote_vars['link']['value']);
                $homePromoteImage = ifEmptyText($homePromote_vars['image']['value']);
                $homePromoteImageAlt = ifEmptyText($homePromote_vars['imageAlt']['value']); ?>
                <section class="index_promote">
                    <div class="index_bd">
                        <div class="layout">
                            <div class="promote_cell">
                                <figure class="cell_inner flex_row">

                                    <div class="cell_cont wow fadeInLeftA" data-wow-delay=".1s" data-wow-duration=".8s">
                                        <div class="index_hd">
                                            <div class="hd_title">
                                                <h4><?php echo $home_promote_mSubTitle ?></h4>
                                                <h2><?php echo $home_promote_mTitle ?></h2>
                                            </div>
                                        </div>
                                        <div class="cell_info">
                                            <h3 class="cell_title"><?php echo $homePromoteTitle ?></a></h3>
                                            <p class="cell_desc"><?php echo $homePromoteDesc ?></p>
                                        </div>
                                        <div class="item_more">
                                            <a href="<?php echo $homePromoteLink ?>" class="sys_btn sys_btn_wave"><?php echo $readBtn ?><i class="btn_wave_circle"></i></a>
                                        </div>
                                    </div>
                                    <div class="cell_img wow fadeInRightA" data-wow-delay=".2s" data-wow-duration=".8s">
                                        <img src="<?php echo $homePromoteImage ?>" alt="<?php echo $homePromoteImageAlt ?>">
                                    </div>

                                </figure>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <!--// index_promote end -->


            <!-- index_product -->
            <?php $hotProduct =  $theme_widgets['hotProduct'];
            if ($hotProduct['display'] == 1) {
                $hotProduct_vars = ifEmptyText($hotProduct['vars']);
                $hotProduct_bgImage = ifEmptyText($hotProduct_vars['bgImage']['value']);
                $hotProductTitle = ifEmptyText($hotProduct_vars['title']['value']);
                $hotProductSubTitle = ifEmptyText($hotProduct_vars['subTitle']['value']);
                $hotProductDesc = ifEmptyText($hotProduct_vars['desc']['value']);
                $hotProductItem = ifEmptyArray($hotProduct_vars['items']['value']);
            ?>
                <section class="index_product" style="background-image: url(<?php echo $hotProduct_bgImage ?>);background-attachment: fixed;">
                    <div class="index_hd">
                        <div class="layout">
                            <div class="hd_title">
                                <h4><?php echo $hotProductSubTitle; ?></h4>
                                <h2><?php echo $hotProductTitle  ?></h2>
                            </div>
                            <p class="hd_desc"><?php echo $hotProductDesc  ?></p>
                        </div>
                    </div>
                    <div class="index_bd">
                        <div class="layout">
                            <div class="product_slider">
                                <ul class="swiper-wrapper product_items">
                                    <?php if ($hotProductItem != []) { ?>
                                        <?php foreach ($hotProductItem as $item) { ?>
                                            <li class="swiper-slide product_item wow fadeInA" data-wow-delay=".1s" data-wow-duration=".8s">
                                                <figure class="item-main">
                                                    <span class="item_img">
                                                        <img src="<?php echo $item['image'] ?>" alt="<?php echo $item['imageAlt'] ?>" />
                                                        <a href="<?php echo $item['link'] ?>"></a>
                                                    </span>
                                                    <figcaption>
                                                        <h3 class="item_title"><a href="<?php echo $item['link'] ?>"><span class="home-product-span"><?php echo $item['title'] ?></span></a></h3>
                                                        <p class="item_desc fontOTW"><?php echo $item['desc'] ?></p>
                                                    </figcaption>
                                                </figure>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                                <div class="index_swiper_control">
                                    <div class="swiper-buttons">
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <!--// index_product end -->


            <!-- index_company_intr -->
            <?php
            if ($theme_widgets['about']['display'] == 1) {
                $homeAbout = $theme_widgets['about']['vars'];
                $homeAboutTitle = ifEmptyText($homeAbout['title']['value']);
                $homeAboutSubTitle = ifEmptyText($homeAbout['subTitle']['value']);
                $homeAboutDesc = ifEmptyText($homeAbout['desc']['value']);
                $homeAboutVideo = ifEmptyText($homeAbout['video']['value']);
                $homeAboutVideoDesc = ifEmptyText($homeAbout['videoDesc']['value']);
                $homeAboutLink = ifEmptyText($homeAbout['link']['value'])
            ?>
                <section class="index_company_intr">
                    <div class="index_bd">
                        <div class="layout">
                            <div class="company_intr_cont wow fadeInLeftA" data-wow-delay=".2s" data-wow-duration=".8s">
                                <div class="index_hd">
                                    <div class="hd_title">
                                        <h4><?php echo $homeAboutTitle; ?></h4>
                                        <h2><?php echo $homeAboutSubTitle; ?></h2>
                                    </div>
                                </div>
                                <div class="company_intr_desc">
                                    <?php echo $homeAboutDesc; ?>
                                </div>
                                <div class="item_more" style=" transform:translateY(25px)">
                                    <a href="<?php echo $homeAboutLink ?>" class="sys_btn sys_btn_wave"><?php echo $readBtn ?><i class="btn_wave_circle"></i></a>
                                </div>
                            </div>
                            <div class="company_intr_img wow fadeInRightA" data-wow-delay=".2s" data-wow-duration=".8s">
                                <div class="company_img_box">
                                    <figure id="ifream-box">
                                        <?php if ($homeAboutVideo !== '') { ?>
                                            <?php echo $homeAboutVideo ?>
                                        <?php } else { ?>
                                            <?php echo $homeAboutVideoDesc ?>
                                        <?php } ?>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <!--// index_company_intr end -->


            <!-- index_news -->
            <?php if ($theme_widgets['news']['display'] == 1) {
                $homeNews = $theme_widgets['news']['vars'];
                $homeNewsItem = ifEmptyArray($homeNews['items']['value']);
                $home_news_title = ifEmptyText($homeNews['title']['value']);
                $home_news_subTitle = ifEmptyText($homeNews['subTitle']['value']);
            ?>
                <section class="index_news">
                    <div class="index_bd">
                        <div class="layout">
                            <div class="news_cell wow fadeInUpA" data-wow-delay=".2s" data-wow-duration=".8s">
                                <div class="cell_inner">
                                    <div class="cell_img">
                                        <div class="company_img_box">
                                            <div class="news_thumbs">
                                                <ul class="swiper-wrapper">
                                                    <?php if ($homeNewsItem != []) { ?>
                                                        <?php foreach ($homeNewsItem as $item) { ?>
                                                            <li class="swiper-slide"><a href="<?php echo $item['link'] ?>"><img src="<?php echo $item['image'] ?>" alt="<?php echo $item['imageAlt'] ?>"></a></li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <div class="index_swiper_control">
                                                <div class="swiper-buttons">
                                                    <div class="swiper-button-prev"></div>
                                                    <div class="swiper-button-next"></div>
                                                </div>
                                                <div class="swiper-pagination"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell_cont">
                                        <div class="index_hd">
                                            <div class="hd_title">
                                                <h4><?php echo $home_news_subTitle ?></h4>
                                                <h2><?php echo $home_news_title ?></h2>
                                            </div>
                                        </div>
                                        <div class="news_slider">
                                            <ul class="swiper-wrapper">
                                                <?php if ($homeNewsItem != []) { ?>
                                                    <?php foreach ($homeNewsItem as $item) { ?>
                                                        <li class="swiper-slide">
                                                            <div class="item_inner">
                                                                <div class="news_info">
                                                                    <h3 class="news_tit" style="word-wrap: break-word;">
                                                                        <?php echo $item['title'] ?></h3>
                                                                    <p class="news_desc" style="word-wrap:break-word;">
                                                                        <?php echo $item['desc'] ?></p>
                                                                </div>
                                                                <div class="learn_more">
                                                                    <a href="<?php $item['link'] ?>" class="sys_btn sys_btn_wave"><?php echo $readBtn ?><i class="btn_wave_circle"></i></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
            <!--// index_news end -->

        </section>
        <!--// container end -->

        <!-- footer -->
        <?php get_template_part('templates/components/footer') ?>
    </div>
</body>
<?php get_footer(); ?>

</html>