<?php
// tags.json -> vars 数据获取
$theme_vars = json_config_array('tags','vars');
// Text 数据处理
$tags_title = ifEmptyText($theme_vars['title']['value'],'tags');
$tags_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$tags_desc = ifEmptyText($theme_vars['desc']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$tags_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
global $wp_query,$wp;
$paged = get_query_var('paged');
$max = intval( $wp_query->max_num_pages );

// 当前页面url
$page_url = get_lang_page_url();
if ( have_posts() ) {
    $product_item = [];
    $news_item = [];
    while ( have_posts() ) {
        the_post();
        $category = get_the_category();
        $cid = $category[0]->cat_ID;
        $pid = get_category_root_id($cid);
        $the_slug = get_category($pid)->slug;
        if ( $the_slug == 'product' ) {
            array_push($product_item,$post);
        } else {
            array_push($news_item,$post);
        }
    }

}
//print_r($product_item);
//print_r($news_item);


?>
<!--nextpage-->

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?><?php if ( $paged > 1 ) printf('–%s',$paged); ?></title>
    <meta name="keywords" content="<?php echo $seo_description; ?>" />
    <meta name="description" content="<?php echo $seo_keywords; ?>" />

    <link rel="canonical" href="<?php echo $page_url;?>" />
    <?php if($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts();?>" />
    <?php } ?>
    <?php if($paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>

    <?php get_template_part('templates/components/head'); ?>
    <style>
        .card-title {
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .card-body > p {
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
    <section class="page-title-section overlay page-bg" data-background="<?php echo $tags_bg; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="/">Home</a></li>
                        <li class="list-inline-item text-white h3 font-secondary nasted"><?php echo $tags_title; ?></li>
                    </ul>
                    <p class="text-lighten"><strong><?php echo $tags_desc; ?></strong></p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- blogs -->
    <section class="section">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="row">

                    <?php while ( have_posts() ) : the_post();   ?>
                    <?php print_r(666); ?>
<!--                        --><?php //$thumbnail=get_post_meta(get_post()->ID)['thumbnail'][0]; ?>
<!--                        <article class="col-lg-4 col-sm-6 mb-5">-->
<!--                            <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">-->
<!--                                --><?php //if ( ifEmptyText($thumbnail) !== '' ) { ?>
<!--                                    <img class="card-img-top rounded-0" src="--><?php //echo $thumbnail ?><!--_thumb_262x262.jpg" alt="--><?php //the_title(); ?><!--">-->
<!--                                --><?php //} else {?>
<!--                                    <img class="card-img-top rounded-0" src="https://iph.href.lu/350x350?text=350x350" alt="Post thumb">-->
<!--                                --><?php //} ?>
<!--                                <div class="card-body">-->
<!--                                    <ul class="list-inline mb-3">-->
<!--                                        <li class="list-inline-item mr-3 ml-0">--><?php //echo esc_html( get_the_date() ); ?><!--</li>-->
<!--                                    </ul>-->
<!--                                    <a href="--><?php //the_permalink(); ?><!--" target="_blank">-->
<!--                                        <h4 class="card-title">--><?php //the_title(); ?><!--</h4>-->
<!--                                    </a>-->
<!--                                    --><?php //the_excerpt(); ?>
<!--                                    <a href="--><?php //the_permalink(); ?><!--" target="_blank" class="btn btn-primary btn-sm">read more</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </article>-->
                    <?php endwhile; ?>
                </div>
                <?php wpbeginner_numeric_posts_nav(); ?>
            <?php endif; ?>

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

