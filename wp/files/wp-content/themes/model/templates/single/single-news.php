<?php
$post = get_post();
// newsDetail.json -> vars 数据获取
$theme_vars = json_config_array('news-detail','vars');
// Text 数据处理
$news_detail_title = ifEmptyText($theme_vars['title']['value'],'Detail');
$news_detail_bg = ifEmptyText($theme_vars['bg']['value'],'http://wp.io/wp-content/themes/model/assets/images/backgrounds/page-title.jpg');
$news_detail_desc = ifEmptyText($theme_vars['desc']['value']);



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
    <img src="<?php echo get_template_directory_uri()?>/assets/images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

<!-- header -->
<?php get_header()?>
<!-- /header -->


<!-- page title -->
<section class="page-title-section overlay" data-background="<?php echo $news_detail_bg; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="/">Home</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted"><?php echo $post->post_title; ?></li>
                </ul>
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
                <h2><?php echo $post->post_title ?></h2>
                <div class="content">
                    <?php echo $post->post_content ?>
                </div>
            </div>
            <!-- comment box -->
            <div class="col-12">
                <form action="#" class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control mb-4" id="name" name="name" placeholder="Full Name">
                    </div>
                    <div class="col-sm-6">
                        <input type="email" class="form-control mb-4" id="mail" name="mail" placeholder="Email Address">
                    </div>
                    <div class="col-12">
                        <textarea name="comment" id="comment" class="form-control mb-4" placeholder="Comment Here..."></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" value="send" class="btn btn-primary">post comment</button>
                    </div>
                </form>
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
