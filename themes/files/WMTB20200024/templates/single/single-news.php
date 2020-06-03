<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();

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

    <?php get_template_part('templates/components/head') ?>
    <style>
         .single-products .side-tags .side-tags-list a {
            display: inline-block;
            /* padding: 15px 1px;
            margin: 15px 15px 0 0; */
            border: none;
        }
        </style>

</head>

<body>
    <section class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->
        <!-- path -->
        <nav class="path-bar">
            <?php get_breadcrumbs(); ?>
        </nav>
        <!-- main_content start -->
        <section class="page-layout">
            <div class="layout">
                <!--  aside start -->

                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->
                <!-- main begin -->
                <section class="main">
                    <div class="product-intro">
                        <h1 class="product-title"><?php echo $post->post_title ?></h1>
                        <time ><?php echo $post->post_date ?></time>
                    </div>
                    <div class="tab-content-wrap product-detail">
                        <div class="tab-panel-wrap">
                            <div class="tab-panel">
                                <div class="tab-panel-content entry">
                                    <p><span style="font-size: 12pt;">
                                            <?php echo $post->post_content ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-products">
                        <?php get_template_part('templates/components/tags-random-category') ?>
                    </div>
                    <?php get_template_part('templates/components/sendMessage') ?>
                </section>
                <!--// main end -->
            </div>
        </section>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer') ?>
    </section>
</body>
<?php get_footer() ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>