<?php
global $wp_query,$wp,$cat;


// products.json -> vars 数据获取
$theme_vars = json_config_array('products','vars');
// Text 数据处理
$products_title = ifEmptyText($theme_vars['title']['value'],'Product');
$products_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$products_desc = ifEmptyText($theme_vars['desc']['value'],'This is desc');
$products_null_tip = ifEmptyText($theme_vars['nullTip']['value'],'No Product');

$subName = ""; // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置
$category = get_category($cat);
$the_category_name = $category->name; //当前分类名称

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$products_title");
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
    <?php if($paged !== $max) { ?>
        <link rel="next" href="<?php next_posts(); ?>" />
    <?php } ?>

    <?php get_template_part('templates/components/head'); ?>
    <style>
        .products .section {
            padding-top: 30px;
        }
        .products-item .card-title {
            overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .products-item .card-body > p {
            height: 56px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }
        .no-product {
            font-size: 30px;
        }
    </style>

</head>

<body>
<!-- preloader start -->
<div class="preloader">
    <img src="<?php echo get_template_directory_uri()?>/assets/images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->
<!-- header -->
<?php get_header() ?>
<!-- header -->

<main class="products">
    <section class="page-title-section overlay page-bg" data-background="<?php echo $products_bg; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php get_breadcrumbs();?>
                    <p class="text-lighten"><strong><?php echo $products_desc; ?></strong></p>
                </div>
            </div>
        </div>
    </section>
    <!-- title -->
    <div class="page-title container mt-2 mb-1">
        <?php if ($subName == '') { ?>
            <h1><?php echo $the_category_name; ?></h1>
        <?php } else { ?>
            <h3><?php echo $the_category_name; ?></h3><h1><?php $subName; ?></h1>
        <?php } ?>
    </div>
    <!-- /title -->

    <!-- blogs -->
    <section class="section ">
        <div class="container">
            <?php if ( have_posts() ) { ?>
                <div class="row products-item">
                    <?php while ( have_posts() ) : the_post();   ?>
                    <?php $thumbnail=get_post_meta(get_post()->ID,'thumbnail',true); ?>
                        <article class="col-lg-4 col-sm-6 mb-5">
                            <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                                <?php if ( ifEmptyText($thumbnail) !== '' ) { ?>
                                    <img class="card-img-top rounded-0" src="<?php echo $thumbnail ?>_thumb_262x262.jpg" alt="<?php ifEmptyText(the_title(),'This is title'); ?>">
                                <?php } else {?>
                                    <img class="card-img-top rounded-0" src="http://iph.href.lu/350x350?text=350x350" alt="占位图">
                                <?php } ?>
                                <div class="card-body">
                                    <a href="<?php the_permalink(); ?>" target="_blank">
                                        <h4 class="card-title"><?php ifEmptyText(the_title(),'This is title'); ?></h4>
                                    </a>
                                    <p><?php ifEmptyText(the_excerpt(),'This is excerpt'); ?></p>
                                    <a href="<?php the_permalink(); ?>" target="_blank" class="btn btn-primary btn-sm">read more</a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php wpbeginner_numeric_posts_nav(); ?>
            <?php } else { ?>
                <div class="row">
                    <div class="no-product"><?php echo $products_null_tip; ?></div>
                </div>
            <?php } ?>

            <?php get_template_part( 'templates/components/tags-assembly' ); ?>

            
        </div>
    </section>
    <!-- /blogs -->
</main>
<?php get_template_part( 'templates/components/footer' ); ?>

</body>

<?php get_footer(); ?>

<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

