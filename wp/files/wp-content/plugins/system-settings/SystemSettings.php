<?php


/*
Plugin Name: system-settings Plugin
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: system-settings Plugin
Version:     20200213
Author:      dfy520.cn
Author URI:  https://developer.wordpress.org/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/

use app\admin\controller\CategoryController;
use app\admin\controller\PostController;
use app\admin\controller\ThemeFileController;
use app\home\controller\LangController;

define('plugin_dir_path',plugin_dir_path(__FILE__));

error_reporting(1);

//启用钩子
require plugin_dir_path(__FILE__) . 'library/autoload/autoload.php';

//插件安装
register_activation_hook( __FILE__, function(){
    $themeFile = new ThemeFileController();
    $themeFile->initSql();
} );

//初始化钩子
add_action('init', function(){

    $lang = new LangController();
    $lang->index();

    $post = new PostController('post');
    $post->index();

    $page = new PostController('page');
    $page->index();

    $category = new CategoryController();
    $category->index();
});

//语种钩子
add_action( 'lang_loaded', function()
{
    $lang = new LangController();
    $lang->index();
});


//文章查询钩子
add_action( 'setup_theme' ,function(){
    add_action( 'pre_get_posts', function($query)
    {
        $post = new app\home\controller\PostController();
        $query = $post->index($query);
        return $query;
    });
});
