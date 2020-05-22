<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例

// products.json -> vars 数据获取
$theme_vars = json_config_array('products','vars');
// Text 数据处理
$products_bg = ifEmptyText(get_term_meta($cat,'background',true));
if (empty($products_bg)){
    $products_bg = ifEmptyText($theme_vars['bg']['value']);
}
$products_header_desc = ifEmptyText(get_term_meta($cat,'header_desc',true));
$products_footer_desc =ifEmptyText(get_term_meta($cat,'footer_desc',true));
$products_null_tip = ifEmptyText($theme_vars['nullTip']['value'],'No Product');

$subName = ""; // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置
$category = get_category($cat);
$the_category_name = $category->name; //当前分类名称

// SEO
$seo_title = ifEmptyText(get_term_meta($cat,'seo_title',true));
if (empty($seo_title)){
    $seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
}
$seo_description = ifEmptyText(get_term_meta($cat,'seo_description',true));

if (empty($seo_description)){
    $seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
}

$seo_keywords = ifEmptyText(get_term_meta($cat,'seo_keywords',true));
if (empty($seo_keywords)){
    $seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
}



// 当前页面url
$get_full_path = get_full_path();
$page_url = $get_full_path.get_category_link($category->term_id);

// 当前是第几页
$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

// 产品列表数据
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged' => $paged,
    'cat' => $cat,   // 指定分类ID
    'posts_per_page' => get_posts_per_page_num(), /* 显示几条 */
    'meta_key' => 'list_order',/* 此处为你的自定义栏目名称 */
    'orderby' => 'list_order', /* 配置排序方式为自定义栏目值 */
    'order' => 'DESC', /* 降序排列 */
    'caller_get_posts' => 1,
);
$product_posts_items = query_posts($args);
wp_reset_query(); // 重置query 防止影响其他query查询
$max = intval( $wp_query->max_num_pages );

?>
    <!--nextpage-->

<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?><?php if ( $paged > 1 ) printf('–%s',$paged); ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <link rel="canonical" href="<?php echo $page_url;?>" />
    <?php if($paged !== 0) { ?>
        <link rel="prev" href="<?php previous_posts();?>" />
    <?php } ?>
    <?php if($max > 1 && $paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>

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
        <div class="main-tit-bar">
            <?php if ($subName == '') { ?>
                <h1 class="title" style="text-transform:uppercase"><?php echo $the_category_name; ?></h1>
            <?php } else { ?>
                <h3 class="title" style="text-transform:uppercase"><?php echo $the_category_name; ?></h3><h1 style="text-transform:uppercase"><?php echo $subName; ?></h1>
            <?php } ?>
        </div>
        <?php if ($products_bg !== '') { ?>
            <div class="main-banner">
                <ul class="slides">
                    <li class="item"><img src="<?php echo $products_bg; ?>"/></li>
                </ul>
            </div>
        <?php } ?>
        <?php if($products_header_desc !== '') { ?>
            <div class="goods-summary"><?php echo $products_header_desc; ?></div>
        <?php } ?>
        <div class="items_list">
            <?php if(ifEmptyArray($product_posts_items) !== []){ ?>
                <ul class="gm-sep" >
                    <?php
                    foreach( $product_posts_items as $key => $item ){
                        $thumbnail = get_post_meta($item->ID,'thumbnail',true);
                        ?>
                        <li class="product-item">
                            <figure class="item-wrap">
                                <a href="<?php echo get_permalink($item->ID); ?>" class="item-img">
                                    <img src="<?php echo $thumbnail ?>_thumb_220x220.jpg"  alt="<?php echo $item->post_title; ?>"/>
                                </a>
                                <figcaption class="item-info">
                                    <h3 class="item-title">
                                        <a class="limit-2-line" style="max-width: 100%" href="<?php echo get_permalink($item->ID); ?>">
                                            <?php echo $item->post_title; ?>
                                        </a>
                                    </h3>
                                </figcaption>
                            </figure>
                        </li>
                    <?php } ?>
                </ul>
                <?php wpbeginner_numeric_posts_nav(); ?>
            <?php } else { ?>
                <div class="main_intro"><?php echo $products_null_tip; ?></div>
            <?php } ?>
            <?php if($products_footer_desc !== '') { ?>
                <div class="goods-summary"><?php echo $products_footer_desc; ?></div>
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
<?php get_template_part( 'templates/components/microdata' )?>
</html>

