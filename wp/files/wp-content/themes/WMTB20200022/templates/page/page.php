<?php
$post = get_post();
// page.json -> vars 数据获取
$theme_vars = json_config_array('page','vars');
// Text 数据处理
$page_title = ifEmptyText($theme_vars['title']['value']);
$page_rich_text = ifEmptyText($theme_vars['richText']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_description; ?>" />
    <meta name="description" content="<?php echo $seo_keywords; ?>" />

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .tab-panel a {
            margin-right: 12px;
        }

        table {
            width: 100% !important;
        }

        /* .product-image {
             width: 381px;
             height: 381px;
             display: flex;
             justify-content: center;
             align-items: center;
         }*/

        .product-view .image-additional li a {
            width: 65.75px;
            height: 65.75px;
        }

        /*@media only screen and (max-width: 950px) {
            .product-image {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }*/
    </style>
</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_header()?>
    <!--// header end  -->
    <!-- path -->
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <div class="main_content">
        <div class="layout">
            <!--  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aisde end -->
            <!-- main start -->
            <section class="main">
                <!-- product info -->
                <h1 class="product-title"><?php echo $page_title ?></h1>
                <!-- tab-content-wrap,tab-title-bar,tab-title ,tab-panel-wrap,tab-panel为结构不做样式用-->
                <div class="tab-content-wrap product-detail">
                    <div class="tab-panel-wrap mb0">
                        <div class="tab-panel">
                            <div class="tab-panel-content entry">
                                <div class="fl-rich-text">
                                    <?php echo $page_rich_text ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- inquiry form -->
                <?php get_template_part( 'templates/components/sendMessage' )?>
            </section>
            <!--// main end -->
        </div>
    </div>
    <!--// main_content end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' )?>
</div>
</body>
<?php get_footer() ?>
<!-- 微数据 -->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
