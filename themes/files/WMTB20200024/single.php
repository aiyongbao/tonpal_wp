<?php
$category = get_the_category();
$cid = $category[0]->cat_ID; // 当前上级id
$pid = get_category_root_id($cid); // 当前顶级id
$parent_category = get_category($pid);
$cat_slug = $parent_category->slug;// 当前顶级分类别名
define("ROOT_CATEGORY_PID",$pid); // 定义常量 ROOT_CATEGORY_PID
define("ROOT_CATEGORY_CID",$cid); // 定义常量 ROOT_CATEGORY_PID
define("ROOT_CATEGORY_SLUG",$cat_slug);// 定义常量 ROOT_CATEGORY_PID

if ($cat_slug === 'product') {
    include('templates/single/single-products.php');
} else if ($cat_slug === 'news') {
    include('templates/single/single-news.php');
} else if ( $cat_slug === 'info-product' ) {
    include('templates/single/single-info-product.php');
} else if ( $cat_slug === 'info-news' ) {
    include('templates/single/single-info-news.php');
} else {
    include('templates/single/single.php');
}
