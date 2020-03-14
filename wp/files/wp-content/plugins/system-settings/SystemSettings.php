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

use app\home\controller\LangController;
use app\admin\controller\PostController;
use app\admin\controller\InquiryController;
use app\admin\controller\CategoryController;
use app\admin\controller\ThemeFileController;
use app\home\controller\PostController as portalPostController;

//定义插件根目录
define('plugin_dir_path',plugin_dir_path(__FILE__));

//报告 E_ERROR 错误
error_reporting(E_ERROR);

//启用钩子
require plugin_dir_path(__FILE__) . 'library/autoload/autoload.php';

//插件安装
register_activation_hook( __FILE__, function(){
    
    //初始化sql
    $themeFile = new ThemeFileController();
    $themeFile->initSql();

    $inquiry = new InquiryController();
    $inquiry->initSql();
} );

//初始化钩子
add_action('init', function(){
    //后台语种钩子
    $lang = new LangController();
    $lang->index();

    //自定义文章接口增加字段，实现wordpress钩子
    $post = new PostController('post');
    $post->index();

    //自定义页面接口增加字段，实现wordpress钩子
    $page = new PostController('page');
    $page->index();

    //实现列表页数据json自定义
    $category = new CategoryController();
    $category->index();
});

//前台语种钩子
add_action( 'lang_loaded', function()
{
    $lang = new LangController();
    $lang->index();
});


//文章查询钩子
add_action( 'setup_theme' ,function(){
    add_action( 'pre_get_posts', function($query)
    {
        $post = new portalPostController();
        $query = $post->index($query);
        return $query;
    });
});
