<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video','vars');

// Array 数据处理
$video_item = ifEmptyArray($theme_vars['item']['value']);

// Text 数据处理
$video_title = ifEmptyText($theme_vars['title']['value'],'video');
$video_desc = ifEmptyText($theme_vars['desc']['value'],'This is desc');

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$video_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_description; ?>" />
    <meta name="description" content="<?php echo $seo_keywords; ?>" />
    <?php get_template_part('templates/components/head'); ?>
    <style>
        .video-box figure iframe {
            width: 100%;
            height: 100%;
        }
        .video-box .desc p {
            height: 56px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }
    </style>
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
                <header style="margin-bottom: 0.1rem;" class="main-tit-bar">
                    <h1 class="title"><?php echo $video_title ?></h1>
                </header>
                <?php if($video_desc != ''){ ?>
                    <p class="class-desc" style="margin-bottom:20px;margin-top: -20px;line-height:1.5"><?php echo $video_desc ?></p>
                <?php } ?>
                <div class="items_list">
                    <ul class="gm-sep">
                        <?php foreach ($video_item as $item) { ?>
                        <li class="product-item video-list">
                            <figure class="item-wrap">
                                <div class="item-img" style="width:440px;height:254px">
                                    <?php echo ifEmptyText($item['iframe']) ?>
                                </div>
                                <figcaption class="item-info">
                                    <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                </figcaption>
                            </figure>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
            <!--// main end -->
        </div>
    </div>
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

