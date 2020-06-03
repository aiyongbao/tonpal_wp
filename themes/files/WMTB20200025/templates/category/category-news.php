<?php
$news_vars = json_config_array('news', 'vars');
// SEO
$news_seoTitle = ifEmptyText($news_vars['seoTitle']['value']);
$news_seoDescription = ifEmptyText($news_vars['seoDescription']['value']);
$news_seoKeywords = ifEmptyText($news_vars['seoKeywords']['value']);
$news_null_tip = ifEmptyText($news_vars['nullTip']['value']);
$page_url = get_full_path();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $news_seoTitle ?></title>
    <meta name="keywords" content="<?php echo $news_seoKeywords; ?>" />
    <meta name="description" content="<?php echo $news_seoDescription; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php get_template_part('templates/components/head') ?>
    <style>
        .pagesList {
            display: flex;
        }

        .pagesList li.active a {
            background: #f00000;
            color: #fff;
            border-color: #f00000;
        }

        .main .items_list .product_item figure span.item_img {
            width: 300px;
            height: 295px;
        }

        .intro_desc {
            color: #666;
            font-size: 16px;
        }

        .product_item .item_title a {
            text-align: center;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            font-size: 16px;
            padding: 0;
        }

        .sub_head_intro div.intro_desc {
            padding: 0;
        }

        @media only screen and (max-width: 950px) {
            .sub_head_intro {
                padding: 15px 0 0;
            }

            .web_main .layout {
                width: 98%;
            }

            .web_main .main>.items_list>ul {
                margin: 0;
            }

            .web_main .main .items_list ul {
                width: 100%;
                margin: 0;
            }

            .main .items_list .product_item figure {
                border: 1px solid #efefef;
            }

            .main .items_list .product_item .item_img,
            .goods-may-like .product_item .item_img {
                border: none;
                width: 100% !important;
            }

            .side-product-items .side_product_item {
                width: 30% !important;
            }

            ul.swiper-wrapper.left-swiper-ul li {
                width: 20%;
            }

            .side-widget .tags a {
                display: block;
                float: left;
                padding: 5px;
                border: 1px solid #efefef;
                margin: 0 5px 5px 0;
            }
        }

        @media only screen and (max-width: 480px) {
            .main .items_list .product_item figure span.item_img {
                height: 220px;
                line-height: 220px;
            }

            .layout,
            .index_product .layout,
            .index_featured .layout {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- header -->
        <?php get_header() ?>

        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <section class="web_main page_main">
            <div class="layout">
                <!-- aside -->
                <?php get_template_part('templates/components/side-bar'); ?>

                <!-- main start -->
                <section class="main">
                    <div class='blog_list category-news'>
                        <?php if (have_posts()) { ?>
                            <ul>
                                <?php while (have_posts()) : the_post();   ?>
                                    <?php $thumbnail = get_post_meta(get_post()->ID, 'thumbnail', true); ?>
                                    <li class="blog-item">
                                        <figure class="item-wrap">
                                            <a href="<?php the_permalink(); ?>" class="item-img" style="width: 200px;height: 200px;line-height: 185px;">
                                                <img src="<?php echo $thumbnail ?>" alt="<?php the_title(); ?>" />
                                            </a>
                                            <figcaption class="item-info">
                                                <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                <time datetime="<?php echo esc_html(get_the_date()); ?>"><?php echo esc_html(get_the_date()); ?></time>
                                                <div class="item-detail"><?php the_excerpt(); ?></div>
                                            </figcaption>
                                        </figure>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                            <?php wpbeginner_numeric_posts_nav(); ?>
                        <?php } else { ?>
                            <div class="row">
                                <div class="no-product"><?php echo $news_null_tip; ?></div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- send-message -->
                    <?php get_template_part('templates/components/send-message') ?>
                </section>
                <!--// main end -->
            </div>
        </section>

        <!-- footer -->
        <?php get_template_part('templates/components/footer') ?>
    </div>
</body>

<?php get_footer(); ?>

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>