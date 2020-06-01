<?php
// showcase.json -> vars 数据获取
$theme_vars = json_config_array('showcase','vars');

// Array 数据处理
$showcase_items = ifEmptyArray($theme_vars['items']['value']);
// Text 数据处理
$showcase_title = ifEmptyText($theme_vars['title']['value'],'showcase');
$showcase_desc = ifEmptyText($theme_vars['desc']['value'],'This is desc');

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$showcase_title");
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
            <section class="main showcase" >
                <header class="border-bottom-2 mb-10">
                    <h1 class="ellipsis-1"><?php echo $showcase_title ?></h1>
                </header>
                <?php if($showcase_desc != ''){ ?>
                    <p class="class-desc pd-10" style="margin-top: 10px;line-height:1.5"><?php echo $showcase_desc ?></p>
                <?php } ?>
                <ul class="showcase-ul" id="masonry-elements">
                    <?php foreach ( $showcase_items as $item ) { ?>
                        <li class="item showcase-li">
                            <figure class="showcase-li-box">
                                <div class="item-image">
                                    <a href="<?php echo ifEmptyText($item['image']) ?>" target="_blank" rel='<?php echo ifEmptyText($item['title']) ?>' title="<?php echo ifEmptyText($item['title']) ?>">
                                        <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title'])?>" />
                                    </a>
                                </div>
                                <h3 class="item-title ellipsis-2"><?php echo ifEmptyText($item['title']) ?></h3>
                                <i></i>
                                <p class="ellipsis-6"><?php echo ifEmptyText($item['desc']) ?></p>
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
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script>
    $('#masonry-elements').imagesLoaded(function () {
        $('#masonry-elements').masonry({
            itemSelector: '.item'
        });
    });
</script>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

