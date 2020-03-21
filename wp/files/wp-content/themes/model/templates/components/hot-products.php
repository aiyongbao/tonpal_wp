<?php
// 因为后台系统限制 类目级别为  /顶级 /一级 /二级
$category = get_the_category();
$parent = $category[0]->parent;// 当前上上级id
$the_id = $post->ID; // 当前id 用于排除
$the_slug= get_category(ROOT_CATEGORY_PID)->slug;// 当前顶级分类别名
if($the_slug == 'product') {
    if($parent == ROOT_CATEGORY_PID ) {
        $hot_product_id = $cid;
    } else {
        $hot_product_id = $parent;
    }
} else {
    $hot_product_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    $the_id = '';
}

$args = array(
    'numberposts' => 3, // 显示个数
    'offset' => 0,
    'category' => $hot_product_id,
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
if(ifEmptyArray($recent_posts) !== []){
?>
<div class="col-12 mb-4 tags-title">
    <div>HOT PRODUCTS</div>
</div>
    <section class="component-products">
    <div class="container">
        <div class="row products-item">
            <?php
                foreach( $recent_posts as $recent ){
                    $sub_name = '';// 产品副标题
                    $thumbnail=get_post_meta($recent["ID"],'thumbnail',true);
            ?>
                <article class="col-lg-4 col-sm-6 mb-5">
                    <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                        <?php if ( ifEmptyText($thumbnail) !== '' ) { ?>
                            <img class="card-img-top rounded-0" src="<?php echo $thumbnail ?>_thumb_262x262.jpg" alt="<?php echo $recent["post_title"]; ?>">
                        <?php } else {?>
                            <img class="card-img-top rounded-0" src="http://iph.href.lu/350x350?text=350x350" alt="占位图">
                        <?php } ?>
                        <div class="card-body">
                            <a href="<?php echo get_permalink($recent["ID"]); ?>" target="_blank">
                                <?php if($sub_name !== '') { ?>
                                    <h4 class="card-title"><?php echo $sub_name; ?></h4>
                                <?php } else { ?>
                                    <h4 class="card-title"><?php echo $recent["post_title"]; ?></h4>
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                </article>
            <?php
                }
            wp_reset_query();
                ?>
        </div>
    </div>
</section>
<?php } ?>