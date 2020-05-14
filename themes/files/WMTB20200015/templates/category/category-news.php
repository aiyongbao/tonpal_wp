<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例


// news.json -> vars 数据获取
$theme_vars = json_config_array('news', 'vars');
// Text 数据处理
$news_title = ifEmptyText($theme_vars['title']['value'], 'News');
$news_null_tip = ifEmptyText($theme_vars['nullTip']['value'], 'No News');
$news_read_more = ifEmptyText($theme_vars['readMore']['value']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
$news_bg = ifEmptyText(get_term_meta($cat,'background',true));

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

</head>

<body>
    <div class="container">

        <!-- web_head start -->
        <?php get_header() ?>
        <!--// web_head end -->
        <?php if(!empty($news_bg)) { ?>
        <div class="page_bg" style='background: url("<?php echo $news_bg; ?>") fixed no-repeat center center'>
        </div>
    <?php } ?>
        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <!-- page-layout start -->
        <section class="web_main page_main">
            <div class="layout">

                <!-- main start -->
                <section>
                    <div class="blog_list mt-6">
                        <?php if (have_posts()) { ?>
                            <div style="margin-top: 0.3rem" class="tp-list">
                                <?php while (have_posts()) : the_post();   ?>
                                    <a href="<?php the_permalink(); ?>" class="d-flex tp-list-item">
                                        <div class="tp-media">
                                            <img src="<?php echo get_post_meta(get_post()->ID, 'thumbnail', true); ?>" alt="<?php echo the_title(); ?>">
                                        </div>
                                        <div class="tp-content d-flex flex-coloum justify-content-between">
                                            <div class="">
                                                <div class="d-flex align-items-center mb-1">
                                                    <h3 class="tp-content-title ellipsis-1">
                                                        <?php the_title(); ?>
                                                    </h3>
                                                    <span class="date">
                                                        Posted <?php echo esc_html( get_the_date() ); ?>
                                                    </span>
                                                </div>
                                                <div class="tp-content-expert ellipsis-4">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>

                                            <div class="tp-content-btn">
                                                <div class="tp-btn">
                                                <?php echo $news_read_more; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                            <?php wpbeginner_numeric_posts_nav(); ?>
                        <?php } else { ?>
                            <div class="row">
                                <div class="no-product"><?php echo $news_null_tip; ?></div>
                            </div>
                        <?php } ?>
                        <!--// sendMessage -->
                        <?php get_template_part('templates/components/sendMessage'); ?>
                        <!--// tags -->
                        <div class="foot-tags mb-35">
                            <?php get_template_part('templates/components/tags-random-product') ?>
                        </div>
                    </div>
                </section>
                <!--// main end -->
            </div>
        </section>
        <!--// page-layout end -->


        <!-- web_footer start -->
        <?php get_template_part('templates/components/footer'); ?>
        <!--// web_footer end -->

    </div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>