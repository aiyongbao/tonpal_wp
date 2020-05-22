<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'),'Tag');
if( is_single() ) {
    $tags = get_the_tags( $post->ID );// 获取当前产品的所有tags
} elseif ( is_category() ) {
    $category = get_category($cat);
    $tags = get_random_tags($category->term_id,10);
} elseif (is_tag()){
    $the_name = single_tag_title('',false);
    $tags = get_terms('post_tag', array('name__like'=> "$the_name",'fields'=>'all'));
} else {
    $term_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    $tags = get_random_tags($term_id,10);
}

if ( ifEmptyArray($tags) !== [] ) {
?>
    <div class="side-tit-bar">
        <h2 class="side-tit"><?php echo $sideBarTags ?></h2>
    </div>
    <div class="side-tags-list">
        <?php foreach ($tags as $item ) { ?>
            <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name?></a>
        <?php } ?>
    </div>
<?php } ?>