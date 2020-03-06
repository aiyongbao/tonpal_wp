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
            $category = get_category(get_category_root_id($cat));
            $slug = $category->name;
            if ( $slug === 'products' ) {
                include('templates/single/single-products.php');
            }
            else if ( $slug === 'news' ) {
                include('templates/single/single-news.php');
            }
            else{
                include('templates/single/single.php');
            }
        ?>
 
<?php get_footer(); ?>