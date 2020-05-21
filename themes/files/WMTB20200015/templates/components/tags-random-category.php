<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'),'Tag');
if (is_category()){
    $term_id = get_category($cat)->term_id;
    $pid = get_category_root_id($term_id);
    $the_slug = get_category($pid)->slug;
    if ($the_slug == 'news') {
        $term_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    }
} elseif (is_single()) {
    $term_id = ROOT_CATEGORY_CID;
}
$tags = get_random_tags($term_id,5); // 随机获取当前分类的tags
if ( ifEmptyArray($tags) != [] ) { ?>
    <div class="tag-box mt-15">
        <h3 class="tag-title mb-10"><?php echo $sideBarTags ?>:</h3>
        <div class="tag ">
            <?php foreach ($tags as $item ) { ?>
                <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name?></a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
