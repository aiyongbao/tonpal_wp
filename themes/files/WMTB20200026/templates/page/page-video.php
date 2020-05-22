<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video', 'vars');

// Array 数据处理
$video_item = ifEmptyArray($theme_vars['item']['value']);

// Text 数据处理
$video_title = ifEmptyText($theme_vars['title']['value'], 'video');
$video_desc = ifEmptyText($theme_vars['desc']['value']);

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
    <style type="text/css">
        .product-item.video-list {
            width: 50% !important;
            box-sizing: border-box;
        }
        .product-item .item-info .item-title {
            height: .38rem;
            overflow : hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical
        }
        .product-item.video-list .item-img img {
            visibility: hidden;
        }
        .video-list .item-img iframe{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
        }
        .items_list .product-item {
            float: none;
            display: inline-block;
        }
    </style>
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
            <h1 class="title"><?php echo $video_title; ?></h1>
        </div>
        <?php if($video_desc != ''){ ?>
            <p class="class-desc" style="margin-bottom:20px;line-height:1.5"><?php echo $video_desc ?></p>
        <?php } ?>
        <div class="items_list">
            <ul class="gm-sep">
                <?php foreach ($video_item as $item) { ?>
                    <li class="product-item video-list">
                        <figure class="item-wrap">
                            <div class="item-img">
                                <?php echo ifEmptyText($item['iframe']) ?>
                                <img src="//q.zvk9.com/Model20/assets/images/position.jpg" />
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
    <div class="clear"></div>
    <!--// main end -->
</div>
<!--// main_content end -->
<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>
<!--  footer end -->
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>