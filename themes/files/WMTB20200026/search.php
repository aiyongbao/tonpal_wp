<?php

if ( have_posts() ) {
    $product_item = [];
    $keywords = get_query_var('s');
    $term_id = get_category_by_slug("product")->term_id;
    $wp_query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => $term_id,   // 指定分类ID
        's'=>$keywords,
        'meta_key' => 'list_order',/* 此处为你的自定义栏目名称 */
        'orderby' => 'list_order', /* 配置排序方式为自定义栏目值 */
        'order' => 'DESC', /* 降序排列 */
        'caller_get_posts' => 1,
    ]);

    while ( $wp_query->have_posts() ) {
        $wp_query->the_post();
        $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true);
        $post->thumbnail = $thumbnail;
        array_push($product_item,$post);
    }
    wp_reset_query(); // 重置query 防止影响其他query查询
}

?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <title><?php echo $keywords; ?></title>
    <?php get_template_part('templates/components/head'); ?>
    <style type="text/css">
        .items_list .product-item .item-info .item-title a{width: 100%}
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
            <h1 class="title" style="text-transform:uppercase"><?php echo 'Search Results'; ?></h1>
        </header>
        <?php if ( $product_item != [] ) { ?>
            <div class="items_list">
                <ul class="gm-sep">
                    <?php foreach ($product_item as $item ) { ?>
                        <li class="product-item">
                            <figure class="item-wrap">
                                <a href="<?php echo get_permalink($item->ID); ?>" class="item-img">
                                    <img src="<?php echo $item->thumbnail; ?>_thumb_220x220.jpg"
                                         alt="<?php echo $item->post_title; ?>"/>
                                </a>
                                <figcaption class="item-info">
                                    <h3 class="item-title">
                                        <a class="limit-2-line" style="max-width: 100%" href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a>
                                    </h3>
                                </figcaption>
                            </figure>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } else { ?>
            <div class="items_list">
                <ul>
                    <li class="product-item">
                        No Products!
                    </li>
                </ul>
            </div>
        <?php } ?>
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
<?php get_template_part( 'templates/components/microdata' )?>
</html>

