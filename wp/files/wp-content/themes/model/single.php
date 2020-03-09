<?php
/**
 * 模板单页面模板
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
get_header(); ?>
 
        <?php
            $category = get_the_category();
            $cid = $category[0]->cat_ID;
            $pid = get_category_root_id($cid);
            $parent_category = get_category($pid);
            $cat_name = $parent_category->slug;
            
            if ( $cat_name === 'products' ) {
                include('templates/single/single-products.php');
            }
            else if ( $cat_name === 'news' ) {
                include('templates/single/single-news.php');
            }
            else{
                include('templates/single/single.php');
            }
        ?>
 
<?php get_footer(); ?>