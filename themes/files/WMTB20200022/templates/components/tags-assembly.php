<?php
$sideBarTags = ifEmptyText(get_query_var('sideBarTags'));
$tags = [];
if( is_single() ) {
    $tags = get_the_tags( $post->ID );
} elseif ( is_category() ) {
    $category = get_category($cat);
    $tags = get_random_tags($category->term_id,10);
} elseif (is_tag()){
    $the_name = single_tag_title('',false);
    $tags = get_terms('post_tag', array('name__like'=> "$the_name",'fields'=>'all'));
}

if ( ifEmptyArray($tags) !== [] ) {
?>
    <div class="side-tit-bar">
        <h2 class="side-tit"><?php echo $sideBarTags ?></h2>
    </div>
    <div class="side-tags">
        <?php foreach ($tags as $item ) { ?>
            <a href="<?php echo get_tag_link($item->term_id) ?>"><?php echo $item->name?></a>
        <?php } ?>
    </div>
<?php } ?>