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