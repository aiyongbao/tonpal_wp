<?php
// showcase.json -> vars 数据获取
$theme_vars = json_config_array('showcase','vars');

// Array 数据处理
$showcase_item = ifEmptyArray($theme_vars['item']['value']);
$item_count = count($showcase_item);
// Text 数据处理
$showcase_title = ifEmptyText($theme_vars['title']['value'],'showcase');
$showcase_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$showcase_desc = ifEmptyText($theme_vars['desc']['value'],'This is desc');
$showcase_null_tip = ifEmptyText($theme_vars['nullTip']['value'],'No Showcase');

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$showcase_title");
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
        .showcase-box figure img {
            width: 100%;
        }
        .showcase-box .desc p {
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

<!-- preloader start -->
<div class="preloader">
    <img src="<?php echo get_template_directory_uri()?>/assets/images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

<!-- header -->
<?php get_header() ?>
<!-- header -->


<main>
    <!-- page title -->
    <section class="page-title-section overlay page-bg" data-background="<?php echo $showcase_bg; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php get_breadcrumbs();?>
                    <p class="text-lighten"><strong><?php echo $showcase_desc; ?></strong></p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- blogs -->
    <section class="section">
        <div class="container">
            <?php if ( $item_count >= 1 ) { ?>
                <div class="row">
                    <?php foreach ($showcase_item as $item ) {  ?>
                        <article class="col-lg-4 col-sm-6 mb-5">
                            <div class="showcase-box">
                                <figure>
                                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['desc']; ?>">
                                </figure>
                                <div class="desc">
                                    <p><?php echo $item['desc']; ?></p>
                                </div>
                            </div>
                        </article>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="no-product"><?php echo $showcase_null_tip; ?></div>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- /blogs -->
</main>
<?php get_template_part( 'templates/components/footer' ); ?>

</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

