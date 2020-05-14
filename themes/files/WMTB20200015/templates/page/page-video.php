<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video', 'vars');

// Array 数据处理
$video_item = ifEmptyArray($theme_vars['item']['value']);

// Text 数据处理
$video_title = ifEmptyText($theme_vars['title']['value'], 'video');
$products_bg = ifEmptyText($theme_vars['bg']['value']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'], "$video_title");
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
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->
        <?php if (!empty($products_bg)) { ?>
            <div class="page_bg" style='background: url("<?php echo $products_bg; ?>") fixed no-repeat center center'>
            </div>
        <?php } ?>
        <!-- path -->
        <?php get_breadcrumbs(); ?>
        <!-- main_content start -->
        <div class="main_content">
            <div class="layout video">
                <!-- main begin -->
                <section class="main video">
                    <div class="items_list">
                        <ul class="gm-sep">
                            <?php if (!empty($video_item)) { ?>
                                <?php foreach ($video_item as $item) { ?>
                                    <li class="product-item video-list">
                                        <div class="iframe-wrapper">
                                            <figure class="item-wrap">
                                                <div class="item-img">
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
                    </div>
                    <?php get_template_part('templates/components/sendMessage') ?>
                    <?php get_template_part('templates/components/tags-random-product'); ?>
                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>