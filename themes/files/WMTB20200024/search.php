<?php
$category = get_category($cat);
$the_category_name = $category->name; //当前分类名称


if ( have_posts() ) {
    $product_item = [];
    $keywords = get_query_var('s');
    /* $news_item = []; */

    $term_id = get_category_by_slug("product")->term_id;

    $wp_query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => $term_id,
        's' =>$keywords,
        'meta_key' => 'list_order',
        'orderby' => 'list_order',
        'order' => 'DESC',
        'caller_get_posts' => 1,
    ]);

    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true);
        $post->thumbnail = $thumbnail;
        array_push($product_item,$post);
    }
    wp_reset_query();
}
?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <title><?php echo $keywords; ?></title>
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

        <!--// aisde end -->
        <!-- main begin -->
        <section class="main">
                <div class="main-tit-bar">
                    <h1 class="title" style="text-transform:uppercase"><?php echo 'Search Results'; ?></h1>
                </div>
                <div class="goods-summary">
                        <p class="class-desc" style="margin-bottom:30px;"><?php echo $products_header_desc; ?></p><!-- 后台数据 -->
                    </div>
                <div class="main-banner">
                    </div>
            <!-- product list -->
            <?php if ( $product_item != [] ) { ?>
                <div class="product-list">
                    <ul class="gm-sep">
                        <?php foreach ($product_item as $item ) { ?>
                            <li class="product-item">
                                <div class="item-wrap">
                                <div class="pd-img"><a href="<?php the_permalink(); ?>" class="item-img">
                                        <img src="<?php echo $item->thumbnail; ?>_thumb_262x262.jpg"
                                             alt="<?php echo $item->post_title; ?>"/>
                                    </a>
                                </div>
                                    <div class="pd-info">
                                        <h3 class="pd-home">
                                            <a class="limit-3-line" href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a>
                                        </h3>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="items_list 2">
                    <ul>
                        <li class="product-item">
                            No Products!
                        </li>
                    </ul>
                </div>
            <?php } ?>
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
        </section>
        <!--// main end -->
        <div class="clear"></div>
    </div>
</div>
<!--// main_content end -->
<!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>

</div>
</body>

<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

