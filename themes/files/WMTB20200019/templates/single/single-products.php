<?php
global $wp; // Class_Reference/WP 类实例
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'), 'Tag');

$post = get_post();
$theme_vars = json_config_array('header', 'vars', 1);
$product_detail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$product_detail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);

// 获取父级的背景图
$page_bg = ifEmptyText(get_term_meta(ROOT_CATEGORY_CID, 'background', true));
// 主图处理
$photos = ifEmptyArray(get_post_meta(get_post()->ID, 'photos'));
$photosArray = [];
foreach ($photos as $key => $item) {
    array_push($photosArray, json_decode($photos[$key], true));
}

// pdf
$pdf = ifEmptyText(get_post_meta(get_post()->ID, 'pdf', true));

// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID, 'seo_title', true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID, 'seo_description', true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID, 'seo_keywords', true));

// 当前页面url
$page_url = get_lang_page_url();

$sub_title = ifEmptyText(get_post_meta(get_post()->ID, 'sub_title', true));

// 详情筛选
$detailArray = [];
$contentArray = json_decode($post->post_content, true);
foreach ($contentArray as $key => $item) {
    if ($item['content'] !== '') {
        $detailArray[$key]['tabName'] = $item['tabName'];
        $detailArray[$key]['content'] = $item['content'];
    }
}

?>
<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- OG -->
    <meta property="og:title" content="<?php echo $post->post_title; ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php echo $page_url; ?>" />
    <meta property="og:description" content="<?php echo $seo_description; ?>" />
    <meta property="og:image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />
    <meta property="og:site_name" content="<?php get_host_name(); ?>" />
    <!-- itemprop -->
    <meta itemprop="name" content="<?php echo $post->post_title; ?>" />
    <meta itemprop="description" content="<?php the_excerpt(); ?>" />
    <meta property="image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />
    <!-- Twitter -->
    <meta name="twitter:site" content="@affiliate_<?php get_host_name();; ?>" />
    <meta name="twitter:creator" content="@affiliate_<?php get_host_name(); ?>" />
    <meta name="twitter:title" content="<?php echo $post->post_title; ?>" />
    <meta name="twitter:description" content="<?php echo $seo_description; ?>" />
    <meta name="twitter:image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />

    <?php get_template_part('templates/components/head') ?>
</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_header() ?>
    <!--// header end  -->
    <?php if (!empty($page_bg)) { ?>
        <section class="sys_sub_head">
            <div class="head_bn_slider">
                <ul class="head_bn_items">
                    <li class="head_bn_item swiper-slide"><img src="<?php echo $page_bg; ?>" alt=""></li>
                </ul>
            </div>
        </section>
    <?php } ?>
    <?php get_breadcrumbs();?>
    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">
            <div class="product-intro">
                <div class="product-view">
                    <div class="product-image">
                        <a class="cloud-zoom" id="zoom1" data-zoom="adjustX:0, adjustY:0" href="<?php echo ifEmptyText($photosArray[0]['url']); ?>" title="">
                            <img src="<?php echo ifEmptyText($photosArray[0]['url']); ?>" itemprop="image" title="" alt="" style="width:100%" />
                        </a>
                    </div>
                    <div style="position:relative; width:460px;">
                        <div class="image-additional" style="width:460px;">
                            <ul class="swiper-wrapper">
                                <?php foreach ($photosArray as $key => $item) { ?>
                                    <li class="swiper-slide image-item <?php if ($key == 0) echo 'current'; ?>">
                                        <a class="cloud-zoom-gallery item" href="<?php echo ifEmptyText($item['url']) ?>" data-zoom="useZoom:zoom1, smallImage:<?php echo ifEmptyText($item['url']) ?>" title="">
                                            <img src="<?php echo ifEmptyText($item['url']) ?>_thumb_262x262.jpg" title="" alt="" />
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="swiper-pagination swiper-pagination-white"></div>
                        </div>
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                </div>
                <div class="product-summary">
                    <?php if ($sub_title == '') { ?>
                        <h1 class="page_title"><?php echo $post->post_title ?></h1>
                    <?php } else {  ?>
                        <div class="page_title">
                            <?php echo $post->post_title ?>
                        </div>
                    <?php }  ?>
                    <?php if ($sub_title != '') { ?>
                        <h1 class="sub-title">
                            <?php echo $sub_title ?>
                        </h1>
                    <?php }  ?>
                    <div class="share_this">
                        <div class="sharethis-inline-share-buttons"></div>
                    </div>
                    <div class="product-meta">
                        <p><?php echo $post->post_excerpt ?></p>
                    </div>
                    <div class="gm-sep product-btn-wrap">
                        <a href="#myform" class="email"><?php echo $product_detail_inquiry_btn ?></a>
                        <?php if ($pdf !== '') { ?>
                            <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $product_detail_download_btn ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="tab-content-wrap product-detail">
                <div class="gm-sep tab-title-bar detail-tabs">
                    <?php foreach ($detailArray as $key => $item) { ?>
                        <h2 class="tab-title  title <?php if ($key == 0) echo 'current'; ?> "><span><?php echo $item['tabName']; ?></span></h2>
                    <?php } ?>
                </div>
                <div class="tab-panel-wrap">
                    <?php foreach ($detailArray as $key => $item) { ?>
                        <div class="tab-panel disabled">
                            <div class="tab-panel-content">
                                <?php echo $item['content']; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="chapter underline border-bottom-2">
                <?php
                // prev
                get_prev_or_next_post('prev', 'prev', 'Prev: ', 'This is the last product.');
                // next
                get_prev_or_next_post('next', 'next', 'Next: ', 'This is the latest product.');
                ?>
            </div>
            <?php get_template_part('templates/components/tags-assembly') ?>
        </div>
        <?php get_template_part('templates/components/related-products') ?>

    </section>
    <div class="page_footer">
        <div class="layout">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
            <?php get_template_part( 'templates/components/tags-random-product' )?>
        </div>
    </div>
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>
<?php get_footer() ?>
<script>

</script>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>