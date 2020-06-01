<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video','vars');

// Array 数据处理
$video_item = ifEmptyArray($theme_vars['item']['value']);

// Text 数据处理
$video_title = ifEmptyText($theme_vars['title']['value'],'video');
$video_desc = ifEmptyText($theme_vars['desc']['value']);

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

    <!-- path -->
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <section class="web_main page_main">
        <div class="layout">
            <!--//  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->

            <!--// main start -->
            <section class="main" >
                <header class="border-bottom-2 mb-10">
                    <h1><?php echo $video_title ?></h1>
                </header>
                <?php if($video_desc != ''){ ?>
                    <p class="class-desc pd-10 ellipsis-8" style="margin-bottom:30px;padding-bottom: 0;line-height:1.5"><?php echo $video_desc ?></p>
                <?php } ?>
                <ul class="video-ul">
                    <?php foreach ($video_item as $item) { ?>
                        <li class="video-li">
                            <figure class="item-wrap">
                                <div class="item-iframe">
                                    <?php echo ifEmptyText($item['iframe']) ?>
                                </div>
                                <figcaption class="item-info">
                                    <h3 class="item-title ellipsis-2"><?php echo ifEmptyText($item['title']) ?></h3>
                                </figcaption>
                            </figure>
                        </li>
                    <?php } ?>
                </ul>
                <?php get_template_part( 'templates/components/sendMessage' )?>
            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// main_content end -->

    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>

</body>

<?php get_footer(); ?>
<script>

</script>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

