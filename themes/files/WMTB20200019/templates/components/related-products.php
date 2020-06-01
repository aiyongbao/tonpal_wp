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
    <section class="index_product">
        <div class="index_hd">
            <div class="layout">
                <h2 class="hd_title"><?php echo $related_products; ?></h2>
            </div>
        </div>
        <div class="index_bd">
            <div class="layout">
                <div class="product_slider">
                    <div class="swiper-container">
                        <ul class="swiper-wrapper product_items">
                            <?php
                            foreach( $related_posts as $key => $item ){
                                $thumbnail=get_post_meta($item->ID,'thumbnail',true);
                                ?>
                                <li class="swiper-slide product_item  wow fadeInLeftA" data-wow-delay=".<?php echo $key+1; ?>s" data-wow-duration=".8s">
                                    <figure>
                                        <span class="item_img">
                                          <img src="<?php echo $thumbnail ?>" alt="<?php echo $item->post_title; ?>" />
                                          <a href="<?php echo get_permalink($item->ID); ?>"></a>
                                        </span>
                                        <figcaption>
                                            <h3 class="item_title"><a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a></h3>
                                        </figcaption>
                                    </figure>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="swiper_control index_swiper_control">
                        <div class="swiper_buttons">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

