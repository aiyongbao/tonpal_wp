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
// 当前页面url
$page_url = get_lang_page_url();

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
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->
        <!-- path -->
        <nav class="path-bar">
            <?php get_breadcrumbs(); ?>
        </nav>
        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->
                <!-- main begin -->
                <section class="main">
                    <header class="main-tit-bar">
                        <h1 class="title border"><?php echo $tagName; ?></h1>
                    </header>
                    <header class="main-tit-bar" style="margin-bottom: 10px;">
                        <h2 class="title" style="font-size:20px; margin-top:30px;">Products:<span><?php echo $tagName; ?></span></h2>
                    </header>
                    <div class="blog_list tags_blog_list">
                        <?php if (have_posts()) { ?>
                            <ul>
                                <?php while (have_posts()) {
                                    the_post();
                                    $category = get_the_category();
                                    $cid = $category[0]->cat_ID;
                                    $pid = get_category_root_id($cid);
                                    $the_slug = get_category($pid)->slug;
                                    if ($the_slug == 'product') {
                                        $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true);
                                        $tags = get_the_tags($post->ID);

                                ?>
                                        <li class="blog-item tags-item">
                                            <figure class="item-wrap">
                                                <a href="<?php the_permalink()  ?>" class="item-img" style="border: .05rem solid #e5e5e5;"><img src="<?php echo $thumbnail ?>_thumb_220x220.jpg" alt="<?php the_title(); ?>" /></a>
                                                <figcaption class="item-info">
                                                    <h3 class="item-title limit-1-line"><a href="<?php the_permalink()  ?>"><?php the_title(); ?></a></h3>
                                                    <div class="item-detail  limit-3-line"><?php the_excerpt(); ?></div>
                                                    <div class="tags">
                                                        <?php foreach ($tags as $item) { ?>
                                                            <a style="display:inline-block;line-height:17px;padding: 5px 10px; margin: 15px 5px 0 0;border: 1px solid #22264b;" href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name ?></a>
                                                        <?php } ?>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                            <div class="page-bar">
                                <div class="pages"><?php wpbeginner_numeric_posts_nav(); ?>
                                </div>
                            </div>
                            <header class="main-tit-bar tags-title" style="margin-top: 50px;">
                                <h2 class="title limit-1-line" style="font-size:20px; margin-top:20px;"><?php echo $tagName; ?></h2>
                            </header>
                            <div class="tags-related clearfix">
                            <?php foreach ($tags as $item) { ?>
                            <a class="tags-w2"  style="margin-top: 10px;"href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name ?></a> <?php } ?>
                            </div>
                           
                            
                        <?php } ?>
                    </div>
                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>