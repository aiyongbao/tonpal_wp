<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();
$category = get_the_category()[0];
// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

// 当前页面url
$page_url = get_lang_page_url();

$the_tags = get_the_tags( $post->ID ); // 获取当前产品的所有tags
$tags_array = [];
$exclude = array($post->ID); // 需要排除的id
$res_post = [];
foreach ($the_tags as $item ) { // 取出所有的tag的term_id
    array_push($tags_array,$item->term_id);
}
for ($i = 0; $i < count($tags_array); $i += 1 ) { // 循环所有的tag的term_id
    $related_posts = get_tags_relevant_product($tags_array[$i], $exclude,'info-news',5); // 根据tag的term_id获取相关产品
    $post_count = count(ifEmptyArray($related_posts)); // 统计获取到的产品数量
    if ($post_count > 0 && $post_count < 5) { // 当统计数在(1,5)时进入下一环节
        $num = 5 - $post_count; // 计算出需要补足的数量
        foreach( $related_posts as $item ) { // 将已获取的产品的id放入排除数组中
            array_push($exclude,$item->ID);
        }
        $recent_posts = get_category_new_product('info-news', $exclude, $num,'OBJECT'); // 获取需要补充的产品
        $res_post = array_merge($related_posts, $recent_posts); // 合并
        break;
    } elseif ($post_count == 5) { // 当计数为5时，已满足条件
        $res_post = $related_posts;
        break;
    }
}
if (empty($res_post)) { // 防止tags搜索不到数据时，补足五条
    $res_post = get_category_new_product('info-news', $exclude, 5, 'OBJECT');
}

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <link rel="canonical" href="<?php echo $page_url;?>" />
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .main {
            width: 100%;
        }
        .chapter {
            font-size: .2rem;
        }
        .chapter a,.chapter span {
            font-size: .15rem;
        }
        .goods-title-bar {
            margin-bottom: 0px;
            margin-top: 20px;
        }
        .underline a {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_header()?>
    <!--// header end  -->
    <!-- path -->
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <section class="web_main page_main">
        <div class="layout news">
            <!-- main begin -->
            <section class="main main-box">
                <div class="news-title border-bottom-1 mb-20">
                    <h1><?php echo $post->post_title ?></h1>
                </div>
                <div class="news-time"><?php echo $post->post_date; ?></div>
                <div class="iframe-box mt-15">
                    <iframe src="/rec-product" style="width:100%;" frameborder="no" scrolling="no"></iframe>
                </div>
                <div style="overflow: hidden">
                    <?php get_template_part( 'templates/components/sendMessage' )?>
                    <div class="info-message"></div>
                </div>
                <article class="entry blog-article">
                    <section class="mt-15">
                        <?php echo $post->post_content ?>
                    </section>
                </article>
                <?php get_info_tags('single',$post->ID); ?>

                <div class="chapter underline border-bottom-1 pd-bottom-10">
                <?php
                    // prev
                    get_prev_or_next_post('prev','prev','Prev : ','This is the last news.');
                    // next
                    get_prev_or_next_post('next','next','Next : ','This is the latest news.');
                    ?>
                </div>
                <?php if ( !empty($res_post) ) { ?>
                    <div class="goods-title-bar">
                        <h2 class="title">RELATED NEWS</h2>
                    </div>
                    <div class="mt-15">
                        <div class="tp-list">
                            <?php foreach ($res_post as $item) { ?>
                                <a href="<?php echo get_permalink($item->ID); ?>" class="d-flex tp-list-item">
                                    <div style="margin:0" class="tp-content d-flex flex-coloum justify-content-between">
                                        <div class="">
                                            <div class="d-flex align-items-center mb-1">
                                                <h3 class="tp-content-title ellipsis-1"><?php echo $item->post_title; ?></h3>
                                                <span class="date"><?php echo esc_html( $item->post_date ); ?></span>
                                            </div>
                                            <div class="tp-content-expert ellipsis-4"><?php echo $item->post_excerpt; ?></div>
                                        </div>
                                        <div class="tp-content-btn">
                                            <div class="tp-btn">READ MORE</div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php get_info_tags('',$category->term_id); ?>

            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// main_content end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' )?>
</div>
</body>
<?php get_footer() ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
<script>
    $('.iframe-box iframe').eq(0).on('load',() => {
        $('.iframe-box iframe').eq(0).height($('.iframe-box iframe')[0].contentDocument.body.offsetHeight)
    })
</script>
</html>
