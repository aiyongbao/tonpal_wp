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
        .main {
            width: 100%;
        }
        .items_list .product-item {
             width: 24%;
        }
        /* .items_list .product-item:nth-child(3n+1) {
            clear: none;
        } */
        @media only screen and (max-width: 500px) {
            .items_list .product-item {
                width: 50%;
            }
            /* .items_list .product-item:nth-child(2n+1) {
                 clear: none;
            } */
        }
    </style>
    <style type="text/css">
    /* .product_list .product-item {
             width: 24%;
        } */
        .product-item .item-wrap {
            margin: 0;
            width: 100%
        }
        
        .product-item .pd-img {
            width: 100%;
            display: block;
            
        }

        .product-item .pd-img a {
            display: block;
        }

        .product-item .pd-img a img {
            width: 100%;
            display: block;
            margin-right: 0;
            max-width: 100%;
        }

        .product-item .pd-info a {
            margin: 0;
            margin-top: 10px;
        }

        .product-item .pd-info .pd-name {
            padding: 0 6px;
        }

        .goods-summary {
            margin: 15px 0;
        }

        .current {
            
            font-family: "Lato Bold ";
            padding: 0 0px;
        }


        .pd-info>h3>a {
            height: 36px;
        }
    </style>
</head>

<body>
<div class="container">
    <!-- header start -->
   
    <!-- main_content start -->
    <section class="page-layout">
            <!-- <div class="main_content"> -->
        <section class="layout">
            <section class="main">
                <section class="product-list">
                    
                    <?php if ( have_posts() ) { ?>
                        <ul class="gm-sep">
                            <?php foreach ($recent_posts as $item )  {
                                $thumbnail = get_post_meta($item->ID,'thumbnail',true);
                                ?>
                                <div class="product-item" style="border: 1px solid #d5d5d5;max-width:275px">
                                    <div class="item-wrap">
                                        <div class="pd-img" style=" border-bottom: 1px solid #EDEDED;max-width: 262px;">
                                        <a href="<?php echo get_permalink($item->ID); ?>" target="_blank" class="item-img">
                                        <img src="<?php echo $thumbnail ?>_thumb_262x262.jpg"
                                             alt="<?php echo $item->post_title; ?>"/>
                                        </a>
                                        </div>
                                        <div class="pd-info">
                                            <h3 class="pd-name">
                                                <a href="<?php echo get_permalink($item->ID); ?>"target="_blank" class="limit-2-line" ><?php echo $item->post_title; ?></a>
                                            </h3>
                                        </div>
                                </div>  
                                </div>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <div class="row">
                            <div class="no-product"><?php echo $products_null_tip; ?></div>
                        </div>
                    <?php } ?>
                </section>
                <div class="page-bar">
                        <div class="pages" ><?php wpbeginner_numeric_posts_nav(); ?>
                        </div>
                    </div>
            </section>
            <!--// main end -->
            <div class="clear"></div>
        </section>
    </section>
</div>
</body>

<?php //get_footer(); ?>

</html>

