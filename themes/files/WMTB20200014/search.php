<?php
$category = get_category($cat);
$the_category_name = $category->name; //当前分类名称


if ( have_posts() ) {
    $product_item = [];
    $news_item = [];
    while ( have_posts() ) {
        the_post();
        $category = get_the_category();
        $cid = $category[0]->cat_ID;
        $pid = get_category_root_id($cid);
        $the_slug = get_category($pid)->slug;
        if ( $the_slug == 'product' ) {
            $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true);
            $post->thumbnail = $thumbnail;
            array_push($product_item,$post);

        }
    }

}
?>
<!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <title><?php echo $the_category_name; ?></title>
    <?php get_template_part('templates/components/head'); ?>


</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_header() ?>
    <!--// header end  -->
    <!-- path -->
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <section class="web_main page_main">
        <div class="layout">
            <!--  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>

            <!--// aisde end -->
            <!-- main begin -->
            <section class="main">
                <div class="main_hd">
                    <div class="page_title">
                        <h1 style="text-transform:uppercase">Search Results</h1>
                    </div>
                </div>
                <!-- product list -->
                <div class="items_list">
                    <?php if ( $product_item != [] ) { ?>
                        <ul>
                            <?php foreach ($product_item as $item ) { ?>
                                <li class="product_item">
                                    <figure>
                                            <span class="item_img">
                                                <img src="<?php echo $item->thumbnail; ?>_thumb_262x262.jpg" alt="<?php echo $item->post_title; ?>" />
                                                <a href="<?php echo get_permalink($item->ID); ?>" target="_blank" ></a>
                                            </span>
                                        <figcaption>
                                            <h3 class="item_title">
                                                <a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a>
                                            </h3>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <ul>
                            <li class="product-item">
                                No Products!
                            </li>
                        </ul>
                    <?php } ?>
                </div>

                <?php get_template_part( 'templates/components/sendMessage' ); ?>
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

