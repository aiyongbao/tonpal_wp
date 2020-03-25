<?php
$post = get_post();
// productDetail.json -> vars 数据获取
$theme_vars = json_config_array('product-detail','vars');
// Text 数据处理
$product_detail_title = ifEmptyText($theme_vars['title']['value'],'Detail');
$product_detail_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$productDetail_desc = ifEmptyText($theme_vars['desc']['value']);

$photos = get_post_meta(get_post()->ID,'photos');
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true),"$product_detail_title");
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

// 当前页面url
$page_url = get_lang_page_url();

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

    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- OG -->
    <meta property="og:title" content="<?php echo $post->post_title; ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php echo $page_url; ?>" />
    <meta property="og:description" content="<?php the_excerpt(); ?>" />
    <meta property="og:image" content="<?php echo $photos[0]; ?>" />
    <meta property="og:site_name" content="<?php get_host_name(); ?>" />
    <!-- itemprop -->
    <meta itemprop="name" content="<?php echo $post->post_title; ?>" />
    <meta itemprop="description" content="<?php the_excerpt(); ?>" />
    <meta property="image" content="<?php echo $photos[0]; ?>" />
    <!-- Twitter -->
    <meta name="twitter:site" content="@affiliate_<?php get_host_name();; ?>" />
    <meta name="twitter:creator" content="@affiliate_<?php get_host_name(); ?>" />
    <meta name="twitter:title" content="<?php echo $post->post_title; ?>" />
    <meta name="twitter:description" content="<?php echo $post->post_title; ?>" />
    <meta name="twitter:image" content="<?php echo $photos[0]; ?>" />


    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .nav-tab-box li a{
            padding: 10px 10px;
            display: block;
            color: #fff;
            border-radius: 10px 10px 0 0;
            background: #e5e5e5;
        }
        .nav-tab-box li a.active {
            background: #ffbc3b;
        }
        .tags-title{
            border-bottom: 1px solid #dee2e6;
            padding: 0;
        }
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
        .products-item .card-title {
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .products-item .card-body > p {
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
    <img src="<?php echo get_template_directory_uri();?>/assets/images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

<!-- header -->
<?php get_header()?>
<!-- /header -->


<!-- page title -->
<section class="page-title-section overlay page-bg" data-background="<?php echo $product_detail_bg; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php get_breadcrumbs();?>
                <p class="text-lighten"><?php echo $productDetail_desc; ?></p>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->

<!-- blog details -->
<section class="section-sm bg-gray">
    <div class="container">
        <?php if ($photos != []) { ?>
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
                                <img src="<?php echo ifEmptyText($item)?>" class="img-fluid w-100">
                            </div>
                        <?php } else { ?>
                            <div class="carousel-item">
                                <img src="<?php echo ifEmptyText($item)?>" class="img-fluid w-100">
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
        <?php } else { ?>
            <div class="">
                <img src="https://iph.href.lu/1110x555?text=暂无产品图" class="img-fluid w-100">
            </div>
        <?php }?>
        <!-- course info -->
        <div class="row align-items-center mb-5">
            <div class="col-xl-6 order-1 col-sm-6 mb-4 mb-xl-0">
                <h1><?php echo $post->post_title ?></h1>
            </div>

            <div class="col-xl-6 text-sm-right text-left order-sm-2 order-3 order-xl-3 col-sm-6 mb-4 mb-xl-0">
                <a href="/contactus" class="btn btn-primary">Apply now</a>
            </div>
            <!-- border -->
            <div class="col-12 mt-2 order-4">
                <div class="border-bottom border-primary"></div>
            </div>
        </div>
        <!-- course details -->
        <div class="row">
            <?php
            $newArray=[];
            $contentArray = json_decode($post->post_content,true);
            foreach ($contentArray as $key => $item ){
                if ($item['content'] !== ''){
                    $newArray[$key]['tabName'] = $item['tabName'];
                    $newArray[$key]['content'] = $item['content'];
                }
            }
            ?>
            <!-- tab -->
            <ul class="nav nav-tabs col-12 mb-4 nav-tab-box" role="tablist">
                <?php foreach ($newArray as $key => $item ){ ?>
                    <?php if($key == 0){ ?>
                        <li role="presentation" ><a href="#<?php echo $item['tabName']; ?>" class="active" role="tab" data-toggle="tab"><?php echo $item['tabName']; ?></a></li>
                    <?php } else { ?>
                        <li role="presentation"><a href="#<?php echo $item['tabName']; ?>"  role="tab" data-toggle="tab"><?php echo $item['tabName']; ?></a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <!-- content -->
            <div class="tab-content col-12 mb-4">
                <?php foreach ($newArray as $key => $item ){ ?>
                    <?php if($key == 0){ ?>
                        <div role="tabpanel" class="tab-pane active" id="<?php echo $item['tabName']; ?>">
                            <?php echo $item['content']; ?>
                        </div>
                    <?php } else { ?>
                        <div role="tabpanel" class="tab-pane" id="<?php echo $item['tabName']; ?>"><?php echo $item['content']; ?></div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-12 mb-4 tags-title">
                <div>Tags</div>
            </div>
            <ul class="col-12 mb-4 tags-ul">
                <?php the_tags('<li>', '</li><li>', '</li>') ?>
            </ul>
            <?php get_template_part( 'templates/components/related-products' )?>

            <!-- hot_product -->
            <?php get_template_part( 'templates/components/hot-products' )?>

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
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
