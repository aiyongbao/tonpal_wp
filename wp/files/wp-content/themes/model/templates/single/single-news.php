<?php
$post = get_post();
// newsDetail.json -> vars 数据获取
$theme_vars = json_config_array('news-detail','vars');
// Text 数据处理
$news_detail_title = ifEmptyText($theme_vars['title']['value'],'Detail');
$news_detail_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$news_detail_desc = ifEmptyText($theme_vars['desc']['value']);



// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true),"$news_detail_title");
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

global $wp;

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_description; ?>" />
    <meta name="description" content="<?php echo $seo_keywords; ?>" />
    <link rel="canonical" href="<?php echo home_url(add_query_arg(array(),$wp->request));?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .tags-title>div {
            float: left;
            padding: 10px 10px;
            display: block;
            color: #fff;
            border-radius: 10px 10px 0 0;
            background: #ffbc3b;
        }
        .tags-ul li{
            float: left;
            margin: 5px;
            padding: 5px;
            border: 1px solid #e5e5e5;
        }
        .tags-ul li a{
            color: #666;
        }
        .tags-ul li:hover a {
            color: #ffbc3b;
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
<?php get_header()?>
<!-- /header -->


<!-- page title -->
<section class="page-title-section overlay page-bg" data-background="<?php echo $news_detail_bg; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php get_breadcrumbs();?>
                <p class="text-lighten"><?php echo $news_detail_desc; ?></p>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->

<!-- blog details -->
<section class="section-sm bg-gray">
    <div class="container">
        <div class="row">

            <!-- blog contect -->
            <div class="col-12 mb-5">
                <h1><?php echo $post->post_title ?></h1>
                <div class="content">
                    <?php echo $post->post_content ?>
                </div>
            </div>
            <div class="col-12 mb-4 tags-title">
                <div>Tags</div>
            </div>
            <ul class="col-12 mb-4 tags-ul">
                <?php the_tags('<li>', '</li><li>', '</li>') ?>
            </ul>

            <!-- hot_product -->
            <?php get_template_part( 'templates/components/hot-products' )?>
            <!-- comment box -->
            <div class="col-12">
                <?php get_template_part( 'templates/components/sendMessage' )?>
            </div>
        </div>
    </div>
</section>
<!-- /blog details -->

<!-- footer -->
<?php get_template_part( 'templates/components/footer' )?>

</body>
<?php get_footer() ?>

</html>
