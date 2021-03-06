<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();
// product-detail.json -> vars 数据获取
$theme_vars = json_config_array('header', 'vars', 1);

// Text 数据处理
$productDetail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$productDetail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);

$photos = ifEmptyArray(get_post_meta(get_post()->ID, 'photos'));
$photosArray = [];
foreach ($photos as $key => $item) {
    array_push($photosArray, json_decode($photos[$key], true));
}

$pdf = ifEmptyText(get_post_meta(get_post()->ID, 'pdf', true));
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID, 'seo_title', true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID, 'seo_description', true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID, 'seo_keywords', true));


// 当前页面url
$page_url = get_lang_page_url();

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


    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//q.zvk9.com/plugins/tinymce.20170727.css" rel="stylesheet">
    <link rel="shortcut icon" href="//q.zvk9.com/25060/2019/08/27/logo.png_thumb_150x50.png" />
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="apple-touch-icon-precomposed">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link href="<?php echo get_template_directory_uri() ?>/assets/css/main.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/assets/css/style.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/language.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/custom_service_on.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/custom_service_off.css" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/bottom_service.css" />
    <?php get_template_part('templates/components/head') ?>

    <style>
        .tab-panel a {
            margin-right: 12px;
        }

        table {
            width: 100% !important;
        }

        p {
            word-break: break-all;
        }

        .single-products .side-tags .side-tags-list a {
            display: inline-block;
            /* padding: 15px 1px;
            margin: 15px 15px 0 0; */
            border: none;
        }

        .change-container.container {
            width: 100%;
            padding: 0;
        }

        .product-image {
            width:319px;
            height: 319px;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }

        .product-view .image-additional li a {
            width:106px;
            height: 106px;
        }

        @media only screen and (max-width: 950px) {
            .product-image {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .product-view .image-additional ul li a {
            width: 307px;
            height: 307px;
            }
            .product-btn-wrap {
            position: relative;
            margin: 20px 0 10px 0;
            }

        }

        
    </style>
</head>

<body>
    <div class="container change-container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->
        <!-- path -->
        <nav class="path-bar">
            <?php get_breadcrumbs(); ?>
        </nav>
        <!-- main_content start -->

        <div class="main_content">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aisde end -->
                <!-- main start -->
                <section class="main">
                    <!-- product info -->
                    <h1 class="product-title"><?php echo $post->post_title ?></h1>
                    <div class="product-intro">
                        <div class="product-view">
                            <div class="product-image" style="background-color:white;border:1px solid #eee;">
                                <a class="certificate-fancy" target="_blank" href="<?php echo ifEmptyText($photosArray[0]['url']) ?>">
                                    <img src="<?php echo ifEmptyText($photosArray[0]['url']) ?>" alt="<?php echo ifEmptyText($photosArray[0]['alt']) ?>" style="width:100%" />
                                </a>
                            </div>
                            <div class="image-additional">
                                <ul class="image-items">
                                    <?php foreach ($photosArray as $key => $item) { ?>
                                        <li>
                                            <a style="background-color:white;" _href='<?php echo ifEmptyText($item['url']) ?>' class='fancy-item'href="javascript:;">
                                                <img src="<?php echo ifEmptyText($item['url']) ?>" alt="<?php echo ifEmptyText($item['alt']) ?>" />
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                        <div class="product-summary">
                            <div class="product-meta">
                                <p><?php echo $post->post_excerpt ?></p>
                                <br>
                            </div>
                            <div class="gm-sep product-btn-wrap">
                                <a href="#myform" class="email"><?php echo $productDetail_inquiry_btn ?></a>
                                <?php if ($pdf !== '') { ?>
                                    <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $productDetail_download_btn ?></a>
                                <?php } ?>
                            </div>
                            <div class="share-this">
                                <!--share-->
                                <script async src="//platform-api.sharethis.com/js/sharethis.js#property=58cb62ef8263e70012464e1a&product=inline-share-buttons"></script>
                                <div class="sharethis-inline-share-buttons"></div>
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
                        <div class="gm-sep tab-title-bar detail-tabs">
                            <?php foreach ($newArray as $key => $item) { ?>
                                <h2 class="tab-title  title current"><span><?php echo $item['tabName']; ?></span></h2>
                            <?php } ?>

                        </div>

                        <div class="tab-panel-wrap mb0">
                            <div class="tab-panel disabled">
                                <div class="tab-panel-content entry">
                                    <div class="fl-rich-text">
                                        <?php if (count($newArray) != 1) { ?>
                                            <ul class="nav nav-tabs" role="tablist">
                                                <?php foreach ($newArray as $key => $item) { ?>
                                                    <?php if ($key == 0) { ?>
                                                        <li role="presentation" class="active">
                                                            <a href="#detail_tab<?php echo $key ?>" aria-controls="product-tab" role="tab" data-toggle="tab"><?php echo $item['tabName']; ?></a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li role="presentation">
                                                            <a href="#detail_tab<?php echo $key ?>" aria-controls="product-tab" role="tab" data-toggle="tab"><?php echo $item['tabName']; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php foreach ($newArray as $key => $item) { ?>
                                                    <?php if ($key == 0) { ?>
                                                        <div role="tabpanel" class="tab-pane active" id="detail_tab<?php echo $key ?>">
                                                            <?php echo $item['content']; ?>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div role="tabpanel" class="tab-pane" id="detail_tab<?php echo $key ?>"><?php echo $item['content']; ?></div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active">
                                                    <?php echo $newArray[0]['content']; ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-products">
                        <?php get_template_part('templates/components/tags-random-category') ?>
                    </div>

                    <!-- inquiry form -->
                    <?php get_template_part('templates/components/sendMessage'); ?>
                    <!-- RELATED PRODUCTS -->
                    <?php get_template_part('templates/components/related-products') ?>
                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer') ?>
    </div>

</body>
<?php get_footer() ?>
<script type="text/javascript">
    $('.fancy-item').click(function(){
        var imgSrc = $(this).attr('_href');
        $('.certificate-fancy').attr('href',imgSrc);
        $('.certificate-fancy img').attr('src',imgSrc);
    })

    $('.certificate-fancy').fancybox({
        afterLoad : function() {
            //this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
            this.title = this.title ? this.title : '';
        },
        helpers     : {
            title   : { type : 'inside' },
            buttons : {}
        }
    });
</script>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>