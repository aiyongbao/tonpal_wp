<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例
// category.json -> vars 数据获取
$theme_vars = json_config_array_category('category-image','vars',$cat);
// Text 数据处理
$category_title = ifEmptyText($theme_vars['title']['value']);
$category_read_more = ifEmptyText($theme_vars['readMore']['value']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);

$subName = ""; // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置

/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
$paged = get_query_var('paged');
$max = intval( $wp_query->max_num_pages );

// 当前页面url
$category = get_category($cat);
$get_full_path = get_full_path();
$page_url = $get_full_path.get_category_link($category->term_id);
?>

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />

    <?php if($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts();?>" />
    <?php } ?>
    <?php if($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>
    <?php get_template_part('templates/components/head'); ?>

</head>

<body>
<div class="container">

    <!-- web_head start -->
    <?php get_header() ?>
    <!--// web_head end -->

    <!-- path -->
    <?php get_breadcrumbs();?>

    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">

            <!-- aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->

            <!-- main start -->
            <section class="main" >
                <div class="blog_list">
                    <div class="main_hd">
                        <div class="page_title">
                            <?php if ($subName == '') { ?>
                                <h1 style="text-transform:uppercase"><?php echo $category_title; ?></h1>
                            <?php } else { ?>
                                <h3 style="text-transform:uppercase"><?php echo $category_title; ?></h3><h1 style="text-transform:uppercase"><?php echo $subName; ?></h1>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ( have_posts() ) { ?>
                        <ul>
                            <?php while ( have_posts() ) : the_post();   ?>
                                <?php $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true); ?>
                                <li class="post-item border-bottom-2">
                                    <figure class="item-wrap">
                                        <a href="<?php the_permalink()  ?>" class="item-image"><img src="<?php echo $thumbnail ?>_thumb_220x220.jpg" alt="<?php the_title(); ?>" /></a>
                                        <figcaption class="item-info">
                                            <h3 class="item-title"><a href="<?php the_permalink()  ?>" class="title-link ellipsis-1"><?php the_title(); ?></a><a class="button" href="<?php the_permalink()  ?>"><?php echo $category_read_more; ?></a></h3>

                                            <div class="item-detail ellipsis-3"><?php the_excerpt(); ?></div>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    <?php } ?>
                    <!--// sendMessage -->
                </div>
                <?php get_template_part( 'templates/components/sendMessage' ); ?>
            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// page-layout end -->


    <!-- web_footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--// web_footer end -->

</div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
