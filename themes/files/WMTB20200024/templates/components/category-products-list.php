<?php
$sideBarMenu = ifEmptyText(get_query_var('sideBarMenu'));
$product_id = get_category_by_slug('product')->term_id; // 获取产品顶级id
// 获取一级类目
$data = get_categories( [
    'taxonomy' => 'category',
    'parent' => $product_id,
    'orderby' => 'list_order',
    'order' => 'desc',
] );

// var_dump($data);

$list = [];
if(!empty($data)){
    foreach ($data as $item) {
        $links=get_category_link($item->term_id);
        $name = $item->name;
        // 获取二级类目
        $child = get_categories( [
            'taxonomy' => 'category',
            'parent' => $item->term_id,
            'orderby' => 'list_order',
            'order' => 'desc'
        ] );
        
        $childArray=[];
        if(!empty($child)){
            foreach ($child as $childItem) {
                $childLinks=get_category_link($childItem->term_id);
                $childName = $childItem->name;
                array_push($childArray,array( 'name' => $childName,'link' => $childLinks));
            }
        }
        array_push($list ,array('name' => $name,'link' => $links,'child'=>$childArray));
    }
}
if(ifEmptyArray($list) != []){
?>
<section class="side-widget side-products-list">
    <div class="side-tit-bar">
        <h4 class="side-tit" style="text-transform: uppercase"><?php echo $sideBarMenu ?></h4>
    </div>
    <div class="side-cate side-hide">
    <ul class="side-cate-menu">
       <?php foreach ($list as $item) {
           if(ifEmptyArray($item['child'] != [])) {
           ?>
            <li>
                <a href="<?php echo $item['link'] ?>" onclick="javascript: location.href = '<?php echo $item['link'] ?>';"><?php echo $item['name'] ?></a>
                <ul class="sub-menu" >
                    <?php foreach ($item['child'] as $childItem) { ?>
                        <li ><a href="<?php echo $childItem['link'] ?>"><?php echo $childItem['name'] ?></a></li>
                    <?php }?>
                </ul>
            </li>
           <?php } else { ?>
            <li>
                <a href="<?php echo $item['link'] ?>" title="<?php echo $item['name'] ?>">
                    <?php echo $item['name'] ?>
                </a>
            </li>
        <?php } } ?>
    </ul>
    </div>
</section>
<?php } ?>



