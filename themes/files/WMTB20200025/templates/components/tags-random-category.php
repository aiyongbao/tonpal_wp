<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'), 'Tag');

if (is_category()) {
    $term_id = get_category($cat)->term_id;
} elseif (is_single()) {
    if (ROOT_CATEGORY_SLUG == 'product') {
        $term_id = ROOT_CATEGORY_CID;// 父级ID
    } else {
        $term_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
    }
}
$tags = get_random_tags($term_id, 5); // 随机获取当前分类的tags
if (ifEmptyArray($tags) !== []) { ?>
    <div class='random_tags'>
        <h2 class='tags_title'><span><?php echo $sideBarTags; ?></span></h2>
        <?php foreach ($tags as $item) { ?>
            <a href="<?php echo get_tag_link($item->term_id) ?>" class='tags_item'><?php echo $item->name ?></a>
        <?php } ?>
    </div>
<?php } ?>