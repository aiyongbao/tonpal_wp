<?php

// Text 数据处理
$tags_title = 'tags';

// SEO
$seo_title = '';
$seo_description = '';
$seo_keywords = '';
/**
 * $wp_query 是全局变量
 * $paged 当前页数
 * $max 该分类总页数
 */
global $wp_query,$wp,$post;
$paged = get_query_var('paged');
$max = intval( $wp_query->max_num_pages );

// 当前页面url
$page_url = get_lang_page_url();
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
            array_push($product_item,$post);
        } else {
            array_push($news_item,$post);
        }
    }

}
//print_r($product_item);
//print_r($news_item);


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
            <!--// aside end -->
            <!-- main begin -->
            <section class="main">
                <header class="main-tit-bar tags-title">
                    <h1 class="title border"><?php echo $post->title; ?></h1>

                </header>
                <div class="blog_list">
                    <ul>
                        <?php foreach ($product_item as $item ) { ?>
<!--                            <li class="blog-item tags-item">-->
<!--                                <figure class="item-wrap">-->
<!--                                    <a href="/{{ product_single['url'] }}"class="item-img"><img src="{{ product_single['product_main_img'] }}_thumb_220x220.jpg" alt="{{ product_single['product_main_img_alt'] }}" /></a>-->
<!--                                    <figcaption class="item-info">-->
<!--                                        <h3 class="item-title"><a href="/{{ product_single['url'] }}">{{product_single["title"]}}</a></h3>-->
<!--                                        <div class="item-detail">{{ product_single["abstract"] }}</div>-->
<!--                                        <div class="tags">-->
<!--                                            {{product_single["tags_cloud_special_html"]}}-->
<!--                                        </div>-->
<!--                                    </figcaption>-->
<!--                                </figure>-->
<!--                            </li>-->
                        <?php } ?>
                    </ul>
                </div>


                <header class="main-tit-bar tags-title">
                    <h2 class="title">News:<span>{{tag}}</span></h2>
                </header>
                <div class="blog_list">
                    <ul>
                        <?php foreach ($news_item as $item ) { ?>
<!--                        <li class="blog-item tags-item tags-news">-->
<!--                            <figure class="item-wrap">-->
<!--                                <a href="/{{ news_single['url'] }}"class="item-img"><img style='width:220px;    height:100px;' src="{{ news_single['product_main_img'] }}_thumb_262x135.jpg" alt="{{ news_single['product_main_img_alt'] }}" /></a>-->
<!--                                <figcaption class="item-info">-->
<!--                                    <h3 class="item-title"><a href="/{{ news_single["url"] }}">{{news_single["title"]}}</a></h3>-->
<!--                                    <div class="item-detail">{{ news_single["abstract"] }}</div>-->
<!--                                </figcaption>-->
<!--                            </figure>-->
<!--                        </li>-->
                        <?php } ?>
                    </ul>
                </div>


<!--                {% if relevant_tag is defined and relevant_tag is not empty %}-->
<!--                <header class="main-tit-bar tags-title">-->
<!--                    <h2 class="title">{{tag}}</h2>-->
<!--                </header>-->
<!--                <div class="tags-related clearfix">-->
<!--                    {% for relevant_tag_single in relevant_tag %}-->
<!--                    <a href="{{relevant_tag_single['url']}}">{{relevant_tag_single['name']}}</a>-->
<!--                    {% endfor %}-->
<!--                </div>-->
<!--                {% endif %}-->
            </section>
            <!--// main end -->
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

