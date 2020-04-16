<?php
global $wp_query;
$sideBarHotProduct = ifEmptyText(get_query_var('sideBarHotProduct'));

// 因为后台系统限制 类目级别为  /顶级 /一级 /二级
if ( is_category() || is_single()) {
    $category = get_the_category();
    $parent = $category[0]->parent;// 当前上上级id
    $the_id = $post->ID; // 当前id 用于排除
    if(ROOT_CATEGORY_SLUG == 'product') { // ROOT_CATEGORY_SLUG root/single.php 中定义的常量 -> 当前顶级分类别名
        // 判断当前上上级id 是否是根级id [指定分类id必须为一级id]
        if($parent == ROOT_CATEGORY_PID ) { // ROOT_CATEGORY_PID root/single.php 中定义的常量 -> 当前顶级id
            $hot_product_id = ROOT_CATEGORY_CID; // 如果是,则当前上级id为一级id  ROOT_CATEGORY_CID root/single.php 中定义的常量 -> 当前上级id
        } else {
            $hot_product_id = $parent;// 如果不是，则上上级id为一级id
        }
    } else {
        $hot_product_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
        $the_id = '';
    }
} elseif (is_page()) {
    $hot_product_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    $the_id = '';

}

$args = array(
    'numberposts' => 6, // 显示个数
    'offset' => 0,
    'category' => 1, // 指定需要返回哪个分类的文章
    'orderby' => 'post_date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => $the_id,// 排除
    'meta_key' => '',
    'meta_value' =>'',
    'post_type' => 'post',
    'post_status' => 'publish',// 公开的文章
    'suppress_filters' => true
);
$recent_posts = wp_get_recent_posts($args,'ARRAY_A');
wp_reset_query(); // 重置query 防止影响其他query查询
if(ifEmptyArray($recent_posts) !== []){
?>
    <div class="side-tit-bar">
        <h2 class="side-tit"><?php echo $sideBarHotProduct ?></h2>
    </div>
    <div class="side-product-items">
        <span class="btn-prev"></span>
        <div class="items_content">
            <ul class="gm-sep">
                <?php
                foreach( $recent_posts as $recent ){
                    $sub_name = '';// 产品副标题
                    $thumbnail=get_post_meta($recent["ID"],'thumbnail',true);
                    ?>
                    <li class="side_product_item">
                        <figure>
                            <a href="<?php echo get_permalink($recent["ID"]); ?>" class="item-img">
                                <img src="<?php echo $thumbnail ?>_thumb_262x262.jpg" alt="<?php echo $recent["post_title"]; ?>" />
                            </a>
                            <figcaption>
                                <a href="<?php echo get_permalink($recent["ID"]); ?>" title="<?php echo $recent["post_title"]; ?>">
                                    <?php echo $recent["post_title"]; ?>
                                </a>
                            </figcaption>
                        </figure>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <span class="btn-next"></span>
    </div>
</section>
<?php }  ?>