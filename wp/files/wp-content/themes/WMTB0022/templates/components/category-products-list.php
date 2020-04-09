<?php
$sideBarMenu = ifEmptyText(get_query_var('sideBarMenu'));

$data = get_categories( [
    'taxonomy' => 'category',
    'parent' => '1'
] );
//print_r($wp_query);
//print_r($data);
$list = [];
if(!empty($data)){
    foreach ($data as $item) {
        $links=get_category_link($item->term_id);
        $name = $item->name;
        $child = get_categories( [
            'taxonomy' => 'category',
            'parent' => $item->term_id
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
//wp_reset_query(); // 重置query 防止影响其他query查询
if(ifEmptyArray($list) != []){
?>

    <div class="side-tit-bar">
        <h2 class="side-tit"><?php echo $sideBarMenu ?></h2>
    </div>
    <ul class="side-cate">
       <?php foreach ($list as $item) {
           if(ifEmptyArray($item['child'] != [])) {
           ?>
            <li>
                <a href="<?php echo $item['link'] ?>" onclick="javascript: location.href = '<?php echo $item['link'] ?>';"><?php echo $item['name'] ?></a>
                <ul class="sub-menu">
                    <?php foreach ($item['child'] as $childItem) { ?>
                        <li><a href="<?php echo $childItem['link'] ?>"><?php echo $childItem['name'] ?></a></li>
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
<?php } ?>