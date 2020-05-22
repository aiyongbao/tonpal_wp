<?php
/**
 * 相关产品模块
 * get_the_tags() 根据当前详情的id获取所有相关的tags数据
 * get_category_by_slug() 根据 slug 获取对应分类信息
 * @author zhuoyue
 */
$tags = get_the_tags( $post->ID );
$tags_array = [];
foreach ($tags as $item ) {
    array_push($tags_array,$item->term_id);
}
$tag_id = $tags_array[ mt_rand(0, count($tags_array) - 1) ]; // 随机读取一个tags id
$hot_product_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
$args = array(
    'tag__in' => array($tag_id),  // 限定条件 包含所有的tags的id
    'cat' => $hot_product_id,   // 指定分类ID
    'post__not_in' => array($post->ID), // 祛除当前id
    'showposts' => 5,   // 显示相关文章数量
    'orderby'=>'rand',  // 随机获取
    'caller_get_posts' => 1 // 清除置顶
);

$related_posts = query_posts($args);
wp_reset_query(); // 重置query 防止影响其他query查询
if(ifEmptyArray($related_posts) !== []){
    // header.json
    $theme_vars_header = json_config_array('header','vars',1);
    $related_products = ifEmptyText($theme_vars_header['relatedProducts']['value'],'RELATED PRODUCTS');
    ?>
    <section class="goods-may-like">
        <div class="goods-tbar">
            <h2 class="title" style="text-transform:uppercase"><?php echo $related_products; ?></h2>
        </div>
        <section class="goods-items-wrap">
            <section class="goods-items">
                <?php
                foreach( $related_posts as $key => $item ){
                    $thumbnail = get_post_meta($item->ID,'thumbnail',true);
                    ?>
                    <div class="product-item related-box">
                        <div class="item-wrap">
                            <div class="pd-img">
                                <a href="<?php echo get_permalink($item->ID); ?>" class="related-prod-link">
                                    <img style="width: 100%" src="<?php echo $thumbnail ?>_thumb_220x220.jpg" alt="<?php echo $item->post_title; ?>"/>
                                </a>
                            </div>
                            <div class="pd-info">
                                <h3 class="pd-name" style="font-weight: normal;">
                                    <a href="<?php echo get_permalink($item->ID); ?>" class="limit-2-line"><?php echo $item->post_title; ?></a>
                                </h3>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </section>
    </section>
<?php } ?>

