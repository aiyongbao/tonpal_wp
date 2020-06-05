<?php
global $wp_query;
$sideBarHotProduct = ifEmptyText(get_query_var('sideBarHotProduct'));

// 因为后台系统限制 类目级别为  /顶级 /一级 /二级
if (is_category() || is_single()) {
    $category = get_the_category();
    $parent = $category[0]->parent; // 当前上上级id
    $the_id = $post->ID; // 当前id 用于排除
    if (ROOT_CATEGORY_SLUG == 'product') { // ROOT_CATEGORY_SLUG root/single.php 中定义的常量 -> 当前顶级分类别名
        // 判断当前上上级id 是否是根级id [指定分类id必须为一级id]
        if ($parent == ROOT_CATEGORY_PID) { // ROOT_CATEGORY_PID root/single.php 中定义的常量 -> 当前顶级id
            $hot_product_id = ROOT_CATEGORY_CID; // 如果是,则当前上级id为一级id  ROOT_CATEGORY_CID root/single.php 中定义的常量 -> 当前上级id
        } else {
            $hot_product_id = $parent; // 如果不是，则上上级id为一级id
        }
    } else {
        $hot_product_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
        $the_id = '';
    }
} elseif (is_page()) {
    $hot_product_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    $the_id = '';
}


$recent_posts = get_category_new_product('product', array($the_id), 6, 'ARRAY_A');
if (ifEmptyArray($recent_posts) !== []) {
?>
    <section class="side-widget side-products">
        <div class="side-tit-bar">
            <h4 class="side-tit" style="text-transform:uppercase"><?php echo $sideBarHotProduct ?></h4>
        </div>
        <div class="side-product-items">
        <div class="side-cont side-hide products-scroll-list-wrap">
            <a href="javascript:" class="products-scroll-btn-prev"><b></b></a>
            <div class="products-scroll-list">
                <ul class="gm-sep">
                    <?php
                    foreach ($recent_posts as $recent) {
                        $sub_name = ''; // 产品副标题
                        $thumbnail = get_post_meta($recent["ID"], 'thumbnail', true);
                    ?>
                        <li class="side_product_item">

                            <a href="<?php echo get_permalink($recent["ID"]); ?>">
                                <img src="<?php echo $thumbnail ?>_thumb_262x262.jpg" alt="<?php echo $recent["post_title"]; ?>" />
                            </a>
                            <div class="pd-info">
                                <div class="pd-name">
                                    <a href="<?php echo get_permalink($recent["ID"]); ?>" class="limit-3-line" title="<?php echo $recent["post_title"]; ?>" style="display: -webkit-box;">
                                        <?php echo $recent["post_title"]; ?>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            
            <a href="javascript:" class="products-scroll-btn-next"><b></b></a>
        </div>
    </section>
<?php }  ?>