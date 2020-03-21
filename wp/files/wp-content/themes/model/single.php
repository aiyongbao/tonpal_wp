<?php
$category = get_the_category();
$cid = $category[0]->cat_ID; // 当前上级id
$pid = get_category_root_id($cid); // 当前顶级id
define("ROOT_CATEGORY_PID",$pid);
$parent_category = get_category($pid);
$cat_slug = $parent_category->slug;// 当前顶级分类别名

if ($cat_slug === 'product') {
    include('templates/single/single-products.php');
} else if ($cat_slug === 'news') {
    include('templates/single/single-news.php');
} else {
    include('templates/single/single.php');
}
