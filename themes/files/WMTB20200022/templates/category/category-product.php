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

$sub_title = ifEmptyText(get_term_meta($cat,'sub_title',true));  // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置
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
            <!--  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aisde end -->
            <!-- main begin -->
            <section class="main">
                <header style="display: block" class="main-tit-bar">
                    <?php if ($sub_title == '') { ?>
                        <h1 class="h1-title">
                            <?php echo $the_category_name; ?>
                        </h1>
                    <?php } else { ?>
                        <div class="h1-title">
                            <?php echo $the_category_name; ?>
                        </div>
                        <h1 class="sub-title">
                            <?php echo $sub_title; ?>
                        </h1>
                    <?php } ?>
                </header>

                <?php if ($products_bg !== '') { ?>
                    <div class="main-banner">
                        <img src="<?php echo $products_bg; ?>" style="width:912px;height:312px;margin-bottom: 30px;">
                    </div>
                <?php } elseif($products_header_desc !== '') { ?>
                    <p class="class-desc mt-15" style="margin-bottom:15px;"><?php echo $products_header_desc; ?></p>
                <?php } ?>
                <!-- product list -->
                <div class="items_list">
                    <?php if(ifEmptyArray($product_posts_items) !== []){ ?>
                        <ul>
                            <?php
                            foreach( $product_posts_items as $key => $item ){
                            $thumbnail = get_post_meta($item->ID,'thumbnail',true);
                            ?>
                                <li class="product-item">
                                    <figure class="item-wrap">
                                        <a href="<?php echo get_permalink($item->ID); ?>" class="item-img">
                                        <img src="<?php echo $thumbnail ?>_thumb_262x262.jpg"
                                             alt="<?php echo $item->post_title; ?>"/>
                                        </a>
                                        <figcaption class="item-info">
                                            <h3 class="item-title">
                                                <a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a>
                                            </h3>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    <?php } else { ?>
                        <div class="row">
                            <div class="no-product"><?php echo $products_null_tip; ?></div>
                        </div>
                    <?php } ?>
                </div>
                <?php if($products_footer_desc != ''){ ?>
                    <p class="class-desc" style="margin:15px 0;"><?php echo $products_footer_desc; ?></p>
                <?php } ?>
                <!-- sendMessage -->
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

