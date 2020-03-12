<?php
$post = get_post();
// productDetail.json -> vars 数据获取
$theme_vars = json_config_array('product-detail','vars');
// Text 数据处理
$product_detail_title = ifEmptyText($theme_vars['title']['value'],'Detail');
$product_detail_bg = ifEmptyText($theme_vars['bg']['value'],'http://wp.io/wp-content/themes/model/assets/images/backgrounds/page-title.jpg');
$productDetail_desc = ifEmptyText($theme_vars['desc']['value']);

$photos = get_post_meta(get_post()->ID)['photos'];
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID)['seo_title'],"$product_detail_title");
$seo_description = ifEmptyText(get_post_meta(get_post()->ID)['seo_description']);
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID)['seo_keywords']);

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
</head>

<body>
<!-- preloader start -->
<div class="preloader">
    <img src="<?php echo get_template_directory_uri();?>/assets/images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

<!-- header -->
<?php get_header()?>
<!-- /header -->


<!-- page title -->
<section class="page-title-section overlay" data-background="<?php echo $product_detail_bg; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="/">Home</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted"><?php echo $post->post_title; ?></li>
                </ul>
                <p class="text-lighten"><?php echo $productDetail_desc; ?></p>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->

<!-- blog details -->
<section class="section-sm bg-gray">
    <div class="container">
        <div id="demo" class="row carousel slide" data-ride="carousel">
            <!-- 指示符 -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <!-- 轮播图片 -->
            <div class="carousel-inner" >
                <?php
                    foreach ($photos as $key => $item) {
                        if($key ==0 ) {
                    ?>
                        <div class="carousel-item active">
                            <img src="<?php echo ifEmptyText($item[$key])?>" class="img-fluid w-100">
                        </div>
                    <?php } else { ?>
                        <div class="carousel-item">
                            <img src="<?php echo ifEmptyText($item[$key])?>" class="img-fluid w-100">
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <!-- 左右切换按钮 -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        <!-- course info -->
        <div class="row align-items-center mb-5">
            <div class="col-xl-6 order-1 col-sm-6 mb-4 mb-xl-0">
                <h2><?php echo $post->post_title ?></h2>
            </div>

            <div class="col-xl-6 text-sm-right text-left order-sm-2 order-3 order-xl-3 col-sm-6 mb-4 mb-xl-0">
                <a href="#" class="btn btn-primary">Apply now</a>
            </div>
            <!-- border -->
            <div class="col-12 mt-4 order-4">
                <div class="border-bottom border-primary"></div>
            </div>
        </div>
        <!-- course details -->
        <div class="row">
            <div class="col-12 mb-4">
                <h3>Details</h3>
            </div>
            <div class="col-12 mb-4">
                <?php echo $post->post_content ?>
            </div>
            <?php the_tags('<li>', '</li><li>', '</li>') ?>
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

<script>

</script>
</html>
