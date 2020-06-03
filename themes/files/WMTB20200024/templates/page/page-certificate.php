<?php
// certificate.json -> vars 数据获取
$theme_vars = json_config_array('certificate', 'vars');

// Array 数据处理
$certificate_item = ifEmptyArray($theme_vars['item']['value']);
// Text 数据处理
$certificate_title = ifEmptyText($theme_vars['title']['value'], 'certificate');


// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
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
        .product-list {
            margin-top: 20px;
        }

        .product-item.certificate-item {
            width: 29.6% !important;
            box-sizing: border-box;
        }

        .items_list .product-item {
            float: none;
            display: inline-block;
        }

        .product-item.certificate-item .item-img {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 220px;
        }

        .product-item.certificate-item .item-img img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
        }

        .product-item .item-img {
            background: none;
            border-width: 1px;
        }

        .product-item .item-wrap {
            padding: 0;
            width: auto
        }

        .product-list .product-item.certificate-item {
            margin-right: 10px;
        }

        .product-list .product-item.certificate-item:nth-child(3n) {
            margin-right: 0
        }

        .product-item .item-img {
            border: 0 none
        }

        .product-item .item-wrap .item-info {
            margin-top: 10px;
            height: 40px;
            line-height: 20px;
            margin-bottom: 10px;
        }

        .product-item .item-info {
            padding: .05rem 0;
        }

        .product-item .item-info .item-title {
            padding: 0 .1rem;
        }


        @media only screen and (max-width: 768px) {
            .product-item.certificate-item {
                width: 45% !important;
            }

            .product-list .product-item.certificate-item:nth-child(3n) {
                margin-right: 10px
            }

            .product-list .product-item.certificate-item:nth-child(2n) {
                margin-right: 10px
            }

            .product-list ul {
                padding-bottom: 20px;
            }
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
                    <header class="main-tit-bar">
                        <h2 class="title"><?php echo $certificate_title ?></h2>
                    </header>
                    <div class="product-list certificate_list">
                        <ul class="gm-sep" id="wm-page">
                            <?php /*foreach ( $certificate_item as $item ) { ?>
                            <li class="product-item certificate-item">
                                <figure class="item-wrap">
                                    <a href="<?php echo ifEmptyText($item['image'])?>" rel="<?php echo ifEmptyText($item['title'])?>" title="<?php echo ifEmptyText($item['title'])?>" class="item-img certificate-fancy">
                                    <img src="<?php echo ifEmptyText($item['image'])?>" alt="<?php echo ifEmptyText($item['desc'])?>"/>
                                    </a>
                                    <figcaption class="item-info">
                                        <h3 class="item-title limit-2-line" style="text-align: center"><?php echo ifEmptyText($item['title'])?></h3>
                                    </figcaption>
                                </figure>
                            </li>
                            <?php }*/ ?>
                        </ul>
                        <div id="pagination"></div>
                    </div>
                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>
<script type="text/javascript">
    $('.certificate-fancy').fancybox({
        afterLoad: function() {
            //this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
            this.title = this.title ? this.title : '';
        },
        helpers: {
            title: {
                type: 'inside'
            },
            buttons: {}
        }
    });
</script>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>
<!-- 分页 -->
<script>
    var all_data = []; //全部数据
    var current = 1; //当前页码
    var per_page = 10; //每页码数
    var all_page = 1; //总页数
    var render_dom = "wm-page"; //渲染dom
    var pagination = []; //分页数据

    //渲染模板
    var template = `
                            <li class="product-item certificate-item">
                                <figure class="item-wrap">
                                    <a href="<$image/>" rel="<$title/>" title="<$title/>" class="item-img certificate-fancy">
                                    <img src="<$image/>" alt="<$desc/>"/>
                                    </a>
                                    <figcaption class="item-info">
                                        <h3 class="item-title limit-2-line" style="text-align: center"><$title/></h3>
                                    </figcaption>
                                </figure>
                            </li>
            `;


    window.onload = function() {
        console.log("开始")
        all_data = <?php echo json_encode($certificate_item) ?>;
        var key = 0; //分页key
        var temp = [];
        for (var i = 0; i < all_data.length; i++) {
            if (i % per_page > 0) {
                pagination[key].push(all_data[i])
            } else {
                key = i / per_page
                pagination[key] = pagination[key] == "undefined" ? pagination[key] : []
                pagination[key].push(all_data[i])
            }
        }
        all_page = pagination.length //总页数
        pageTo() //初始化渲染
    }

    function pageTo(page = 1) {
        current = page
        rernderHtml(current - 1)
        renderPagination()
    }

    function rernderHtml(page) {
        var html = '';
        var list = pagination[page]
        for (let index = 0; index < list.length; index++) {

            var result_map = {
                "<$image/>": list[index]['image'],
                "<$title/>": list[index]['title'],
                "<$image/>": list[index]['image']
            }

            tem_html = template.replace(/(<\$image\/>)|(<\$title\/>)|(<\$desc\/>)/g, reg => (result_map[reg]));
            html += tem_html

        }
        var parent_dom = document.getElementById(render_dom)
        parent_dom.innerHTML = html
        window.scrollTo(0, 0)
    }

    function renderPagination() {
        let parent_html = `
        <div class="page_bar" style="float:right">
            <div class="pages">
                <a href="javascript:;" onclick="pageTo(1)">Head</a>
                <$page/>
                <a href="javascript:;" onclick="pageTo(` + all_page + `)">Foot</a>
            </div>
        </div>`

        let page_html = ''

        if (current > 1) {
            page = current - 1
            var temp = '<a href="javascript:;" onclick="pageTo(' + page + ')">PREVIOUS</a>'
            page_html += temp
        }

        for (let index = 0; index < pagination.length; index++) {
            let current_class = '';
            if ((index + 1) == current) {
                current_class = "current"
            }
            let page = index + 1
            var temp = '<a class="' + current_class + '" href="javascript:;" onclick="pageTo(' + page + ')">' + page + '</a>'
            page_html += temp
        }

        if (current < all_page) {
            page = current + 1
            var temp = '<a href="javascript:;" onclick="pageTo(' + page + ')">NEXT</a>'
            page_html += temp
        }

        parent_html = parent_html.replace("<$page/>", page_html)

        document.getElementById("pagination").innerHTML = parent_html
    }
</script>

</html>