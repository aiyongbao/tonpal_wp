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
    <style type="text/css">
        .product-item.video-list {
            width: 50% !important;
            box-sizing: border-box;
        }
        .product-item.video-list .item-img img {
            visibility: hidden;
        }
        .video-list .item-img iframe{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
        }
        .items_list .product-item {
            float: none;
            display: inline-block;
        }
        .blog-item.tags-item .tags a{
            display: inline-block;
            padding: 2px 4px;
            border: 1px solid #22264b;
            margin: 10px 30px 0 0;
        }
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
        <header class="main-tit-bar">
            <h2 class="title">
                <?php echo $tagName; ?>
            </h2>
        </header>
        <div class="blog_list tags_blog_list">
            <?php if ( have_posts() ) { ?>
                <ul>
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
                            <li class="blog-item tags-item">
                                <figure class="item-wrap">
                                    <?php if (!empty($thumbnail)) { ?>
                                        <a href="<?php the_permalink()  ?>"class="item-img"><img src="<?php echo $thumbnail ?>_thumb_220x220.jpg" alt="<?php the_title(); ?>" /></a>
                                    <?php } ?>
                                    <figcaption class="item-info">
                                        <h3 class="item-title limit-1-line"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="item-detail limit-3-line"><?php the_excerpt(); ?></div>
                                        <div class="tags">
                                            <?php foreach ($tags as $item ) {
                                                $tags_name = str_replace("wmtbprefix","",$item->name);
                                                ?>
                                                <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $tags_name; ?></a>
                                            <?php } ?>
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                        <?php } } ?>
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