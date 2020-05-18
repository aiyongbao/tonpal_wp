<?php
/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
global $wp_query,$wp,$post;
$paged = get_query_var('paged');
$max = intval( $wp_query->max_num_pages );
$tagName = single_tag_title('',false);
$tagName = str_replace("wmtbprefix","",$tagName);
// 当前页面url
$page_url = get_lang_page_url();
$theme_vars = json_config_array('header','vars',1);

$tags_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value'],'Send Inquiry Now');
?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $tagName; ?><?php if ( $paged > 1 ) printf('–%s',$paged); ?></title>

    <link rel="canonical" href="<?php echo $page_url;?>" />
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
    <!-- main_content start -->
    <section class="web_main page_main">
        <div class="layout">
            <!--//  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->

            <!--// main start -->
            <section class="main" >
                <header class="border-bottom-2 mb-10">
                    <h1><?php echo $tagName ?></h1>
                </header>
                <?php if ( have_posts() ) { ?>
                    <ul class="tags-ul mobile-ul">
                        <?php while ( have_posts() ) {
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
                                <li class="post-item border-bottom-2">
                                    <figure class="item-wrap">
                                        <?php if (!empty($thumbnail)) { ?>
                                            <a href="<?php the_permalink()  ?>" class="item-image"><img src="<?php echo $thumbnail ?>_thumb_220x220.jpg" alt="<?php the_title(); ?>" /></a>
                                        <?php } ?>
                                        <figcaption class="item-info">
                                            <h3 class="item-title"><a href="<?php the_permalink()  ?>" class="title-link"><?php the_title(); ?></a><a class="button" href="<?php the_permalink()  ?>"><?php echo $tags_inquiry_btn; ?></a></h3>
                                            <div class="item-detail"><?php the_excerpt(); ?></div>
                                            <div class="tag">
                                                <?php foreach ($tags as $item ) {
                                                    $tags_name = str_replace("wmtbprefix","",$item->name);
                                                    ?>
                                                    <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $tags_name?></a>
                                                <?php } ?>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } } ?>
                    </ul>
                    <?php wpbeginner_numeric_posts_nav(); ?>
                <?php } ?>
                <?php get_template_part( 'templates/components/sendMessage' )?>
            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// main_content end -->

    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

