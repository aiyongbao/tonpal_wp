<?php
// about.json -> vars 数据获取
$theme_vars = json_config_array('about', 'vars');
$about_title = ifEmptyText($theme_vars['title']['value'], 'About');
$about_rich_text = ifEmptyText($theme_vars['richText']['value']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>


<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <?php get_template_part('templates/components/head'); ?>
</head>

<body>
    <div class="container">
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
                <!--// aside end -->
                <!-- main begin -->
                <section class="main">
                    <div class="product-intro">
                        <h1 class="product-title"><?php echo $about_title; ?></h1>
                    </div>
                    <div class="tab-content-wrap product-detail">
                        <div class="tab-panel-wrap">
                            <div class="tab-panel">
                                <div class="tab-panel-content entry">
                                    <section class="mt15">
                                        <p><?php echo $about_rich_text; ?></p>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php get_template_part('templates/components/sendMessage') ?>
            </div>
            </section>
            <!--// main end -->
        </div>
    </div>
    <!--// main_content end -->
    <!--  footer start -->
    <?php get_template_part('templates/components/footer'); ?>
    <!--  footer end -->
    </div>
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>