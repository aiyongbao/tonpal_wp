<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例
// products.json -> vars 数据获取
$theme_vars = json_config_array('products','vars');
// Text 数据处理


$subName = ""; // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置
$category = get_category($cat);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);


// 当前页面url
$get_full_path = get_full_path();
$page_url = $get_full_path.get_category_link($category->term_id);

$recent_posts = get_category_new_product('product', array(), 40, 'OBJECT');
?>

<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?><?php if ( $paged > 1 ) printf('–%s',$paged); ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <link rel="canonical" href="<?php echo $page_url;?>" />

    <?php get_template_part('templates/components/head'); ?>

    <style>
        .layout {
         width: 100%;
        }
        .main {
            width: 100%;
        }
        @media only screen and (max-width: 1280px) {
            .items_list .product_item {
                -webkit-box-flex: 0 0 25%;
                -webkit-flex: 0 0 25%;
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%;
                width: 25%;
            }
        }
        @media only screen and (max-width: 480px) {
            .items_list .product_item {
                -webkit-box-flex: 0 0 50%;
                -webkit-flex: 0 0 50%;
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
                width: 50%;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <section class="web_main page_main">
        <div class="layout">
            <section class="main">
                <div class="items_list">
                    <?php if ( have_posts() ) { ?>
                        <ul>
                            <?php foreach ($recent_posts as $item )  {
                                $thumbnail = get_post_meta($item->ID,'thumbnail',true);
                                ?>
                                <li class="product_item">
                                    <figure>
                                        <span class="item_img">
                                            <img src="<?php echo $thumbnail ?>_thumb_262x262.jpg" alt="<?php echo $item->post_title; ?>" />
                                            <a href="<?php echo get_permalink($item->ID); ?>" target="_blank" ></a>
                                        </span>
                                        <figcaption>
                                            <h3 class="item_title">
                                                <a class="ellipsis-1" href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a>
                                            </h3>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </section>
        </div>
    </section>
</div>
</body>

<?php get_footer(); ?>

</html>

