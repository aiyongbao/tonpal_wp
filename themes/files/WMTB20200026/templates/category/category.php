<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例
// category.json -> vars 数据获取
$theme_vars = json_config_array_category('category', 'vars', $cat);
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
$max = intval($wp_query->max_num_pages);

// 当前页面url
$category = get_category($cat);
$get_full_path = get_full_path();
$page_url = $get_full_path . get_category_link($category->term_id);
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

    <?php if ($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts(); ?>" />
    <?php } ?>
    <?php if ($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>
    <?php get_template_part('templates/components/head'); ?>
    <style>
        @media only screen and (max-width:768px) {
            .blog-item .item-img{float: none; width:100%; max-width:100%; margin-bottom: 10px;}
        }
    </style>
</head>

<body>
<!-- header start -->
<?php get_header() ?>
<!--// header end  -->

<?php get_breadcrumbs();?>
<!-- page-layout start -->
<section class="layout main_content">
    <!-- aside start -->
    <?php get_template_part('templates/components/side-bar'); ?>
    <!--// aside end -->
    <!-- main start -->
    <section class="main">
        <div class="main-tit-bar">
            <?php if ($subName == '') { ?>
                <h1 class="title" style="text-transform:uppercase"><?php echo $category_title; ?></h1>
            <?php } else { ?>
                <h3 class="title" style="text-transform:uppercase"><?php echo $category_title; ?></h3><h1 style="text-transform:uppercase"><?php echo $subName; ?></h1>
            <?php } ?>
        </div>
        <div class="blog_list">
            <?php if ( have_posts() ) { ?>
                <ul>
                    <?php while ( have_posts() ) : the_post();   ?>
                        <?php $thumbnail = ifEmptyText(get_post_meta(get_post()->ID,'thumbnail',true)); ?>
                        <li class="blog-item">
                            <figure class="item-wrap">
                                <?php if (!empty($thumbnail)) { ?>
                                    <a href="<?php the_permalink(); ?>" class="item-img" style="background:url(<?php echo $thumbnail ?>) no-repeat center/cover">
                                        <img src="//q.zvk9.com/Model20/assets/images/pos.png" style="opacity: 0" alt="<?php the_title(); ?>"/>
                                    </a>
                                <?php } ?>
                                <figcaption class="item-info">
                                    <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <time datetime="<?php echo esc_html( get_the_date() ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                                    <div class="item-detail limit-3-line"><?php the_excerpt(); ?></div>
                                    <a href="<?php the_permalink(); ?>" class="item-more" style="margin-top: 10px;"><?php echo $category_read_more; ?></a>
                                </figcaption>
                            </figure>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <?php wpbeginner_numeric_posts_nav(); ?>
            <?php } ?>
        </div>
        <?php get_template_part( 'templates/components/sendMessage' ); ?>

    </section>
    <!--// sendMessage -->
    <div class="clear"></div>
    <!--// main end -->
</section>
<!--// page-layout end -->
<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>

</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>