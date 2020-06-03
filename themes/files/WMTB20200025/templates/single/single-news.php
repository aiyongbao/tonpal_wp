<?php
$theme_vars = json_config_array('header', 'vars', 1);
$post = get_post();
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID, 'seo_title', true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID, 'seo_description', true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID, 'seo_keywords', true));
$page_url = get_full_path();

$pdf = ifEmptyText(get_post_meta(get_post()->ID, 'pdf', true));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
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

        <div class="main_content single-news">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aisde end -->

                <!-- main start -->
                <section class="main">
                    <!-- 富文本区 -->
                    <div>
                        <header class="main-tit-bar">
                            <h1 class="title"><?php echo $post->post_title ?></h1>
                            <time><?php echo $post->post_date ?></time>
                        </header>
                        <article class="entry blog-article">
                            <section class="mt15">
                                <?php echo $post->post_content ?>
                            </section>
                        </article>
                        <?php wpbeginner_numeric_posts_nav(); ?>
                    </div>

                    <!-- 上一篇/下一篇 -->
                    <div style="margin-top: 35px">
                        <?php get_prev_or_next_post('prev_post', 'prev', 'Prev: ', 'no prev news'); ?>
                        <?php get_prev_or_next_post('next_post', 'next', 'Next: ', 'no next news'); ?>
                    </div>
                    <!-- Tags -->
                    <?php get_template_part('templates/components/tags-random-category') ?>
                    <!-- 产品推荐 -->
                    <div class='single-products'>
                        <?php get_template_part('templates/components/related-products') ?>
                    </div>
                    <!-- inquiry form -->
                    <?php get_template_part('templates/components/send-message'); ?>
                </section>
                <!--// main end -->
            </div>
        </div>

        <!-- footer -->
        <?php get_template_part('templates/components/footer') ?>
    </div>
</body>
<?php get_footer(); ?>

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>
</html>