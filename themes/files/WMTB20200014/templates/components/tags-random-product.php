<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'),'Tag');
if( is_single() ) {
    $tags = get_the_tags( $post->ID );// 获取当前产品的所有tags
} elseif ( is_category() ) {
    $term_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    $tags = get_random_tags($term_id,5);
} else {
    $term_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    $tags = get_random_tags($term_id,10);
}
if ( ifEmptyArray($tags) !== [] ) { ?>
    <div class="tag-box mt-15">
        <h3 class="tag-title"><?php echo $sideBarTags ?>:</h3>
        <div style="margin: 0 -5px" class="tag">
            <?php foreach ($tags as $item ) { ?>
                <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name?></a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
