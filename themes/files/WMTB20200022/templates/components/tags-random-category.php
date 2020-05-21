<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'),'Tag');

if (is_category()){
    $term_id = get_category($cat)->term_id;
} elseif (is_single()) {
    $term_id = ROOT_CATEGORY_CID;
}
$tags = get_random_tags($term_id,5); // 随机获取当前分类的tags
if ( ifEmptyArray($tags) !== [] ) { ?>
    <div class="tab-content-wrap product-detail">
        <div class="gm-sep tab-title-bar detail-tabs">
            <h2 class="tab-title  title current"><span><?php echo $sideBarTags; ?></span></h2>
        </div>
        <div class="tab-panel-wrap">
            <div class="tab-panel disabled">
                <div class="tab-panel-content entry">
                    <?php foreach ($tags as $item ) { ?>
                        <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
