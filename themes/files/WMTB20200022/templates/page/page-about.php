<?php
// about.json -> vars 数据获取
$theme_vars = json_config_array('about','vars');
// Array 数据处理
$about_image = ifEmptyArray($theme_vars['image']['value']);

//Text 数据处理
$about_title = ifEmptyText($theme_vars['title']['value'],'About');
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
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <div class="main_content">
        <div class="layout">
            <!--  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->
            <!-- main begin -->
            <section class="main">
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $about_title; ?></h1>
                </header>
                <article class="entry blog-article">
                    <div class="main-banner">
                        <ul class="slides">
                            <?php foreach ($about_image as $item) { ?>
                                <li class="item">
                                    <img style="width:912px;height:511px"
                                         src="<?php echo $item['image']; ?>"
                                         alt="<?php echo $item['alt']; ?>">
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <section class="mt15">
                        <p><?php echo $about_rich_text; ?></p>
                    </section>
                    <?php get_template_part( 'templates/components/sendMessage' )?>
                </article>
            </section>
            <!--// main end -->
        </div>
    </div>
    <!--// main_content end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--  footer end -->
</div>
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

