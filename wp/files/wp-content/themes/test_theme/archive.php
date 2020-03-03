    <?php
/**
 * 具体分类列表模板判断页面
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
get_header(); ?>

    <div class="container">
        
         <?php

            $category = get_category(get_category_root_id($cat));
            $slug = $category->slug;
            if ( $slug === 'products' ) {
                include('templates/category/category-products.php');
            }
            else if ( $slug === 'news' ) {
                include('templates/category/category-news.php');
            }
            else{
                include('templates/category/category.php');
            }
            
        ?>

    </div>
 
<?php get_footer(); ?>