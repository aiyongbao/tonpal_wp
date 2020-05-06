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
use app\portal\controller\SitemapController;

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
});

add_filter('init', function () {
    $rules = get_option('rewrite_rules');
    add_rules();
    global $wp_rewrite;
    //print_r($wp_rewrite);

    //print_r($rules = get_option( 'rewrite_rules' ));

    $wp_rewrite->flush_rules();

    
});

add_filter('get_terms_orderby',function($orderby, $query_vars, $taxonomy){
    
    if(in_array('category', $taxonomy)){

        if($query_vars['orderby'] == 'list_order'){
            return 't.list_order';
        }
        else{
            return $orderby;
        }

    }
    
    return $orderby;
    
},10,3);

function add_rules()
{
    $match = "zh|zh-cn|zu|yo|yi|cy|vi|uz|ur|uk|tr|th|te|ta|tg|sv|sw|su|es|so|sl|sk|si|st|sr|ru|ro|pa|pt|pl|fa|no|ne|my|mn|mr|mi|mt|ml|ms|mg|lt|lv|la|lo|ko|km|kk|kn|jw|ja|it|ga|id|ig|is|hu|hi|iw|ha|ht|gu|el|de|ka|gl|fr|fi|tl|et|eo|nl|da|cs|hr|ny|ca|bg|bs|bn|be|eu|az|hy|ar|sq|af";

    $match_arr = explode('|',$match);

    foreach($match_arr as $lang)
    {
        add_rewrite_rule('^'.$lang.'/?$' , 'index.php?lang='.$lang, 'bottom');
        add_rewrite_rule('^'.$lang . '/(.?.+?)(?:/([0-9]+))?/?$', 'index.php?lang='.$lang.'&pagename=$matches[1]', 'top');
        add_rewrite_rule('^'.$lang . '/product/([^/]+).html(?:/([0-9]+))?/?$','index.php?lang='.$lang.'&name=$matches[1]&page=$matches[2]', 'top');  //新增产品详情伪静态
        add_rewrite_rule('^'.$lang . '/news/([^/]+).html(?:/([0-9]+))?/?$' , 'index.php?lang='.$lang.'&name=$matches[1]&page=$matches[2]', 'top');
        add_rewrite_rule('^'.$lang . '/list/([^/]+).html(?:/([0-9]+))?/?$' , 'index.php?lang='.$lang.'&name=$matches[1]&page=$matches[2]', 'top');
    }

}

//文章查询钩子
add_action('setup_theme', function () {


    //sitemap初始化
    $sitemap = new SitemapController();
    $sitemap->route_init();

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

    add_filter("home_url", function ($url, $path, $schame, $blog_id) {
        $lang = get_query_var('lang');
        $old_href_arr = explode('/', $url);
        $old_href = $old_href_arr[2];

        if ($lang) {
            if ($schame != 'rest') {
                $url = str_replace($old_href_arr[0] . "//" . $old_href, '/' . $lang, $url);
            }
        } else {
            $url = str_replace($old_href_arr[0] . "//" . $old_href, '', $url);
        }

        if(empty($url))
        {
            $url = '/';
        }

        return $url;
    }, 10, 4);
});

add_filter("pre_post_link",function($permalink,$post,$leavename){

    if(strpos($_SERVER['REQUEST_URI'],'ai-product-detail' == false)){
        $permalink = '/info-product'.$permalink;
    }
    
    elseif(strpos($_SERVER['REQUEST_URI'],'ai-news-detail') !== false){
        $permalink = '/info-news'.$permalink;
    }

    elseif(strpos($_SERVER['REQUEST_URI'],'info-product') !== false){
        $permalink = '/info-product'.$permalink;
    }

    elseif(strpos($_SERVER['REQUEST_URI'],'info-news') !== false){
        $permalink = '/info-news'.$permalink;
    }

    elseif(  !empty($_REQUEST['s']) || strpos($_SERVER['REQUEST_URI'],'product') !== false){
        $permalink = '/product'.$permalink;
    }

    elseif(strpos($_SERVER['REQUEST_URI'],'news') !== false){
        $permalink = '/news'.$permalink;
    }

    else{
        $permalink = '/list'.$permalink;
    }

    return $permalink;

},10,3);

// add_filter('get_pagenum_link',function($result,$pagenum){
    
//     $result = rtrim($result, "/");

//     return $result;

// },10,2);

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

        $match = "zh|zh-cn|zu|yo|yi|cy|vi|uz|ur|uk|tr|th|te|ta|tg|sv|sw|su|es|so|sl|sk|si|st|sr|ru|ro|pa|pt|pl|fa|no|ne|my|mn|mr|mi|mt|ml|ms|mg|lt|lv|la|lo|ko|km|kk|kn|jw|ja|it|ga|id|ig|is|hu|hi|iw|ha|ht|gu|el|de|ka|gl|fr|fi|tl|et|eo|nl|da|cs|hr|ny|ca|bg|bs|bn|be|eu|az|hy|ar|sq|af";
        $match_arr = explode('|',$match);

        $category_rewrite[ 'list/(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]'; // 列表伪静态
        $category_rewrite[ 'list/(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?lang=&category_name=$matches[1]&paged=$matches[2]';  // 列表伪静态

        foreach($match_arr as $lang)
        {
            $category_rewrite['^'.$lang . '/(' . $category_nicename . ')/?$'] = 'index.php?lang='.$lang.'&category_name=$matches[1]'; // 列表伪静态
            $category_rewrite['^'.$lang . '/(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?lang='.$lang.'&category_name=$matches[1]&paged=$matches[2]';  // 列表伪静态
        }
        
        //print_r( $category_rewrite );
        
    }
    return $category_rewrite;
});

add_filter('post_rewrite_rules', function($post_rewrite) {
    unset($post_rewrite['([^/]+).html(?:/([0-9]+))?/?$']); //移除原来的伪静态逻辑
    $post_rewrite['product/([^/]+).html(?:/([0-9]+))?/?$'] = 'index.php?name=$matches[1]&page=$matches[2]';  //新增产品详情伪静态
    $post_rewrite['news/([^/]+).html(?:/([0-9]+))?/?$'] = 'index.php?name=$matches[1]&page=$matches[2]'; //新增图文详情伪静态
    $post_rewrite['list/([^/]+).html(?:/([0-9]+))?/?$'] = 'index.php?name=$matches[1]&page=$matches[2]'; //新增列详情伪静态
    $post_rewrite['info-news/([^/]+).html(?:/([0-9]+))?/?$'] = 'index.php?name=$matches[1]&page=$matches[2]'; //新增列详情伪静态
    return $post_rewrite;
});

add_filter('query_vars', function ($public_query_vars) {
    $public_query_vars[] = 'lang';
    $public_query_vars[] = 'is_admin';
    return $public_query_vars;
});

add_filter('request', function ($query_vars) {

    //大写转小写
    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    $http = $_SERVER['REQUEST_URI'];
    $host = $_SERVER['HTTP_HOST'];
    $url = $http_type.$host.$http;

    if(preg_match("/[A-Z]+/", $url))
    {
        $url = strtolower($url);
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: '.$url);
        exit();
    }


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

        if (!isset($query_vars['is_admin'])) {
            status_header(301);
            header("Location: $catlink");
            exit();
        }
    }
    return $query_vars;
});

function recursiveDelete($dir)
{
    // 打开指定目录
    if ($handle = @opendir($dir)) {
        while (($file = readdir($handle)) !== false) {
            if (($file == ".") || ($file == "..")) {
                continue;
            }
            if (is_dir($dir . '/' . $file)) {
                // 递归
                recursiveDelete($dir . '/' . $file);
            } else {
                unlink($dir . '/' . $file); // 删除文件
            }
        }
        @closedir($handle);
        rmdir($dir);
    }
}
