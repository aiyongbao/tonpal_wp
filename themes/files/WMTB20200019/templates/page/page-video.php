<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video','vars');

// Array 数据处理
$video_item = ifEmptyArray($theme_vars['item']['value']);

// Text 数据处理
$video_title = ifEmptyText($theme_vars['title']['value'],'video');
$page_bg = ifEmptyText($theme_vars['image']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$video_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
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

    <?php if (!empty($page_bg)) { ?>
        <section class="sys_sub_head">
            <div class="head_bn_slider">
                <ul class="head_bn_items ">
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
                    <h1><?php echo $video_title ?></h1>
                </header>
                <article class="blog-article">
                    <ul class="video_list">
                        <?php if (!empty($video_item)) { ?>
                            <?php foreach ($video_item as $item) { ?>
                                <li class="video_item">
                                    <div class="iframe-wrapper">
                                        <figure class="item-wrap">
                                            <div class="item_iframe">
                                                <?php echo ifEmptyText($item['iframe']) ?>
                                            </div>
                                            <figcaption class="item-info">
                                                <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
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

<?php get_footer(); ?>
<script>

</script>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

