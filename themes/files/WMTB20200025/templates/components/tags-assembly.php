<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'), 'Tag');
if (is_single()) {
    $term_id = ROOT_CATEGORY_CID;
    $tags = get_random_tags($term_id, 5); // 随机获取当前分类的tags
} elseif (is_category()) {
    $category = get_category($cat);
    $tags = get_random_tags($category->term_id, 10);
} elseif (is_tag()) {
    $the_name = single_tag_title('', false);
    $tags = get_terms('post_tag', array('name__like' => "$the_name", 'fields' => 'all'));
}

if (ifEmptyArray($tags) !== []) {
?>
    <div class="side-tit-bar">
        <h2 class="side-tit"><?php echo $sideBarTags ?></h2>
    </div>
    <div class="tags">
        <?php foreach ($tags as $item) { ?>
            <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name ?></a>
        <?php } ?>
    </div>
<?php } ?>