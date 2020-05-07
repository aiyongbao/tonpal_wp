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
    'showposts' => 3,   // 显示相关文章数量
    'orderby'=>'rand',  // 随机获取
    'caller_get_posts' => 1 // 清除置顶
);

$related_posts = query_posts($args);
if(ifEmptyArray($related_posts) !== []){
?>

<div class="col-12 mb-4 component-products-title">
    <div>RELATED PRODUCTS</div>
</div>
<section class="component-products">
    <div class="container">
        <div class="row products-item">
            <?php
            foreach( $related_posts as $item ){
                $sub_name = '';// 产品副标题 优先显示 预设 暂时后台还未有填写的位置
                $thumbnail=get_post_meta($item->ID,'thumbnail',true);
                ?>
                <article class="col-lg-4 col-sm-6 mb-5">
                    <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                        <?php if ( ifEmptyText($thumbnail) !== '' ) { ?>
                            <img class="card-img-top rounded-0" src="<?php echo $thumbnail ?>_thumb_262x262.jpg" alt="<?php echo $item->post_title; ?>">
                        <?php } else {?>
                            <img class="card-img-top rounded-0" src="http://iph.href.lu/350x350?text=350x350" alt="占位图">
                        <?php } ?>
                        <div class="card-body">
                            <a href="<?php echo $item->guid; ?>" target="_blank">
                                <?php if($sub_name !== '') { ?>
                                    <h4 class="card-title"><?php echo $sub_name; ?></h4>
                                <?php } else { ?>
                                    <h4 class="card-title"><?php echo $item->post_title; ?></h4>
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                </article>
                <?php } ?>
        </div>
    </div>
</section>
<?php } wp_reset_query(); // 重置query 防止影响其他query查询 ?>

