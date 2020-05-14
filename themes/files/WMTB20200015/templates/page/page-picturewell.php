<?php
// picturewell.json -> vars 数据获取
$theme_vars = json_config_array('picturewell', 'vars');

// Array 数据处理
$picturewell_items = ifEmptyArray($theme_vars['items']['value']);
// Text 数据处理
$picturewell_title = ifEmptyText($theme_vars['title']['value'], 'picturewell');
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
        <!-- main_content start -->
        <section class="web_main page_main">
            <div class="layout certificate">
                <!--// main start -->
                <section class="main certificate">
                    <ul class="certificate-ul">
                        <?php foreach ($picturewell_items as $item) { ?>
                            <li class="certificate-li">
                                <div class="certificate-card">
                                    <figure class="item-image">
                                        <a href="<?php echo ifEmptyText($item['image']) ?>" target="_blank" rel="<?php echo ifEmptyText($item['title']) ?>" title="<?php echo ifEmptyText($item['title']) ?>" class="item-img certificate-fancy">
                                            <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title']) ?>" />
                                        </a>
                                    </figure>
                                    <div class="item-info">
                                        <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php get_template_part('templates/components/sendMessage') ?>
                    <?php get_template_part('templates/components/tags-random-product'); ?>
                </section>
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