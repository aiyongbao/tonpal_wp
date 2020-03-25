<?php
// news.json -> vars 数据获取
$theme_vars = json_config_array('news','vars');
// Text 数据处理
$news_title = ifEmptyText($theme_vars['title']['value'],'This is Title');
$news_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$news_desc = ifEmptyText($theme_vars['desc']['value'],'This is desc');
$news_null_tip = ifEmptyText($theme_vars['nullTip']['value'],'No News');
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$news_title");
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
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_description; ?>" />
    <meta name="description" content="<?php echo $seo_keywords; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />

    <?php if($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts();?>" />
    <?php } ?>
    <?php if($paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>
    <?php get_template_part('templates/components/head'); ?>

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
    <section class="page-title-section overlay page-bg" data-background="<?php echo $news_bg; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php get_breadcrumbs();?>
                    <p class="text-lighten"><strong><?php echo $news_desc; ?></strong></p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- title -->
    <div class="page-title container mt-2 mb-1">
        <?php if ($subName == '') { ?>
            <h1><?php echo $the_products_name; ?></h1>
        <?php } else { ?>
            <h3><?php echo $the_products_name; ?></h3><h1><?php $subName; ?></h1>
        <?php } ?>
    </div>
    <!-- /title -->

    <!-- notice -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <!-- notice item -->
                        <?php if ( have_posts() ) { ?>
                            <div class="row">
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <li class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                                        <div class="d-md-table-cell text-center p-4 bg-primary text-white mb-4 mb-md-0"><span class="h2 d-block"><?php echo esc_html( get_the_date('j') ); ?></span><?php echo esc_html( get_the_date('n,Y') ); ?></div>
                                        <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0 new-">
                                            <a href="<?php the_permalink(); ?>" class="h4 mb-3 d-block"><?php the_title(); ?></a>
                                            <p><?php the_excerpt(); ?></p>
                                        </div>
                                        <div class="d-md-table-cell text-right pr-0 pr-md-4"><a href="<?php the_permalink(); ?>" class="btn btn-primary">read more</a></div>
                                    </li>
                                <?php endwhile; ?>
                            </div>
                            <?php wpbeginner_numeric_posts_nav(); ?>
                        <?php } else { ?>
                        <div class="row">
                            <div class="no-product"><?php echo $news_null_tip; ?></div>
                        </div>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- /notice -->
</main>
<?php get_template_part( 'templates/components/footer' ); ?>

</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
