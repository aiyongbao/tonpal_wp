<?php
// showcase.json -> vars 数据获取
$theme_vars = json_config_array('showcase', 'vars');

// Array 数据处理
$showcase_items = ifEmptyArray($theme_vars['items']['value']);
$showcase_title = ifEmptyText($theme_vars['title']['value'],'Showcase');
$showcase_desc = ifEmptyText($theme_vars['desc']['value']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'], "$showcase_title");
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
        .items_list .product-item {
            margin-bottom: 0;
            width: 300px;
        }
        @media screen and (max-width: 630px){
            .items_list.case_list .product-item {
                width: 100%;
            }
        }
    </style>
</head>

<body>
<!-- header start -->
<?php get_header() ?>
<!--// header end  -->
<!-- path -->
<?php get_breadcrumbs();?>
<!-- main_content start -->
<div class="layout main_content">
    <!--  aside start -->
    <?php get_template_part('templates/components/side-bar'); ?>
    <!--// aside end -->
    <!-- main begin -->
    <section class="main">
        <div class="main-tit-bar">
            <h1 class="title"><?php echo $showcase_title; ?></h1>
        </div>
        <?php if(!empty($showcase_desc)){ ?>
            <p class="class-desc" style="margin-bottom:20px;line-height:1.5"><?php echo $showcase_desc; ?></p>
        <?php } ?>
        <div class="items_list case_list">
            <ul class="gm-sep showcase-list" id="masonry">
                <?php foreach ($showcase_items as $item) { ?>
                    <li class="product-item">
                        <figure class="item-wrap">
                            <a href="<?php echo ifEmptyText($item['image']) ?>" rel='<?php echo ifEmptyText($item['title']) ?>' title="<?php echo ifEmptyText($item['title']) ?>" class="item-img certificate-fancy">
                                <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title'])?>" />
                            </a>
                            <figcaption class="item-info">
                                <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                            </figcaption>
                        </figure>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>
    <div class="clear"></div>
    <!--// main end -->
</div>
<!--// main_content end -->
<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>
<!--  footer end -->
</body>

<?php get_footer(); ?>
<script type="text/javascript">
    $('.certificate-fancy').fancybox({
        afterLoad : function() {
            this.title = this.title ? this.title : '';
        },
        helpers     : {
            title   : { type : 'inside' },
            buttons : {}
        }
    });

    $(function() {
        var $objbox = $("#masonry");
        var gutter = 25;
        var centerFunc, $top0;
        $objbox.imagesLoaded(function() {
            $objbox.masonry({
                itemSelector: "#masonry > li",
                gutter: gutter,
                isAnimated: true
            });
            centerFunc = function() {
                $top0 = $objbox.children("[style*='top: 0']");
                //$objbox.css("left", ($objbox.width() - ($top0.width() * $top0.length + gutter * ($top0.length - 1))) / 2).parent().css("overflow", "hidden");
            };
            centerFunc();
        });
        var tur = true;
        $(window).resize(function() {
            if (tur) {
                setTimeout(function() {
                        tur = true;
                        centerFunc();
                    },
                    1000);
                tur = false;
            }
        });
    });
</script>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>