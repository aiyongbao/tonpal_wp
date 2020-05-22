<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();

$theme_vars = json_config_array_category('category', 'vars', ROOT_CATEGORY_CID);
$background = ifEmptyText($theme_vars['bg']['value']);
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

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
    <link rel="canonical" href="<?php echo $page_url;?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .tab-panel-content a{color:#333;margin-right: 15px}
        .tab-panel-content a:hover {
            color: #b7045f;
        }
    </style>
</head>

<body>
<!-- header start -->
<?php get_header() ?>
<!--// header end  -->

<?php get_breadcrumbs();?>
<!-- page-layout start -->
<section class="layout main_content">
    <!--  aside start -->
    <?php get_template_part('templates/components/side-bar'); ?>
    <!--// aside end -->
    <!-- main begin -->
    <section class="main">
        <div class="main-tit-bar">
            <h1 class="title" style="text-transform:none"><?php echo $post->post_title; ?></h1>
        </div>
        <article class="entry blog-article">
            <?php echo $post->post_content ?>
        </article>
        <?php get_template_part( 'templates/components/tags-random-category' )?>
        <?php get_template_part( 'templates/components/sendMessage' )?>
    </section>
    <!--// main end -->
    <div class="clear"></div>
</section>
<!--// page-layout end -->
<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>

</body>
<?php get_footer() ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
