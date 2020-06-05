<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();


// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID, 'seo_title', true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID, 'seo_description', true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID, 'seo_keywords', true));

// 当前页面url
$page_url = get_lang_page_url();

?>
<!DOCTYPE html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php get_template_part('templates/components/head') ?>
    <style>
        

        .tags a {
            font-size: 16px;
            padding: 0 5px;
        }

        .tags {
            font-size: 19px;
            padding: 10px 0;
        }

        .mt50 {
            margin-top: 0;
        }

        .chapter {
            font-size: .2rem;
        }

        .chapter a,
        .chapter span {
            font-size: 16px;
        }

        .goods-title-bar {
            margin-bottom: 0px;
            margin-top: 60px;
            background-color: #f2f2f2;
            margin-bottom: 15px;
            padding: 2px .15rem;
        }

        .underline a {
            text-decoration: underline;
        }
    </style>

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
                <!--// aside end -->
                <!-- main begin -->
                <section class="main">
                    <div class="product-intro" style="text-align: center">
                        <h1 class="product-title" style="text-transform:capitalize;padding:5px;"><?php echo $post->post_title ?></h1>
                        <time style="font-size: 10px"><?php echo $post->post_date ?></time>
                    </div>
                    <article class="entry blog-article">
                        <section class="mt15">
                            <?php echo $post->post_content ?>
                        </section>
                    </article>
                    <div class="chapter underline" style="font-size: 19px;margin-top:20px;border-bottom: 1px solid #E5E5E5;">
                        <?php
                        // prev
                        get_prev_or_next_post('prev', 'prev', 'Prev : ', 'This is the last news.');
                        // next
                        get_prev_or_next_post('next', 'next', 'Next : ', 'This is the latest news.');
                        ?>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <h1 class="tags-title" style="text-transform:capitalize;margin-top: 20px;">TAGS</h1>
                        <?php get_template_part('templates/components/tags-random-category') ?>
                    </div>
                    <?php if ( !empty($res_post) ) { ?>
                    <div class="goods-title-bar">
                        <h2 class="title">RELATED PRODUCTS</h2>
                    </div>
                    <div class="blog_list">
                        <ul>
                            <?php foreach ($res_post as $item) { ?>
                                <?php $thumbnail=get_post_meta($item->ID,'thumbnail',true); ?>
                                <li class="blog-item news-list-item">
                                    <figure class="item-wrap">
                                        <a href="<?php the_permalink(); ?>" class="item-img">
                                            <img style="width:262px;height:135px;"
                                                 src="<?php echo $thumbnail ?>"
                                                 alt="<?php the_title(); ?>"/>
                                        </a>
                                        <figcaption class="item-info">
                                            <h3 class="item-title">
                                                <a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a>
                                            </h3>
                                            <time datetime="<?php echo $item->post_date; ?>"><?php echo $item->post_date; ?></time>
                                            <div class="item-detail"><?php echo $item->post_excerpt; ?></div>
                                            
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                    <?php get_template_part('templates/components/sendMessage') ?>

                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer') ?>
    </div>
</body>
<?php get_footer() ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>