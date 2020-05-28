<?php
$post = get_post();

$theme_vars = json_config_array('privacy', 'vars');

// Text 数据处理
$page_title = ifEmptyText($theme_vars['title']['value']);
$page_bg = ifEmptyText($theme_vars['image']['value']);
$page_rich_text = ifEmptyText($theme_vars['richText']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>

<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <?php get_template_part( 'templates/components/head' )?>
</head>

<body>
<div class="container">

    <!-- web_head start -->
    <?php get_header() ?>
    <!--// web_head end -->

    <?php if (!empty($page_bg)) { ?>
        <section class="sys_sub_head">
            <div class="head_bn_slider">
                <ul class="head_bn_items">
                    <li class="head_bn_item swiper-slide"><img src="<?php echo $page_bg; ?>" alt=""></li>
                </ul>
            </div>
        </section>
    <?php } ?>
    <!-- path -->
    <?php get_breadcrumbs();?>

    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">
            <!-- main start -->
            <section class="main public_page" >
                <header class="title">
                    <h1><?php echo $page_title ?></h1>
                </header>
                <article class="blog-article">
                    <?php echo $page_rich_text; ?>
                </article>
            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// page-layout end -->
    <div class="page_footer">
        <div class="layout">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
            <?php get_template_part( 'templates/components/tags-random-product' )?>
        </div>
    </div>
    <!-- web_footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--// web_footer end -->
</div>
</body>
<?php get_footer() ?>
<!-- 微数据 -->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
