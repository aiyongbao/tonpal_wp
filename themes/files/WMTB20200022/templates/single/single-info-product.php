<?php
global $wp; // Class_Reference/WP 类实例

$post = get_post();

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
    $related_posts = get_tags_relevant_product($tags_array[$i], $exclude,'info-product',5); // 根据tag的term_id获取相关产品
    $post_count = count(ifEmptyArray($related_posts)); // 统计获取到的产品数量
    if ($post_count > 0 && $post_count < 5) { // 当统计数在(1,5)时进入下一环节
        $num = 5 - $post_count; // 计算出需要补足的数量
        foreach( $related_posts as $item ) { // 将已获取的产品的id放入排除数组中
            array_push($exclude,$item->ID);
        }
        $recent_posts = get_category_new_product('info-product', $exclude, $num,'OBJECT'); // 获取需要补充的产品
        $res_post = array_merge($related_posts, $recent_posts); // 合并
        break;
    } elseif ($post_count == 5) { // 当计数为5时，已满足条件
        $res_post = $related_posts;
        break;
    }
}
if (empty($res_post)) { // 防止tags搜索不到数据时，补足五条
    $res_post = get_category_new_product('info-product', $exclude, 5, 'OBJECT');
}

// product-detail.json -> vars 数据获取
$theme_vars = json_config_array('header','vars',1);
// Text 数据处理
$productDetail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$productDetail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);
$photos = ifEmptyArray(get_post_meta(get_post()->ID,'photos'));
$photosArray = [];
foreach ($photos as $key=>$item){
    array_push($photosArray,json_decode($photos[$key],true));
}


$prev_post = get_previous_post(true);
$next_post = get_next_post(true);
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

    <!-- OG -->
    <meta property="og:title" content="<?php echo $post->post_title; ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php echo $page_url; ?>" />
    <meta property="og:description" content="<?php echo $seo_description; ?>" />
    <meta property="og:image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />
    <meta property="og:site_name" content="<?php get_host_name(); ?>" />
    <!-- itemprop -->
    <meta itemprop="name" content="<?php echo $post->post_title; ?>" />
    <meta itemprop="description" content="<?php the_excerpt(); ?>" />
    <meta property="image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />
    <!-- Twitter -->
    <meta name="twitter:site" content="@affiliate_<?php get_host_name();; ?>" />
    <meta name="twitter:creator" content="@affiliate_<?php get_host_name(); ?>" />
    <meta name="twitter:title" content="<?php echo $post->post_title; ?>" />
    <meta name="twitter:description" content="<?php echo $seo_description; ?>" />
    <meta name="twitter:image" content="<?php echo ifEmptyText($photosArray[0]['url']); ?>" />

    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .main {
            width: 100%;
        }
        .tags a {
            font-size: .15rem;
            padding: 0 5px;
        }
        .tags {
            font-size: .2rem;
            padding: 10px 0;
        }
        .mt50{
            margin-top: 0;
        }
        .chapter {
            font-size: .2rem;
        }
        .chapter a,.chapter span {
            font-size: .15rem;
        }
        .goods-title-bar {
            margin-bottom: 0px;
            margin-top: 5px;
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
    <div class="main_content">
        <div class="layout">
            <!-- main begin -->
            <section class="main">
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $post->post_title ?></h1>
                </header>
                <div class="iframe-box">
                    <iframe src="/rec-product" style="width:100%;" frameborder="no" scrolling="no"></iframe>
                </div>
                <?php get_template_part( 'templates/components/sendMessage' )?>
                <div class="product-intro">
                    <div class="product-view" style="width:300px;">
                        <div class="product-image" style="width:300px;height:300px;background-color:white;border:1px solid white;">
                            <a class="certificate-fancy" target="_blank" href="<?php echo ifEmptyText($photosArray[0]['url'])?>">
                                <img src="<?php echo ifEmptyText($photosArray[0]['url'])?>" alt="<?php echo ifEmptyText($photosArray[0]['alt'])?>" style="width:100%" />
                            </a>
                        </div>
                        <div class="image-additional">
                            <ul class="image-items">
                                <?php foreach ($photosArray as $key => $item) { ?>
                                    <li class="image-item">
                                        <a href='<?php echo ifEmptyText($item['url'])?>' class='fancy-item' target="_blank" href="javascript:;">
                                            <img src="<?php echo ifEmptyText($item['url'])?>" alt="<?php echo ifEmptyText($item['alt'])?>" />
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <br>
                    </div>
                    <div class="product-summary" style="left:-40px;padding-left:0;">
                        <div class="product-meta">
                            <p><?php echo $post->post_excerpt ?></p>
                        </div>
                        <div class="gm-sep product-btn-wrap">
                            <a href="#myform" class="email"><?php echo $productDetail_inquiry_btn ?></a>
                            <?php if ($pdf !== '' ) { ?>
                                <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $productDetail_download_btn ?></a>
                            <?php } ?>
                        </div>
                        <div class="share-this">
                            <!--share-->
                            <script async src="//platform-api.sharethis.com/js/sharethis.js#property=58cb62ef8263e70012464e1a&product=inline-share-buttons"></script>
                            <div class="sharethis-inline-share-buttons"></div>
                            <!--// share-->
                        </div>
                    </div>
                </div>
                <div class="tab-content-wrap product-detail">
                    <div class="gm-sep tab-title-bar detail-tabs">
                        <h2 class="tab-title  title current "><span>Detail</span></h2>
                    </div>
                    <div class="tab-panel-wrap mb0">
                        <div class="tab-panel disabled">
                            <div class="tab-panel-content entry">
                                <div class="fl-rich-text">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active">
                                            <?php echo $post->post_content ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!empty($the_tags)) { ?>
                    <div class="tags underline">Tags:
                        <?php foreach ($the_tags as $item ) {
                            $tags_name = str_replace("wmtbprefix","",$item->name);
                            ?>
                            <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $tags_name; ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="chapter underline">
                    <?php
                    // prev
                    get_prev_or_next_post('prev','prev','Prev : ','This is the last product.');
                    // next
                    get_prev_or_next_post('next','next','Next : ','This is the latest product.');
                    ?>
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
                                            <a href="<?php echo get_permalink($item->ID); ?>" class="item-more">READ MORE</a>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php get_template_part( 'templates/components/tags-random-category' )?>
            </section>
            <!--// main end -->
        </div>
    </div>
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
    $('.fancy-item').click(function(){
        var imgSrc = $(this).attr('_href');
        $('.certificate-fancy').attr('href',imgSrc);
        $('.certificate-fancy img').attr('src',imgSrc);
    })

    $('.certificate-fancy').fancybox({
        afterLoad : function() {
            //this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
            this.title = this.title ? this.title : '';
        },
        helpers     : {
            title   : { type : 'inside' },
            buttons : {}
        }
    });
</script>
</html>
