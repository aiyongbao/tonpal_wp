<?php
/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
global $wp_query,$wp,$post;

$theme_vars = json_config_array('products','vars');
$page_bg = ifEmptyText($theme_vars['image']['value']);

$paged = get_query_var('paged');
$max = intval( $wp_query->max_num_pages );
$tagName = single_tag_title('',false);
$tagName = str_replace("wmtbprefix","",$tagName);
// 当前页面url
$page_url = get_lang_page_url();
$theme_vars_header = json_config_array('header','vars',1);

$tags_inquiry_btn = ifEmptyText($theme_vars_header['tagReadMoreBtn']['value'],'Read More');
?>

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
                        <h1 class="h1-title" style="text-transform:uppercase">
                            <?php echo $tagName ?>
                        </h1>
                    </div>
                </div>
                <div class="tag_list">
                    <?php if ( have_posts() ) { ?>
                        <ul>
                            <?php while ( have_posts() ) {
                                the_post();
                                $category = get_the_category();
                                $cid = $category[0]->cat_ID;
                                $pid = get_category_root_id($cid);
                                $the_slug = get_category($pid)->slug;
                                if ($the_slug != 'news') {
                                    $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true);
                                    $tags = get_the_tags($post->ID);
                                    ?>
                                    <li class="tag_item">
                                        <figure class="item_wrap">
                                            <?php if (!empty($thumbnail)) { ?>
                                                <a href="<?php the_permalink()  ?>" class="item-img"><img src="<?php echo $thumbnail ?>_thumb_262x262.jpg" alt="<?php the_title(); ?>" /></a>
                                            <?php } ?>
                                            <figcaption class="item-info">
                                                <h3 class="item-title"><a href="<?php the_permalink(); ?>" class="title-link"><?php the_title(); ?></a><a class="button" href="<?php the_permalink()  ?>"><?php echo $tags_inquiry_btn; ?></a></h3>
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

