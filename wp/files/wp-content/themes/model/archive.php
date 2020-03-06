<?php
    $category = get_category(get_category_root_id($cat));
    $slug = $category->name;
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