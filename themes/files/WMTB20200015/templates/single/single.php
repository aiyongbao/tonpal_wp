<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();


// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

// 当前页面url
$page_url = get_lang_page_url();

$background = ifEmptyText(get_term_meta(ROOT_CATEGORY_CID,'background',true),'http://demo.tonpal.com/WMTB20200015/assets/images/main_banner.jpg');

?>
<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url;?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php get_template_part( 'templates/components/head' )?>

</head>

<body>
<div class="container">

    <!-- web_head start -->
    <?php get_header() ?>
    <!--// web_head end -->
    <?php if(!empty($background)) { ?>
        <div class="page_bg" style='background: url("<?php echo $background; ?>") fixed no-repeat center center'>
        </div>
    <?php } ?>
    <!-- path -->
    <?php get_breadcrumbs();?>

    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout news">

            <!-- main start -->
            <section class="main main-box" >
                <div class="news-title border-bottom-1 mb-20">
                    <h1><?php echo $post->post_title ?></h1>
                </div>
                <article>
                    <section class="mt15">
                        <?php echo $post->post_content ?>
                    </section>
                </article>
                <div class="chapter underline border-bottom-2">
                    <?php
                    // prev
                    get_prev_or_next_post('prev','prev','Prev: ','This is the last product.');
                    // next
                    get_prev_or_next_post('next','next','Next: ','This is the latest product.');
                    ?>
                </div>
                <?php get_template_part( 'templates/components/tags-random-product' )?>

            </section>
            <?php get_template_part( 'templates/components/sendMessage' )?>
            <?php get_template_part( 'templates/components/tags-random-category' )?>
            <!--// main end -->
        </div>
    </section>
    <!--// page-layout end -->

    <!-- web_footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--// web_footer end -->

</div>

</body>
<?php get_footer() ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
