<?php
$theme_vars = json_config_array('header', 'vars', 1);
$post = get_post();
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID, 'seo_title', true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID, 'seo_description', true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID, 'seo_keywords', true));
$page_url = get_full_path();
// 按钮内容
$productDetail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$productDetail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);
// 产品图片
$photos = ifEmptyArray(get_post_meta(get_post()->ID, 'photos'));
$photosArray = [];
foreach ($photos as $key => $item) {
    array_push($photosArray, json_decode($photos[$key], true));
}

$pdf = ifEmptyText(get_post_meta(get_post()->ID, 'pdf', true));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php get_template_part('templates/components/head') ?>
    <style>
        .pagesList {
            display: flex;
        }

        .pagesList li.active a {
            background: #f00000;
            color: #fff;
            border-color: #f00000;
        }

        .main .items_list .product_item figure span.item_img {
            width: 300px;
            height: 295px;
        }

        .intro_desc {
            color: #666;
            font-size: 16px;
        }

        .product_item .item_title a {
            text-align: center;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            font-size: 16px;
            padding: 0;
        }

        .sub_head_intro div.intro_desc {
            padding: 0;
        }

        @media only screen and (max-width: 950px) {
            .sub_head_intro {
                padding: 15px 0 0;
            }

            .web_main .layout {
                width: 98%;
            }

            .web_main .main>.items_list>ul {
                margin: 0;
            }

            .web_main .main .items_list ul {
                width: 100%;
                margin: 0;
            }

            .main .items_list .product_item figure {
                border: 1px solid #efefef;
            }

            .main .items_list .product_item .item_img,
            .goods-may-like .product_item .item_img {
                border: none;
                width: 100% !important;
            }

            .side-product-items .side_product_item {
                width: 30% !important;
            }

            ul.swiper-wrapper.left-swiper-ul li {
                width: 20%;
            }

            .side-widget .tags a {
                display: block;
                float: left;
                padding: 5px;
                border: 1px solid #efefef;
                margin: 0 5px 5px 0;
            }
        }

        @media only screen and (max-width: 480px) {
            .main .items_list .product_item figure span.item_img {
                height: 220px;
                line-height: 220px;
            }

            .layout,
            .index_product .layout,
            .index_featured .layout {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- header -->
        <?php get_header() ?>

        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <div class="main_content">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aisde end -->

                <!-- main start -->
                <section class="main  single-product-main">
                    <!-- product info -->
                    <h1 class="product-title"><?php echo $post->post_title ?></h1>
                    <div class="product-intro">
                        <div class="product-view" style="width:350px;">
                            <i class='before' onclick="swiperSingleProductImage('L')">
                                <</i> <i class='after' onclick="swiperSingleProductImage('R')">>
                            </i>
                            <div class="product-image">
                                <a class="certificate-fancy" target="_blank" href="<?php echo ifEmptyText($photosArray[0]['url']) ?>">
                                    <img src="<?php echo ifEmptyText($photosArray[0]['url']) ?>" alt="<?php echo ifEmptyText($photosArray[0]['alt']) ?>" style="width:100%" />
                                </a>
                            </div>
                            <div class="image-additional">
                                <ul class="image-items">
                                    <?php foreach ($photosArray as $key => $item) { ?>
                                        <li class="image-item">
                                            <!-- <a href='<?php echo ifEmptyText($item['url']) ?>' class='fancy-item' target="_blank" href="javascript:;"> -->
                                            <img src="<?php echo ifEmptyText($item['url']) ?>" alt="<?php echo ifEmptyText($item['alt']) ?>" />
                                            <!-- </a> -->
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <br>
                        </div>
                        <div class="product-summary" style="padding-left:0;">
                            <div class="product-meta">
                                <p><?php echo $post->post_excerpt ?></p>
                                <br>
                            </div>
                            <div style="height: 90px" class="lb"></div>
                            <div class="gm-sep product-btn-wrap">
                                <a href="#myform" class="email"><?php echo $productDetail_inquiry_btn ?></a>
                                <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $productDetail_download_btn ?>ok</a>
                                <?php if ($pdf !== '') { ?>
                                    <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $productDetail_download_btn ?></a>
                                <?php } ?>
                            </div>
                            <div class="share-this">
                                <!--share-->
                                <script async src="//platform-api.sharethis.com/js/sharethis.js#property=58cb62ef8263e70012464e1a&product=inline-share-buttons"></script>
                                <div class="sharethis-inline-share-buttons" style="float:right"></div>
                                <!--// share-->
                            </div>
                        </div>
                    </div>

                    <!-- tab-content-wrap,tab-title-bar,tab-title ,tab-panel-wrap,tab-panel为结构不做样式用-->
                    <div class="tab-content-wrap product-detail">
                        <?php
                        $newArray = [];
                        $contentArray = json_decode($post->post_content, true);
                        foreach ($contentArray as $key => $item) {
                            if ($item['content'] !== '') {
                                $newArray[$key]['tabName'] = $item['tabName'];
                                $newArray[$key]['content'] = $item['content'];
                            }
                        }
                        ?>

                        <div>
                            <!-- 详情按钮区 -->
                            <div class="gm-sep tab-title-bar detail-tabs">
                                <?php foreach ($newArray as $key => $item) { ?>
                                    <h2 class="tab-title  title"><span><?php echo $item['tabName']; ?></span></h2>
                                <?php } ?>
                            </div>
                            <!-- 富文本区 -->
                            <div class="tab-panel-wrap mb0">
                                <?php foreach ($newArray as $key => $item) { ?>
                                    <div class="tab-panel">
                                        <div class="tab-panel-content entry">
                                            <div class="fl-rich-text">
                                                <div class="tab-content">
                                                    <?php if ($key == 0) { ?>
                                                        <div role="tabpanel" class="tab-pane active" id="detail_tab<?php echo $key ?>">
                                                            <?php echo $item['content']; ?>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div role="tabpanel" class="tab-pane" id="detail_tab<?php echo $key ?>"><?php echo $item['content']; ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- 上一篇/下一篇 -->
                        <div>
                            <?php get_prev_or_next_post('prev_post', 'prev', 'Prev: ', 'no prev product'); ?>
                            <?php get_prev_or_next_post('next_post', 'next', 'Next: ', 'no next product'); ?>
                        </div>

                        <!-- Tags -->
                        <?php get_template_part('templates/components/tags-random-category') ?>

                        <!-- 产品推荐 -->
                        <div class='single-products'>
                            <?php get_template_part('templates/components/related-products') ?>
                        </div>

                        <!-- inquiry form -->
                        <?php get_template_part('templates/components/send-message'); ?>
                    </div>

                </section>
                <!--// main end -->
            </div>
        </div>

        <!-- footer -->
        <?php get_template_part('templates/components/footer') ?>
    </div>
</body>
<?php get_footer(); ?>

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>
</html>