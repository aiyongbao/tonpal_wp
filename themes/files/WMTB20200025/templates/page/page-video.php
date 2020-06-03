<?php
// video.json -> vars 数据获取
$theme_vars = json_config_array('video', 'vars');
$video_item = ifEmptyArray($theme_vars['items']['value']);
// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'], "$video_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);

$page_data = $video_item;
// 取json数据时分页
function jsonData_page_size()
{
    return 4;
}
function get_jsonData_page($total)
{
    if (empty($total)) return;
    $target = ceil($total / jsonData_page_size());
    if ($target == 1) return;

    echo '<div class="json_page"><ul><li tar="home">HOME</li><li tar="previous" class="j_previous hide">PREVIOUS</li>';
    for ($i = 1; $i <= $target; $i++) {
        if ($i == 1) {
            echo '<li tar="' . $i . '" class="current">' . $i . '</li>';
        } else {
            echo '<li tar="' . $i . '">' . $i . '</li>';
        }
    }
    echo '<li tar="next" class="j_next">NEXT</li><li tar="last">LAST</li></ul></div>';
}

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
    </style>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>

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
                    <header style="margin-bottom: 0.1rem;" class="main-tit-bar">
                        <h1 class="title"><?php echo $video_title ?></h1>
                    </header>
                    <?php if ($video_desc != '') { ?>
                        <p class="class-desc" style="margin-bottom:20px;line-height:1.5"><?php echo $video_desc ?></p>
                    <?php } ?>

                    <div class="items_list page-video" id="json_page_list">
                        <ul class="gm-sep current">
                            <?php $target = count($page_data);
                            for ($i = 0; $i < $target; $i++) {
                                if ($i != 0 && $i != $target - 1 && ($i + 1) % (jsonData_page_size()) == 0) {
                                    echo '</ul><ul class="gm-sep">';
                                }
                                $item = $page_data[$i]; ?>
                                <li class="product-item video-list">
                                    <figure class="item-wrap">
                                        <div class="item-img">
                                            <?php echo $item['iframe'] ?>
                                        </div>
                                        <figcaption class="item-info">
                                            <h3 class="item-title"><?php echo ifEmptyText($item['title']) ?></h3>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php get_jsonData_page(count($page_data)); ?>

                    <?php get_template_part('templates/components/send-message') ?>
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

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>