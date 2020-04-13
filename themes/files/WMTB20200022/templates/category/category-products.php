<?php
global $wp_query; // Class_Reference/WP_Query 类实例
global $wp; // Class_Reference/WP 类实例
// products.json -> vars 数据获取
$theme_vars = json_config_array('products','vars');
// Text 数据处理
$products_bg = ifEmptyText($theme_vars['bg']['value']);
$products_header_desc = ifEmptyText($theme_vars['headerDesc']['value']);
$products_footer_desc = ifEmptyText($theme_vars['footerDesc']['value']);
$products_null_tip = ifEmptyText($theme_vars['nullTip']['value'],'No Product');

$subName = ""; // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置
$category = get_category($cat);
$the_category_name = $category->name; //当前分类名称

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
$paged = get_query_var('paged');
$max = intval( $wp_query->max_num_pages );

// 当前页面url
$page_url = get_lang_page_url();
?>
    <!--nextpage-->

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?><?php if ( $paged > 1 ) printf('–%s',$paged); ?></title>
    <meta name="keywords" content="<?php echo $seo_description; ?>" />
    <meta name="description" content="<?php echo $seo_keywords; ?>" />

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
                <?php if ($subName == '') { ?>
                    <header class="main-tit-bar">
                        <h1 class="title" style="text-transform:uppercase"><?php echo $the_category_name; ?></h1>
                    </header>
                <?php } else { ?>
                    <header class="main-tit-bar">
                        <h3 class="title" style="text-transform:uppercase"><?php echo $the_category_name; ?></h3><h1 style="text-transform:uppercase"><?php $subName; ?></h1>
                    </header>
                <?php } ?>
                <?php if ($products_bg !== '') { ?>
                    <div class="main-banner">
                        <img src="<?php echo $products_bg; ?>" style="width:912px;height:312px;margin-bottom: 30px;">
                    </div>
                <?php } elseif($products_header_desc !== '') { ?>
                    <p class="class-desc" style="margin-bottom:30px;"><?php echo $products_header_desc; ?></p>
                <?php } ?>
                <!-- product list -->
                <div class="items_list">
                    <?php if ( have_posts() ) { ?>
                        <ul>
                            <?php while ( have_posts() ) : the_post();   ?>
                            <?php $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true); ?>
                                <li class="product-item">
                                    <figure class="item-wrap">
                                        <a href="<?php the_permalink(); ?>" class="item-img">
                                        <img src="<?php echo $thumbnail ?>_thumb_262x262.jpg"
                                             alt="<?php the_title(); ?>"/>
                                        </a>
                                        <figcaption class="item-info">
                                            <h3 class="item-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php endwhile; ?>
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

