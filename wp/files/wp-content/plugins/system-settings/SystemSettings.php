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

use app\portal\controller\LangController;
use app\admin\controller\PostController;
use app\admin\controller\CategoryController;
use app\portal\controller\PostController as portalPostController;
use app\portal\controller\CategoryController as portalCategoryController;

//定义插件根目录
define('plugin_dir_path', plugin_dir_path(__FILE__));

//报告 E_ERROR 错误
error_reporting(E_ERROR);

//启用钩子
require plugin_dir_path(__FILE__) . 'library/autoload/autoload.php';

//初始化钩子
add_action('init', function () {

    if (isset($_REQUEST['lang'])) {
        $lang = new LangController();
        $lang->index($_REQUEST['lang']);
    }

    //自定义文章接口增加字段，实现wordpress钩子
    $post = new PostController('post');
    $post->index();

    //自定义页面接口增加字段，实现wordpress钩子
    $page = new PostController('page');
    $page->index();

    //实现列表页数据json自定义
    $category = new CategoryController();
    $category->index();

    $data = get_categories(
        [
            "taxonomy" => "category",
            "parent" => 87,
            "hide_empty" => 0
        ]
    );

});

add_filter('init', function () {

    $rules = get_option('rewrite_rules');

    add_rules();
    global $wp_rewrite;

    $wp_rewrite->flush_rules();
});

function add_rules()
{

    $match = "(zh|zh-cn|zu|yo|yi|cy|vi|uz|ur|uk|tr|th|te|ta|tg|sv|sw|su|es|so|sl|sk|si|st|sr|ru|ro|pa|pt|pl|fa|no|ne|my|mn|mr|mi|mt|ml|ms|mg|lt|lv|la|lo|ko|km|kk|kn|jw|ja|it|ga|id|ig|is|hu|hi|iw|ha|ht|gu|el|de|ka|gl|fr|fi|tl|et|eo|nl|da|cs|hr|ny|ca|bg|bs|bn|be|eu|az|hy|ar|sq|af)";

    $match_lang = str_replace('|', '\/|', $match);

    add_rewrite_rule($match, 'index.php?lang=$matches[1]', 'bottom');
    add_rewrite_rule($match_lang . '(.?.+?)(?:/([0-9]+))?/?$', 'index.php?lang=$matches[1]&pagename=$matches[2]', 'top');
    add_rewrite_rule($match_lang . '([^/]+).html(?:/([0-9]+))?/?$', 'index.php?lang=$matches[1]&name=$matches[2]&page=$matches[3]', 'top');
}

//文章查询钩子
add_action('setup_theme', function () {

    //前台语种初始化
    $abbr = explode('/', $_SERVER['REQUEST_URI']);
    $match = "zh|zh-cn|zu|yo|yi|cy|vi|uz|ur|uk|tr|th|te|ta|tg|sv|sw|su|es|so|sl|sk|si|st|sr|ru|ro|pa|pt|pl|fa|no|ne|my|mn|mr|mi|mt|ml|ms|mg|lt|lv|la|lo|ko|km|kk|kn|jw|ja|it|ga|id|ig|is|hu|hi|iw|ha|ht|gu|el|de|ka|gl|fr|fi|tl|et|eo|nl|da|cs|hr|ny|ca|bg|bs|bn|be|eu|az|hy|ar|sq|af";

    if (isset($abbr[1]) && strpos($match, $abbr[1])) {
        $lang = new LangController();
        $lang->index($abbr[1]);
    }

    add_action('pre_get_terms', function ($query) {
        $category = new portalCategoryController();
        $query = $category->index($query);
        return $query;
    });

    add_action('pre_get_posts', function ($query) {
        $post = new portalPostController();
        $query = $post->index($query);
        return $query;
    });

    add_filter("wp_nav_menu_args", function ($args) {
        $lang = get_query_var('lang');
        if (isset($lang)) {
            global $wpdb;
            $cur_prefix = $wpdb->prefix;
            $wpdb->set_prefix('wp_');
            $menu_id = get_option($lang . '_primary');
            $wpdb->set_prefix($cur_prefix);
            $args['menu'] = $menu_id;
        }
        return $args;
    });
});

add_filter('category_rewrite_rules', function ($category_rewrite) {

    if (class_exists('Sitepress')) {
        global $sitepress;

        remove_filter('terms_clauses', array($sitepress, 'terms_clauses'));
        $categories = get_categories(array('hide_empty' => false));
        //Fix provided by Albin here https://wordpress.org/support/topic/bug-with-wpml-2/#post-8362218
        //add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ) );
        add_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
    } else {
        $categories = get_categories(array('hide_empty' => false));
    }

    foreach ($categories as $category) {
        $category_nicename = $category->slug;

        if ($category->parent == $category->cat_ID) {
            $category->parent = 0;
        } elseif ($category->parent != 0) {
            $category_nicename = get_category_parents($category->parent, false, '/', true) . $category_nicename;
        }

        $match = "(zh|zh-cn|zu|yo|yi|cy|vi|uz|ur|uk|tr|th|te|ta|tg|sv|sw|su|es|so|sl|sk|si|st|sr|ru|ro|pa|pt|pl|fa|no|ne|my|mn|mr|mi|mt|ml|ms|mg|lt|lv|la|lo|ko|km|kk|kn|jw|ja|it|ga|id|ig|is|hu|hi|iw|ha|ht|gu|el|de|ka|gl|fr|fi|tl|et|eo|nl|da|cs|hr|ny|ca|bg|bs|bn|be|eu|az|hy|ar|sq|af)";
        $category_rewrite[$match . '/(' . $category_nicename . ')/?$'] = 'index.php?lang=$matches[1]&category_name=$matches[2]';
    }
    return $category_rewrite;
});

add_filter('query_vars', function ($public_query_vars) {
    $public_query_vars[] = 'lang';
    return $public_query_vars;
});

add_filter('request', function ($query_vars) {

    $match = "zh|zh-cn|zu|yo|yi|cy|vi|uz|ur|uk|tr|th|te|ta|tg|sv|sw|su|es|so|sl|sk|si|st|sr|ru|ro|pa|pt|pl|fa|no|ne|my|mn|mr|mi|mt|ml|ms|mg|lt|lv|la|lo|ko|km|kk|kn|jw|ja|it|ga|id|ig|is|hu|hi|iw|ha|ht|gu|el|de|ka|gl|fr|fi|tl|et|eo|nl|da|cs|hr|ny|ca|bg|bs|bn|be|eu|az|hy|ar|sq|af";
    if (isset($_REQUEST['lang']) && strpos($match, $_REQUEST['lang'])) {
        if (isset($query_vars['category_name'])) {
            $catlink = trailingslashit(get_option('home')) . $_REQUEST['lang'] . '/' . $query_vars['category_name'];
        } elseif (isset($query_vars['pagename'])) {
            $catlink = trailingslashit(get_option('home')) . $_REQUEST['lang'] . '/' . $query_vars['pagename'];
        } elseif (isset($query_vars['rest_route'])) {
            return $query_vars;
        } else {
            $catlink = trailingslashit(get_option('home')) . $_REQUEST['lang'] . '/';
        }
        status_header(301);
        header("Location: $catlink");
        exit();
    }
    return $query_vars;
});

add_filter('nav_menu_link_attributes', function ($atts, $item, $args) {

    $abbr = explode('/', $_SERVER['REQUEST_URI']);
    $match = "zh|zh-cn|zu|yo|yi|cy|vi|uz|ur|uk|tr|th|te|ta|tg|sv|sw|su|es|so|sl|sk|si|st|sr|ru|ro|pa|pt|pl|fa|no|ne|my|mn|mr|mi|mt|ml|ms|mg|lt|lv|la|lo|ko|km|kk|kn|jw|ja|it|ga|id|ig|is|hu|hi|iw|ha|ht|gu|el|de|ka|gl|fr|fi|tl|et|eo|nl|da|cs|hr|ny|ca|bg|bs|bn|be|eu|az|hy|ar|sq|af";

    if (isset($abbr[1]) && strpos($match, $abbr[1])) {
        $old_href = $atts['href'];
        if ($old_href != "") {
            $atts['href'] = str_replace($old_href, $old_href . '/' . $abbr[1] . '/', $atts['href']);
        }
    }

    return $atts;
}, 10, 3);
