<?php
global $wp; // Class_Reference/WP 类实例
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'),'Tag');

$post = get_post();
$theme_vars = json_config_array('header','vars',1);
$product_detail_download_btn = ifEmptyText($theme_vars['downloadBtn']['value']);
$product_detail_inquiry_btn = ifEmptyText($theme_vars['inquiryBtn']['value']);
$detail_btn = ifEmptyText($theme_vars['detailBtn']['value'],'Products Detail');

// 主图处理
$photos = ifEmptyArray(get_post_meta(get_post()->ID,'photos'));
$photosArray = [];
foreach ($photos as $key=>$item){
    array_push($photosArray,json_decode($photos[$key],true));
}

$sub_title = ifEmptyText(get_post_meta(get_post()->ID,'sub_title',true)); // 分类小标题 预设 后台暂时未有填写位置 注意：当小标题存在时h1标签优先设置


// pdf
$pdf = ifEmptyText(get_post_meta(get_post()->ID,'pdf',true));

// SEO
$seo_title = ifEmptyText(get_post_meta(get_post()->ID,'seo_title',true));
$seo_description = ifEmptyText(get_post_meta(get_post()->ID,'seo_description',true));
$seo_keywords = ifEmptyText(get_post_meta(get_post()->ID,'seo_keywords',true));

// 当前页面url
$page_url = get_lang_page_url();

// 详情筛选
$detailArray=[];
$contentArray = json_decode($post->post_content,true);
foreach ($contentArray as $key => $item ){
    if ($item['content'] !== ''){
        $detailArray[$key]['tabName'] = $item['tabName'];
        $detailArray[$key]['content'] = $item['content'];
    }
}


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

    <style type="text/css">
        .product-detail .tab-panel-content.post-tags{padding-top:0;}
        .product-detail .tab-panel-content.post-tags a{margin-right: 15px;}
        p {
            word-break: break-word;
        }
        .sub-title {
            font-size: 12px;
            color: #999;
        }
        @media only screen and (max-width: 500px){
            .goods-may-like .product-item .item-wrap {
                margin: 0 .11rem;
            }
        }
    </style>

</head>

<body>
<!-- header start -->
<?php get_header() ?>
<!--// header end  -->

<?php get_breadcrumbs();?>
<!-- page-layout start -->
<section class="layout main_content">
    <!-- aside start -->
    <?php get_template_part('templates/components/side-bar'); ?>
    <!--// aside end -->
    <!-- main start -->
    <section class="main">
        <section class="detail-wrap">
            <!-- product info -->
            <section class="product-intro">
                <?php if (!empty($sub_title)) { ?>
                    <h3 class="main-tit-bar"><?php echo $post->post_title ?></h3>
                <?php } else { ?>
                    <h1 class="main-tit-bar"><?php echo $post->post_title ?></h1>
                <?php } ?>
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
                <?php
                $detailArray=[];
                $contentArray = json_decode($post->post_content,true);
                foreach ($contentArray as $key => $item ){
                    if ($item['content'] !== ''){
                        $detailArray[$key]['tabName'] = $item['tabName'];
                        $detailArray[$key]['content'] = $item['content'];
                    }
                }
                ?>
                <div class="gm-sep tab-title-bar detail-tabs">
                    <h2 class="tab-title  title current "><span><?php echo $detail_btn; ?></span></h2>
                </div>
                <section class="tab-panel-wrap">
                    <section class="tab-panel entry">
                        <section class="tab-panel-content">
                            <?php if (count($detailArray) != 1){ ?>
                                <ul class="nav nav-tabs" role="tablist">
                                    <?php foreach ($detailArray as $key => $item ){ ?>
                                        <?php if($key == 0){ ?>
                                            <li role="presentation" class="active">
                                                <a href="#detail_tab<?php echo $key ?>" aria-controls="product-tab" role="tab" data-toggle="tab"><?php echo $item['tabName']; ?></a>
                                            </li>
                                        <?php } else { ?>
                                            <li role="presentation">
                                                <a href="#detail_tab<?php echo $key ?>" aria-controls="product-tab" role="tab" data-toggle="tab"><?php echo $item['tabName']; ?></a>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                                <div class="tab-content">
                                    <?php foreach ($detailArray as $key => $item ){ ?>
                                        <?php if($key == 0){ ?>
                                            <div role="tabpanel" class="tab-pane active" id="detail_tab<?php echo $key ?>">
                                                <?php echo $item['content']; ?>
                                            </div>
                                        <?php } else { ?>
                                            <div role="tabpanel" class="tab-pane" id="detail_tab<?php echo $key ?>"><?php echo $item['content']; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } else {?>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active">
                                        <?php echo $detailArray[0]['content']; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </section>
                    </section>
                </section>
                <?php get_template_part( 'templates/components/tags-random-category' )?>
                <!-- inquiry form -->
                <?php get_template_part( 'templates/components/sendMessage' ); ?>
                <!-- RELATED PRODUCTS -->
                <?php get_template_part( 'templates/components/related-products' )?>
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
<script>
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
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>
