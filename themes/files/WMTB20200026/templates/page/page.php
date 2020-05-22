<?php
$post = get_post();
// page.json -> vars 数据获取
$theme_vars = json_config_array_category('page', 'vars', $post->ID);
// Text 数据处理
$page_title = ifEmptyText($theme_vars['title']['value']);
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

    <?php get_template_part('templates/components/head') ?>
</head>

<body>
<!-- header start -->
<?php get_header() ?>
<!--// header end  -->
<!-- path -->
<?php get_breadcrumbs();?>
<!-- main_content start -->
<div class="layout main_content">
    <!--  aside start -->
    <?php get_template_part('templates/components/side-bar'); ?>
    <!--// aside end -->
    <!-- main begin -->
    <section class="main">
        <div class="main-tit-bar">
            <h1 class="title"><?php echo $page_title; ?></h1>
            <div class="clear"></div>
        </div>
        <article class="entry blog-article">
            <section class="mt15">
                <?php echo $page_rich_text; ?>
            </section>
            <?php get_template_part( 'templates/components/sendMessage' )?>
        </article>
    </section>
    <div class="clear"></div>
    <!--// main end -->
</div>
<!--// main_content end -->
<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>
<!--  footer end -->
</body>
<?php get_footer() ?>
<!-- 微数据 -->
<?php get_template_part('templates/components/microdata') ?>

</html>