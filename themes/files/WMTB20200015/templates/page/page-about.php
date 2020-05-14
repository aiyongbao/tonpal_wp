<?php
// about.json -> vars 数据获取
$theme_vars = json_config_array('about', 'vars');

//Text 数据处理
$about_title = ifEmptyText($theme_vars['title']['value'], 'About');
$about_rich_text = ifEmptyText($theme_vars['richText']['value']);
$about_bottom_image = ifEmptyText($theme_vars['image']['value']);
$products_bg = ifEmptyText($theme_vars['bg']['value']);

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
        <!-- web_head start -->
        <?php get_header() ?>
        <!--// web_head end -->
        <?php if (!empty($products_bg)) { ?>
            <div class="page_bg" style='background: url("<?php echo $products_bg; ?>") fixed no-repeat center center'>
            </div>
        <?php } ?>
        <!-- path -->
        <?php get_breadcrumbs(); ?>
        <!-- page-layout start -->
        <section class="web_main page_main">
            <div class="layout about">
                <!-- main start -->
                <section class="main about">
                    <header>
                        <h1 class="about-title"><?php echo $about_title ?></h1>
                    </header>
                    <article class="blog-article">
                        <section class="mt15">
                            <p><?php echo $about_rich_text; ?></p>
                        </section>
                        <?php if (!empty($about_bottom_image)) { ?>
                            <div class="about-bottom">
                                <div class="img-wrapper">
                                    <img src="<?php echo $about_bottom_image; ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </article>
                    <?php get_template_part('templates/components/sendMessage') ?>
                    <?php get_template_part('templates/components/tags-random-product'); ?>
                </section>
                <!--// main end -->
            </div>
        </section>
        <!--// page-layout end -->

        <!-- web_footer start -->
        <?php get_template_part('templates/components/footer'); ?>
        <!--// web_footer end -->
    </div>
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>