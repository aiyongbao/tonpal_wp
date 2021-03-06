<?php
// about.json -> vars 数据获取
$theme_vars = json_config_array('about', 'vars');
$about_image = ifEmptyArray($theme_vars['image']['value']);
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
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php get_template_part('templates/components/head'); ?>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->

        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <!-- main_content start -->
        <section class="main_content">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->

                <!-- main begin -->
                <div class='main'>
                    <div class="main-left">
                        <ul class="about-ul">
                            <?php foreach ($about_image as $item) { ?>
                                <li class="about-ul-li">
                                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['alt']; ?>">
                                </li>
                            <?php } ?>
                        </ul>
                        <div class="about-content">
                            <div class="custom-about-article">
                                <p style="margin: 0;"><?php echo $about_rich_text; ?></p>
                            </div>
                        </div>
                    </div>

                    <?php get_template_part('templates/components/send-message') ?>
                </div>
                <!--// main end -->
            </div>
        </section>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>