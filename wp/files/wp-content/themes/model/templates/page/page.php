<?php
$order_by = 'comment_count';

/** 升序还是降序，DESC表示降序，ASC表示升序 */
$order = 'DESC';

/** 每页显示多少篇文章 */
$posts_per_page = 5;

/**
 * 只显示或不显示某些目录下的文章,目录ID用逗号分隔，排除目录前面加-
 * 例如排除目录29和30下的文章, $cat = '-29,-30';
 * 只显示目录29和30下的文章, $cat = '29, 30';
 */
$cat = '-59';

/** 获取该页面的标题和内容 */
global $post;
$post_title = $post->post_title;
$post_content = apply_filters('the_content', $post->post_content);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


/**
 * 获取文章列表
 * 用WP_Query获取posts
 */
$post_list = new WP_Query(
    "posts_per_page=" . $posts_per_page .
    "&orderby=" . $order_by .
    "&order=" . $order .
    "&cat=" . $cat .
    "&paged=" . $paged
);
/** 获取文章总数 */
$total_posts = $post_list->found_posts;
?>


    <!doctype html>
    <title>Educenter</title>
    <head>
        <meta charset="utf-8">
        <link rel="canonical" href="<?php echo home_url('archives/category/products');?>" />

        <?php get_template_part('templates/components/head'); ?>
        <style>
            .card-title {
                overflow: hidden;
                text-overflow:ellipsis;
                white-space: nowrap;
            }
            .card-body > p {
                height: 56px;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                text-overflow: ellipsis;
            }
        </style>

    </head>

    <body>
    <!-- header -->
    <?php get_header() ?>
    <!-- header -->

    <main>
        <!-- page title -->
        <section class="page-title-section overlay" data-background="<?php echo get_template_directory_uri() ?>/assets/images/backgrounds/page-title.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="list-inline custom-breadcrumb">
                            <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">product</a></li>
                            <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                        </ul>
                        <p class="text-lighten">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /page title -->

        <!-- blogs -->
        <section class="section">
            <div class="container">
                <?php if ($post_list->have_posts()) : ?>
                    <div class="row">
                        <?php while ($post_list->have_posts()) : $post_list->the_post(); ?>
                            <article class="col-lg-4 col-sm-6 mb-5">
                                <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                                    <img class="card-img-top rounded-0" src="<?php echo get_template_directory_uri() ?>/assets/images/blog/post-1.jpg" alt="Post thumb">
                                    <div class="card-body">
                                        <ul class="list-inline mb-3">
                                            <li class="list-inline-item mr-3 ml-0"><?php echo esc_html( get_the_date() ); ?></li>
                                        </ul>
                                        <a href="<?php the_permalink(); ?>" target="_blank">
                                            <h4 class="card-title"><?php the_title(); ?></h4>
                                        </a>
                                        <?php the_excerpt(); ?>
                                        <a href="<?php the_permalink(); ?>" target="_blank" class="btn btn-primary btn-sm">read more</a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        <?php if (function_exists('wp_pagenavi')) wp_pagenavi( array('query' => $post_list) ); ?>
                    </div>
                <?php endif; ?>

            </div>
        </section>
        <!-- /blogs -->
    </main>
    </body>

<?php get_footer(); ?>