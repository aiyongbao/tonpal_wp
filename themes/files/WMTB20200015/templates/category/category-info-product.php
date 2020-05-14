<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header', 'vars', 1);
$more_btn = ifEmptyText($theme_vars['inquiryBtn']['value'], 'Read More');

// SEO
$seo_title = ifEmptyText(get_term_meta($cat,'seo_title',true));
$seo_description = ifEmptyText(get_term_meta($cat,'seo_description',true));
$seo_keywords = ifEmptyText(get_term_meta($cat,'seo_keywords',true));

$paged = get_query_var('paged'); // 当前页数
$max = intval( $wp_query->max_num_pages ); // 该分类总页数

// 当前页面url
$category = get_category($cat);
$get_full_path = get_full_path();
$page_url = $get_full_path.get_category_link($category->term_id);

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

    <?php if($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts();?>" />
    <?php } ?>
    <?php if($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>
    <?php get_template_part('templates/components/head'); ?>

    <style>
        .main{
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
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <div class="main_content">
        <div class="layout">
            <!-- main begin -->
            <section class="main">
                
                <div class="blog_list mt-3">
                    <?php if ( have_posts() ) { ?>
                        <div class="tp-list">
                                <?php while (have_posts()) : the_post();   ?>
                                    <a href="<?php the_permalink(); ?>" class="d-flex tp-list-item">
                                        <div class="tp-media">

                                            <?php
                                                $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true);
                                                $thumbnail = empty($thumbnail) ? get_template_directory_uri() ."/assets/images/400x400.svg" : $thumbnail;
                                            ?>

                                            <img src="<?php echo $thumbnail ?>" alt="<?php echo  the_title(); ?>">
                                        </div>
                                        <div class="tp-content d-flex flex-coloum justify-content-between">
                                            <div class="">
                                                <div class="d-flex align-items-center mb-1">
                                                    <h3 class="tp-content-title ellipsis-1">
                                                        <?php the_title(); ?>
                                                    </h3>
                                                    <span class="date">
                                                        <?php echo esc_html( get_the_date() ); ?>
                                                    </span>
                                                </div>
                                                <div class="tp-content-expert ellipsis-4">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>

                                            <div class="tp-content-btn">
                                                <div class="tp-btn">
                                                <?php echo $more_btn; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    <?php } ?>
                </div>
                <?php get_info_tags('',$category->term_id); ?>


            </section>
        </div>
    </div>
    <!--// main_content end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--  footer end -->
</div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
