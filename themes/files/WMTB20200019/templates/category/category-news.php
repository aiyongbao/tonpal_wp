<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例

// news.json -> vars 数据获取
$theme_vars = json_config_array('news','vars');
// Text 数据处理
$news_title = ifEmptyText($theme_vars['title']['value'],'News');
$news_null_tip = ifEmptyText($theme_vars['nullTip']['value'],'No News');
$news_read_more = ifEmptyText($theme_vars['readMore']['value']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);

$page_bg = ifEmptyText(get_term_meta($cat,'background',true));
if (empty($page_bg)){
    $page_bg = ifEmptyText($theme_vars['image']['value']);
}
$sub_title = ifEmptyText(get_term_meta($cat,'sub_title',true)); // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置

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
    <!-- header start -->
    <?php get_header() ?>
    <!--// header end  -->
    <?php if (!empty($page_bg)) { ?>
        <section class="sys_sub_head">
            <div class="head_bn_slider">
                <ul class="head_bn_items">
                    <li class="head_bn_item swiper-slide"><img src="<?php echo $page_bg; ?>" alt=""></li>
                </ul>
            </div>
        </section>
    <?php } ?>
    <?php get_breadcrumbs();?>
    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">

            <!-- main start -->
            <section class="main">
                <div class="main_hd">
                    <div class="page_title">
                        <?php if ($sub_title == '') { ?>
                            <h1 class="h1-title" style="text-transform:uppercase">
                                <?php echo $news_title; ?>
                            </h1>
                        <?php } else { ?>
                            <div class="h1-title" style="text-transform:uppercase" >
                                <?php echo $news_title; ?>
                            </div>
                            <h1 class="sub-title">
                                <?php echo $sub_title; ?>
                            </h1>
                        <?php } ?>
                    </div>
                </div>
                <div class="news_list">
                    <?php if ( have_posts() ) { ?>
                        <ul>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true); ?>
                                <li class="news_item">
                                    <figure class="item_wrap">
                                        <a href="<?php the_permalink(); ?>" class="item-img"><img src="<?php echo $thumbnail; ?>_thumb_262x135.jpg" alt="<?php the_title(); ?>" /></a>
                                        <figcaption class="item-info">
                                            <h3><a href="<?php the_permalink(); ?>" class="item-title" ><?php the_title(); ?></a><a href="<?php the_permalink(); ?>" class="item-more"></a></h3>
                                            <time class="item-date"><?php echo esc_html( get_the_date() ); ?></time>
                                            <div class="item-detail"><?php the_excerpt(); ?></div>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    <?php } else { ?>
                        <div class="row">
                            <div class="no-product"><?php echo $news_null_tip; ?></div>
                        </div>
                    <?php } ?>
                </div>
                <!--// sendMessage -->
            </section>
            <!--// main end -->
        </div>
    </section>
    <div class="page_footer">
        <div class="layout">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
            <?php get_template_part( 'templates/components/tags-random-product' )?>
        </div>
    </div>
    <!--// page-layout end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
