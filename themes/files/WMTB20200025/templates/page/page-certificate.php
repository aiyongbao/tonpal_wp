<?php
// picturewell.json -> vars 数据获取
$theme_vars = json_config_array('certificate', 'vars');
$picturewell_item = ifEmptyArray($theme_vars['items']['value']);
$picturewell_title = ifEmptyText($theme_vars['title']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">
<style>
    .items_list .product_item .item_img a {
        pointer-events: none !important;
    }

    .items_list .product_item .item_img a:after {
        z-index: 1000 !important;
        pointer-events: auto !important;
        background-image: url("<?php echo get_template_directory_uri() ?>/assets/image/ceerificate-open.png") !important;
    }

    /* 点开图片遮罩 */
    #image_shadow {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #101010;
        opacity: 0.9;
        cursor: pointer;
        z-index: 1000;
        display: none;
    }

    #image_shadow .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1001;
        border-width: 10px;
        width: 1024px;
        height: 683px;
        background-color: #fff;
        padding: 10px;
        border-radius: 3px;
        opacity: 1;
    }

    #image_shadow .content a {
        position: absolute;
        top: -15px;
        right: -15px;
        z-index: 1002;
        width: 30px;
        height: 30px;
        background: transparent url("<?php echo get_template_directory_uri() ?>/assets/image/fancybox.png") -40px 0px;
    }

    #image_shadow .content img {
        height: 100%;
        width: auto;
        display: block;
        margin: 0 auto;
    }
</style>


<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />
    
    <?php get_template_part('templates/components/head'); ?>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->

        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->

                <!-- main begin -->
                <section class="main">
                    <header class="main-tit-bar">
                        <h1 class="title"><?php echo $picturewell_title ?></h1>
                    </header>

                    <div class="items_list page-certificate">
                        <ul class="gm-sep" id="wm-page">
                        </ul>
                        <div id="pagination"></div>
                    </div>

                    <div class='page-certificate-send-message'>
                        <?php get_template_part('templates/components/send-message') ?>
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

<div id="image_shadow">
    <div class="content"><a href="javascript:;"></a><img src="" alt=""></div>
</div>

<?php get_footer(); ?>

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>


<script>
    // 弹出
    $('body').on('click', '.product_item .item_img .certificate-fancy', function() {
        let src = $(this).next().attr('src')
        $('#image_shadow').show()
        $('#image_shadow img').attr('src', src)
    })
    // 关闭
    $('#image_shadow a').on('click', function() {
        $('#image_shadow').hide()
    })
</script>

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
        <li class="product_item">
            <figure class="item-wrap">
                <span class='item_img'>
                    <a href="javascript:;" class="certificate-fancy" rel="$title" title="$title"></a>
                    <img src="$image" alt="$desc" title="$title" />
                </span>
                <figcaption>
                    <h3 class="item_title">
                        <a href="">$title</a>
                    </h3>
                    <p>$desc</p>
                </figcaption>
            </figure>
        </li>
            `;

    window.onload = function() {
        console.log("开始")
        all_data = <?php echo json_encode($picturewell_item) ?>;
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
                "$title": list[index]['title'],
                "$image": list[index]['image'],
                "$desc": list[index]['desc']
            }

            tem_html = template.replace(/(\$title)|(\$image)|(\$desc)/g, reg => (result_map[reg]));
            html += tem_html

        }
        var parent_dom = document.getElementById(render_dom)
        parent_dom.innerHTML = html
        window.scrollTo(0, 0)
    }

    function renderPagination() {
        let parent_html = `
        <div class="page_bar">
            <div class="pages">
                <a href="javascript:;" onclick="pageTo(1)">HOME</a>
                <$page/>
                <a href="javascript:;" onclick="pageTo(` + all_page + `)">LAST</a>
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