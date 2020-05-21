<?php

/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
global $wp_query, $wp, $post;
$paged = get_query_var('paged');
$max = intval($wp_query->max_num_pages);
$tagName = single_tag_title('', false);
$tagName = str_replace("wmtbprefix", "", $tagName);
// 当前页面url
$page_url = get_lang_page_url();
$theme_vars = json_config_array('header', 'vars', 1);
$more_btn = ifEmptyText($theme_vars['inquiryBtn']['value'], 'Read More');
?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $tagName; ?><?php if ($paged > 1) printf('–%s', $paged); ?></title>

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

        <!-- path -->
        <?php get_breadcrumbs(); ?>
        <!-- main_content start -->
        <section class="web_main page_main">
            <div class="layout">
                
                <!--// main start -->
                <section>
                    
                    <?php if (have_posts()) { ?>
                        <div class="tp-list mt-6">
                            <?php while (have_posts()) {
                                the_post();
                                $category = get_the_category();
                                $cid = $category[0]->cat_ID;
                                $pid = get_category_root_id($cid);
                                $the_slug = get_category($pid)->slug;

                                $thumbnail = ifEmptyText(get_post_meta(get_post()->ID, 'thumbnail', true));
                                $tags = get_the_tags($post->ID);

                                if ($the_slug != 'news') {
                                    $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true);
                                    $tags = get_the_tags($post->ID);
                            ?>


                                    <div class="d-flex tp-list-item">

                                        <?php if (!empty($thumbnail)) { ?>
                                            <div class="tp-media">
                                                <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>">
                                            </div>
                                        <?php } ?>

                                        <div class="tp-content d-flex flex-coloum">

                                            <div class="d-flex align-items-center mb-1">
                                                <h3 class="tp-content-title ellipsis-1">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <span class="right">
                                                    <div class="tp-btn tp-btn-yellow">
                                                        <a href="<?php the_permalink(); ?>"><?php echo $more_btn; ?></a>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="tp-content-expert ellipsis-4">
                                                <?php the_excerpt(); ?>
                                            </div>

                                            <div>
                                                <div class="tag">
                                                    <?php foreach ($tags as $item) { ?>
                                                        <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name ?></a>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                            <?php }
                            } ?>
                        </div>
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    <?php } ?>
                    <?php get_template_part('templates/components/sendMessage') ?>
                </section>
                <!--// main end -->
            </div>
        </section>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>