<?php
/**
 * 面包屑微数据
 * 页面类型判断 参考：http://pangbu.com/which-type-of-certain-webpage/
 * get_category_url_and_slug() 获取各级分类url 和 slug 来源: function.php
 * get_lang_page_url() 获取当前页面url 来源: function.php
 * get_lang_home_url() 获取当前页面url 来源: function.php
 * get_post() 全局方法
 * @author zhuoyue
 */
global $wp; // Class_Reference/WP 类实例
// 先判断当前页面类型
if( is_category() ) { // 列表页
    $category_url_array = get_category_url_and_name($cat);
} elseif ( is_single() ) { // 详情页
    $category_url_array = get_category_url_and_name(ROOT_CATEGORY_CID);
} else { // 单页面
    // 当前页面url
    $page_url = get_lang_page_url();
    // 首页url
    $page_name = get_post()->post_title;
    $category_url_array = array(
        array(
            'link' => $page_url,
            'name' => $page_name
        ),
        array(
            'link' => get_full_path(1),
            'name' => 'Home'
        )
    );
}
// 统计数量
$count = count($category_url_array);
?>
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [<?php for ($i = 1;$i<= $count; $i += 1 ) {
        echo '
                {
                    "@type":"ListItem",
                    "position": '.$i.',
                    "item": {
                        "@id": "'.$category_url_array[$count-$i]['link'].'",
                        "name": "'.ucfirst($category_url_array[$count-$i]['name']).'"
                    }
                }
            ';if ($i < $count) { echo ',' ; }
    }
    ?>
        ]
    }
</script>
