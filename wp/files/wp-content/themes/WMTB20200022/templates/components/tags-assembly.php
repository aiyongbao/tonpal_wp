<?php
global $cat;
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'));

$the_name = '';
$tag = [];
if( is_single() ) {
    $tags = get_the_tags( $post->ID );
    $tags_array = [];
    if(!empty($tags)) {
        foreach ($tags as $item ) {
            array_push($tags_array,$item->name);
        }
        $the_name = $tags_array[ mt_rand(0, count($tags_array) - 1) ]; // 随机读取一个tag name
    }
} elseif ( is_category() ) {
    $category = get_category($cat);
    $the_name = $category->name; //当前分类名称
} elseif (is_tag()){
    $tagName = single_tag_title('',false);
    $the_name = $tagName; //当前分类名称
}
if (ifEmptyText($the_name)) {
    $tag = get_terms('post_tag', array('name__like'=> "$the_name",'fields'=>'all'));

}
if ( ifEmptyArray($tag) !== [] ) {
?>
    <div class="side-tit-bar">
        <h2 class="side-tit"><?php echo $sideBarTags ?></h2>
    </div>
    <div class="side-tags">
        <?php foreach ($tag as $item ) { ?>
            <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name?></a>
        <?php } ?>
    </div>
<?php } ?>