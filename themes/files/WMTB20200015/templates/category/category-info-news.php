<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header', 'vars', 1);
$more_btn = ifEmptyText($theme_vars['inquiryBtn']['value'], 'Read More');

$category = get_category($cat);

// SEO
$seo_title = ifEmptyText(get_term_meta($cat, 'seo_title', true));
$seo_description = ifEmptyText(get_term_meta($cat, 'seo_description', true));
$seo_keywords = ifEmptyText(get_term_meta($cat, 'seo_keywords', true));

$paged = get_query_var('paged');
$max = intval($wp_query->max_num_pages);

// 当前页面url
$get_full_path = get_full_path();
$page_url = $get_full_path . get_category_link($category->term_id);
?>


<!doctype html>
<html lang="en">

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
        .main {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->
        <!-- path -->
        <?php get_breadcrumbs(); ?>
        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <!-- main begin -->
                <section class="main">
                    <?php if (have_posts()) { ?>
                        <div class="tp-list mt-6 d-none d-sm-block">
                            <?php while (have_posts()) : the_post();   ?>
                                <a href="<?php the_permalink(); ?>" class="d-flex tp-list-item">
                                    <div style="margin:0;margin: 0;min-height: 1.05rem;" class="tp-content d-flex flex-coloum justify-content-between">
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center mb-1">
                                                <h3 class="tp-content-title ellipsis-1">
                                                    <?php the_title(); ?>
                                                </h3>
                                                <span class="date">
                                                    Posted <?php echo esc_html(get_the_date()); ?>
                                                </span>
                                            </div>
                                            <div class="tp-content-expert ellipsis-4">
                                                <?php echo get_the_excerpt(); ?>
                                            </div>
                                        </div>

                                        <div class="tp-content-btn">
                                            <div class="tp-btn-text">
                                                <?php echo $more_btn; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        </div>

                        <div class="tp-list d-block d-sm-none">
                            <?php if (have_posts()) { ?>
                                <div class="tp-list">
                                    <?php while (have_posts()) : the_post();   ?>
                                        <a href="<?php the_permalink(); ?>" class="d-flex tp-list-item">
                                            <div style="margin-left: 0" class="tp-content d-flex flex-coloum justify-content-between">

                                                <div class="mb-2">
                                                    <h3 class="tp-content-title ellipsis-2 mb-2">
                                                        <?php the_title(); ?>
                                                    </h3>

                                                    <div class="date mb-2">
                                                        <?php echo esc_html(get_the_date()); ?>
                                                    </div>
                                                    <div class="tp-content-expert mb-3 ellipsis-4">
                                                        <?php the_excerpt(); ?>
                                                    </div>
                                                </div>

                                                <div class="tp-content-btn">
                                                    <div class="tp-btn-text">
                                                        <?php echo $more_btn; ?>
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
                        </div>

                        <?php wpbeginner_numeric_posts_nav(); ?>
                    <?php } else { ?>
                        <div class="row">
                            <div class="no-product">No News</div>
                        </div>
                    <?php } ?>
                    <?php get_template_part('templates/components/tags-random-category') ?>
                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
        <!--  footer end -->
    </div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>