    <?php
/**
 * 具体分类列表模板判断页面
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
get_header(); ?>

        <?php
            $category = get_category(get_category_root_id($cat));
            $slug = $category->slug;
            if ( $slug === 'products' ) {
                include('templates/category/category-products.php');
            }
            else if ( $slug === 'news' ) {
                include('templates/category/category-news.php');
            }
            else if ( $slug === 'picturewell' ) {
                include('templates/category/category-picturewell.php');
            }
            else if ( $slug === 'waterfall' ) {
                include('templates/category/category-waterfall.php');
            }
            else if ( $slug === 'video' ) {
                include('templates/category/category-video.php');
            }
            else{
                include('templates/category/category.php');
            }
            
        ?>
 
<?php get_footer(); ?>