<?php
global $cat; // 当前页面id
    $category = get_category(get_category_root_id($cat));
    $slug = $category->slug;
    if ( $slug === 'product' ) {
        include('templates/category/category-products.php');
    }
    else if ( $slug === 'news' ) {
        include('templates/category/category-news.php');
    }
    else{
        include('templates/category/category.php');
    }