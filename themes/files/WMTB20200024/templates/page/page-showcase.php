<?php
// showcase.json -> vars 数据获取
$theme_vars = json_config_array('showcase','vars');

// Array 数据处理
$showcase_item = ifEmptyArray($theme_vars['item']['value']);
// Text 数据处理
$showcase_title = ifEmptyText($theme_vars['title']['value'],'showcase');
$showcase_desc = ifEmptyText($theme_vars['desc']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$showcase_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <?php get_template_part('templates/components/head'); ?>
    <style type="text/css">
    .product-item {
	position: relative;
}

.product-item::before {
	content: '';
	position: absolute;
	top:2%;
	left: 8px;
	width: 5px;
	height: 95%;
	background-color:#e7ebed;
}
.product-list{margin-top:20px;}
.product-list .product-item{width:270px; margin-right: 0}
.product-item .item-wrap{width: 100%}
.product-item .item-img img{width: 100%}
  .product-item .item-wrap .item-info{margin-top:10px; height:40px; line-height: 20px; margin-bottom: 10px;}
  @media screen and (max-width: 630px){
    .product-list .product-item {
        width: 98%;
        margin-bottom: 20px !important;
        padding-left:10px;
        break-inside: avoid;
    }
  }
  .product-list ul {
    position: relative;
    width: 100%;
}
.main .product-item{
    padding-left:33px;
    break-inside: avoid;
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
            <section class="main" >
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $showcase_title ?></h1>
                </header>
                <?php if($showcase_desc != ''){ ?>
                    <p class="class-desc" style="margin-top: 10px;line-height:1.5"><?php echo $showcase_desc ?></p>
                <?php } ?>
                <div class="product-list case_list">
                <ul class="gm-sep showcase-list" id="masonry" style="column-count: 3; column-gap: 1px;">
                        <?php foreach ($showcase_item as $item) { ?>
                            <li class="product-item" >
                            <figure class="item-wrap">
                                <a  href="<?php echo ifEmptyText($item['image']) ?>" rel='<?php echo ifEmptyText($item['title']) ?>' title="<?php echo ifEmptyText($item['title']) ?>" class="item-img certificate-fancy">
                                <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title'])?>" />
                                </a>
                                <figcaption class="item-info">
                                <h3 class="item-title" style="text-align: center"><a href="" class="limit-2-line"><?php echo ifEmptyText($item['title']) ?></a></h3>
                                </figcaption>
                            </figure>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
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
<script type="text/javascript">
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
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

