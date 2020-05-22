<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();
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
    <style type="text/css">
        .tab-panel-content a{color:#333;}
        .tab-panel-content a:hover {
            color: #b7045f;
        }
        .main .tab-panel-content.post-tags{padding-top:0; padding-bottom: 10px;}
        .main .tab-panel-content.post-tags a{margin-right: 15px;}
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
            <time style="float: right; line-height: 32px; color:#666"><?php echo $post->post_date; ?></time>
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
