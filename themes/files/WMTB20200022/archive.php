<?php
    $category = get_category(get_category_root_id($cat));
    $slug = $category->slug;
    if ( $slug === 'product' ) {
        include('templates/category/category-product.php');
    }
    else if ( $slug === 'news' ) {
        include('templates/category/category-news.php');
    }
    else if ( $slug === 'info-product' ) {
        include('templates/category/category-info-product.php');
    }
    else if ( $slug === 'info-news' ) {
        include('templates/category/category-info-news.php');
    }
    else{
        include('templates/category/category.php');
    }