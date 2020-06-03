<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video','vars');

// Array 数据处理
$video_item = ifEmptyArray($theme_vars['item']['value']);

// Text 数据处理
$video_title = ifEmptyText($theme_vars['title']['value'],'video');
$video_desc = ifEmptyText($theme_vars['desc']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$video_title");
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
    <style>
        .video-box figure iframe {
            width: 100%;
            height: 100%;
        }
        .video-box .desc p {
            height: 56px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }
        .product-item .item-wrap {
            position: relative;
            width: 100%;
            overflow: hidden;
}
        
    </style>
    <style type="text/css">
.product-list{margin-top:20px;}
  .product-item.video-list {
      width: 45%;
      box-sizing: border-box;
  }
  .product-item.video-list .item-img img {
      visibility: hidden;
  }
  .product-item.video-list .item-img{
      position: relative;
  }
  .video-list .item-img iframe{
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      height: 100%;
  }
  .product-list .product-item.video-list{
    margin-right: 10px;
  }
  .product-list .product-item.video-list:nth-child(2n){margin-right: 0}
  .product-item .item-wrap{width: 100% !important}
  .product-item .item-wrap .item-info{margin-top:10px;  line-height: 20px; margin-bottom: 10px;}
  @media only screen and (max-width: 768px){
    .product-list .product-item.video-list {
        margin-right: 0;
        width: 49% !important;
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
    <section class="page-layout">
    <section class="layout"> 
            <!--  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->
            <!-- main begin -->
            <section class="main">
                <div class="main-tit-bar">
                    <h2 class="title"><?php echo $video_title ?></h2>
                </div>
                <?php if($video_desc != ''){ ?>
                    <p class="class-desc" style="margin-bottom:20px;line-height:1.5"><?php echo $video_desc ?></p>
                <?php } ?>
                <section class="product-list">
                    <ul class="gm-sep" id="wm-page">
                        <?php /*foreach ($video_item as $item) { ?>
                        <li class="product-item video-list">
                            <figure class="item-wrap">
                                <div class="item-img">
                                <iframe src='<?php echo ifEmptyText($item['iframe']) ?>' frameborder="0" allowfullscreen></iframe>
                                <img style="width:450px;height:250px" src="<?php echo ifEmptyText($item['images']) ?>" alt="" />     
                                </div>
                                <figcaption class="item-info">
                                    <h3 class="item-title" style="text-align: center"><a class="limit-1-line"><?php echo ifEmptyText($item['title']) ?></a></h3>
                                </figcaption>
                            </figure>
                        </li>
                        <?php } */?>
                    </ul>
                    <div id="pagination"></div>
                </section>
                
            </section>
            <!--// main end -->
            </section>
  </section>
    <!--// main_content end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>

<?php get_footer(); ?>
<script>

</script>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
<!-- 分页 -->
<script>
    var all_data = []; //全部数据
    var current = 1;   //当前页码
    var per_page = 4; //每页码数
    var all_page = 1;  //总页数
    var render_dom = "wm-page"; //渲染dom
    var pagination = []; //分页数据
    
    //渲染模板
    var template = `
    <li class="product-item video-list">
                            <figure class="item-wrap">
                                <div class="item-img" style="width:450px;height:250px">
                                <div style="frameborder="0" allowfullscreen ">
                                <$iframe/>
                                </div>
                                <img style="width:450px;height:250px" src="<$images/>" alt="" />     
                                </div>
                                <figcaption class="item-info">
                                    <h3 class="item-title" style="text-align: center"><a class="limit-1-line"><$title/></a></h3>
                                </figcaption>
                            </figure>
                        </li>
            `;


    window.onload = function() {
        console.log("开始")
        all_data = <?php echo json_encode($video_item) ?>;
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
                "<$iframe/>": list[index]['iframe'],
                "<$title/>": list[index]['title'],
                "<$images/>": list[index]['images']
            }

            tem_html = template.replace(/(<\$title\/>)|(<\$iframe\/>)|(<\$images\/>)/g, reg => (result_map[reg]));
            html += tem_html

        }
        var parent_dom = document.getElementById(render_dom)
        parent_dom.innerHTML = html
        window.scrollTo(0,0)
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

