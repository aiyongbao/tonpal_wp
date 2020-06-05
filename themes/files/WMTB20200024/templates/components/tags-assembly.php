<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'),'Tag');
if( is_single() ) {
    $tags = get_the_tags($post->ID); // 随机获取当前分类的tags
} elseif ( is_category() ) {
    $category = get_category($cat);
    $tags = get_random_tags($category->term_id,10);
} elseif (is_tag()){
    $the_name = single_tag_title('',false);
    $tags = get_terms('post_tag', array('name__like'=> "$the_name",'fields'=>'all'));
}
if ( ifEmptyArray($tags) !== [] ) {
?>
    <section class="side-widget side-tags">
    <div class="side-tit-bar">
        <h2 class="side-tit"><?php echo $sideBarTags ?></h2>
    </div>
    <div class="side-tags-list">
        <?php foreach ($tags as $item ) { ?>
            <a style="margin: 15px 5px 0 0;"class="tags-w2" href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name?></a>
        <?php } ?>
    </div>
    </section>
<?php } ?>
