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

// Text 数据处理
$theme_vars = json_config_array('header','vars',1);
$product_detail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$product_detail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);

// 主图处理
$photos = ifEmptyArray(get_post_meta(get_post()->ID,'photos'));
$photosArray = [];
foreach ($photos as $key=>$item){
    array_push($photosArray,json_decode($photos[$key],true));
}

// pdf
$pdf = ifEmptyText(get_post_meta(get_post()->ID,'pdf',true));


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

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .main {
            width: 100%;
        }
        .product-detail .tab-panel-content.post-tags{padding-top:0;}
        .product-detail .tab-panel-content.post-tags a{margin-right: 15px;}
        @media only screen and (max-width: 500px){
            .goods-may-like .product-item .item-wrap {
                margin: 0 .11rem;
            }
        }
        p {
            word-break: break-word;
        }
        .sub-title {
            font-size: 12px;
            color: #999;
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
        .tab-panel-content a{color:#333;}
        .tab-panel-content a:hover {
            color: #b7045f;
        }
        .main .tab-panel-content.post-tags{padding-top:0; padding-bottom: 10px;}
        .main .tab-panel-content.post-tags a{margin-right: 15px;}

    </style>
</head>

<body>
<!-- header start -->
<?php get_header() ?>
<!--// header end  -->

<?php get_breadcrumbs();?>
<!-- page-layout start -->
<section class="layout main_content">
    <!-- main start -->
    <section class="main">
        <section class="detail-wrap">
            <!-- product info -->
            <section class="product-intro">

                <h1 class="main-tit-bar"><?php echo $post->post_title ?></h1>

                <div class="iframe-box">
                    <iframe src="/rec-product" style="width:100%;" frameborder="no" scrolling="no"></iframe>
                </div>
                <?php get_template_part( 'templates/components/sendMessage' )?>
                <div class="info-message"></div>
                <div class="product-view">
                    <div class="product-image">
                        <a class="certificate-fancy" href="<?php echo ifEmptyText($photosArray[0]['url'])?>">
                            <img src="<?php echo ifEmptyText($photosArray[0]['url'])?>" alt="<?php echo ifEmptyText($photosArray[0]['alt'])?>" style="width:100%" />
                        </a>
                    </div>
                    <div class="image-additional">
                        <ul class="image-items">
                            <?php foreach ($photosArray as $key => $item) { ?>
                                <li>
                                    <a _href='<?php echo ifEmptyText($item['url'])?>' class='fancy-item' >
                                        <img src="<?php echo ifEmptyText($item['url'])?>_thumb_220x220.jpg" alt="<?php echo ifEmptyText($item['alt'])?>" />
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <br>
                </div>
                <section class="product-summary">
                    <div class="product-meta">
                        <?php if (!empty($sub_title)) { ?>
                            <h1 class="sub-title"><?php echo $sub_title; ?></h1>
                        <?php } ?>
                        <p><?php echo $post->post_excerpt ?></p>
                    </div>
                    <div class="gm-sep product-btn-wrap">
                        <a href="#contact-form" class="email"><?php echo $product_detail_inquiry_btn ?></a>
                        <?php if ($pdf !== '' ) { ?>
                            <a class="pdf" href="<?php echo $pdf ?>" download="<?php echo $post->post_title ?>"><?php echo $product_detail_download_btn ?></a>
                        <?php } ?>
                    </div>
                    <div class="share-this">
                        <!--share-->
                        <script async src="//platform-api.sharethis.com/js/sharethis.js#property=58cb62ef8263e70012464e1a&product=inline-share-buttons"></script>
                        <div class="sharethis-inline-share-buttons"></div>
                        <!--// share-->
                    </div>
                </section>
            </section>
            <section class="tab-content-wrap product-detail">
                <div class="gm-sep tab-title-bar detail-tabs">
                    <h2 class="tab-title  title current "><span>Detail</span></h2>
                </div>
                <section class="tab-panel-wrap">
                    <section class="tab-panel entry">
                        <section class="tab-panel-content">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active">
                                    <?php echo $post->post_content ?>
                                </div>
                            </div>
                        </section>
                    </section>
                </section>
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
                    <div class="gm-sep tab-title-bar detail-tabs">
                        <h2 class="tab-title  title current">RELATED NEWS</h2>
                    </div>
                    <div class="blog_list mb-10">
                        <ul>
                            <?php foreach ($res_post as $item) { ?>
                                <li class="blog-item">
                                    <figure class="item-wrap">
                                        <figcaption class="item-info">
                                            <h3 class="item-title"><a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a></h3>
                                            <time datetime="<?php echo esc_html( $item->post_date ); ?>"><?php echo esc_html( $item->post_date ); ?></time>
                                            <div class="item-detail limit-3-line"><?php echo $item->post_excerpt; ?></div>
                                            <a href="<?php echo get_permalink($item->ID); ?>" class="item-more" style="margin-top: 10px;">READ MORE</a>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php get_info_tags('',$category->term_id); ?>
            </section>
        </section>
        <div class="clear"></div>
    </section>
    <!--// sendMessage -->
    <div class="clear"></div>
    <!--// main end -->
</section>
<!--// page-layout end -->
<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>

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
            this.title = this.title ? this.title : '';
        },
        helpers     : {
            title   : { type : 'inside' },
            buttons : {}
        }
    });

    $(function(){
        setClass();
        $(window).resize(function(){
            setClass();
        })
    })
    function setClass(){
        var winWidth = $(window).width()
        if(winWidth>767){
            $('.image-additional .image-items li .fancy-item').removeClass('certificate-fancy')
        }else{
            $('.image-additional .image-items li .fancy-item').addClass('certificate-fancy')
        }
    }
</script>
</html>
