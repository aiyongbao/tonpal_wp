<?php
// picturewell.json -> vars 数据获取
$theme_vars = json_config_array('certificate', 'vars');

// Array 数据处理
$certificate_items = ifEmptyArray($theme_vars['items']['value']);
// Text 数据处理
$certificate_title = ifEmptyText($theme_vars['title']['value'], 'certificate');
$products_bg = ifEmptyText($theme_vars['bg']['value']);
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

</head>

<body>
    <div class="container">
        <!-- web_head start -->
        <?php get_header() ?>
        <!--// web_head end -->
        <?php if (!empty($products_bg)) { ?>
            <div class="page_bg" style='background: url("<?php echo $products_bg; ?>") fixed no-repeat center center'>
            </div>
        <?php } ?>
        <!-- path -->
        <?php get_breadcrumbs(); ?>
        <!-- main_content start -->
        <section class="web_main page_main">
            <div class="layout certificate">
                <!--// main start -->
                <section class="main certificate">
                    <header>
                        <h1 class="about-title"><?php echo $certificate_title ?></h1>
                    </header>
                    <ul id="wm-page" class="certificate-ul">
                        <?php /* foreach ($certificate_items as $item) { ?>
                            <li class="certificate-li">
                                <div class="certificate-card">
                                    <figure class="item-image">
                                        <a href="<?php echo ifEmptyText($item['image']) ?>" target="_blank" rel="<?php echo ifEmptyText($item['title']) ?>" title="<?php echo ifEmptyText($item['title']) ?>" class="item-img certificate-fancy">
                                            <img src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['desc']) ?>" title="<?php echo ifEmptyText($item['title']) ?>" />
                                        </a>
                                    </figure>
                                    <div class="item-info">
                                        <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                    </div>
                                </div>
                            </li>
                        <?php }*/ ?>
                    </ul>
                    
                    <div id="pagination"></div>

                    <?php get_template_part('templates/components/sendMessage') ?>
                    <?php get_template_part('templates/components/tags-random-product'); ?>
                </section>
                <!--// main end -->
            </div>
        </section>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>
<?php get_footer(); ?>


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
    <li class="certificate-li">
        <div class="certificate-card">
            <figure class="item-image">
                <a href="$image" target="_blank" rel="$title" title="$title" class="item-img certificate-fancy">
                    <img src="$image" alt="$desc" title="$title" />
                </a>
            </figure>
            <div class="item-info">
                <h3 class="item-title">$title</h3>
            </div>
        </div>
    </li>
            `;


    window.onload = function() {
        console.log("开始")
        all_data = <?php echo json_encode($certificate_items) ?>;
        var key = 0; //分页key
    
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

    //跳转
    function pageTo(page = 1) {
        current = page
        rernderHtml(current - 1)
        renderPagination()
    }

    //渲染列表页
    function rernderHtml(page) {
        var html = '';
        var list = pagination[page]
        for (let index = 0; index < list.length; index++) {

            var result_map = {
                "$title": list[index]['title'],
                "$image": list[index]['image'],
                "$desc": list[index]['desc']
            }

            var tem_html = template.replace(/(\$image)|(\$title)|(\$desc)/g, reg => (result_map[reg]));
            html += tem_html

        }
        var parent_dom = document.getElementById(render_dom)
        parent_dom.innerHTML = html
        window.scrollTo(0, 0)
    }

    //渲染分页按钮
    function renderPagination() {
        let parent_html = `
        <div class="page_bar">
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