<?php
use library\Db;

if (!function_exists('my_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function my_theme_setup()
    {
        //注册菜单
        register_nav_menus(
            array(
                'primary' => __('主导航栏'),
                'footer' => __('底部菜单')
            )
        );

    }

    function init_theme_file()
    {
        $jsonDir = get_template_directory() . '/json';
        $temp = scandir($jsonDir);
        foreach($temp as $key => $parentDir)
        {
            if($parentDir != '.' && $parentDir != '..'){

                if(is_dir($jsonDir.'/'.$parentDir)){
                    $sonTemp = scandir($jsonDir.'/'.$parentDir);

                    foreach($sonTemp as $k => $value)
                    {
                        $json_dir = $jsonDir.'/'.$parentDir.'/'.$value;
                        if(is_file($json_dir))
                        {
                            $item = get_json_toArray($json_dir);
                            $filename = explode('.',$value);
                            if(is_array($filename) && count($filename) > 0)
                            {
                                $filename = $filename[0];
                            }
                            $filename = $parentDir. '/' .$filename;
                            global $wpdb;
                            $abbr = get_query_var('lang') ? get_query_var('lang'). '_' : '';
                            $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}{$abbr}theme_file WHERE file = %s ",$filename ) );
                            $data = [
                                'is_public' =>  strpos($item['action'],'public') !==false  ? 1 : 0,
                                'theme' => wp_get_theme()->get('Name'),
                                'name' => $item['name'],
                                'action' => $item['action'],
                                'file' => $filename,
                                'description' => $item['description'],
                                'more' => json_encode($item ),
                                'config_more' => json_encode($item)
                            ];

                            if(empty($result))
                            {
                                //新增
                                $wpdb->insert($wpdb->theme_file,$data);
                            }
                            else{
                                $res = $wpdb->update($wpdb->theme_file,$data,['id' => $result->id]);
                            }
                        }

                    }
                }
            }
        }

    }

endif;
add_action('after_setup_theme', 'my_theme_setup');

add_action('init', function(){
    do_action('lang_loaded');
});


//添加模板css样式
function add_theme_scripts()
{
    //引入jquery依赖
    wp_enqueue_script('jQuerytest',get_template_directory_uri() . '/assets/plugins/jQuery/jquery.min.js');
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

// 获取根分类id
function get_category_root_id($cat)
{
    $this_category = get_category($cat); // 取得当前分类
    while ($this_category->category_parent) // 若当前分类有上级分类时，循环
    {
        $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
    }
    return $this_category->term_id; // 返回根分类的id号
}

/**
 * 获取各级父级url 和 slug
 * $cat 当前id
 * @author zhuoyue
 */
function get_category_url_and_slug($cat)
{
    $category_url_array = [];
    $this_category = get_category($cat); // 取得当前分类
    array_push($category_url_array,array(
        'name' => $this_category->slug,
        'link' => get_category_link($this_category->term_id)
    ));

    while ($this_category->category_parent) // 若当前分类有上级分类时，循环
    {
        $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
        array_push($category_url_array,array(
            'name' => $this_category->slug,
            'link' => get_category_link($this_category->term_id)
        ));

    }
    return $category_url_array; // 返回根分类的id号
}

add_filter('nav_menu_css_class','init_menu_items_class',1,3);

function init_menu_items_class($classes, $item, $args) {
    if($args->theme_location == 'primary') {

        if($item->menu_item_parent == 0)
        {
            $classes[] = 'nav-item';
        }

        if(in_array('menu-item-has-children',$classes))
        {
            $classes[] = 'view';
        }

    }
    return $classes;
}

add_filter( 'nav_menu_link_attributes', 'init_menu_link_attributes', 2, 3 );
/**


 */
function init_menu_link_attributes( $atts, $item, $args ) {
    if($args->theme_location == 'primary') {

        $atts['class'] = 'nav-link';
        if(in_array('menu-item-has-children',$item->classes))
        {
            $atts['class'] = 'nav-link dropdown-toggle';
        }

        if($item->menu_item_parent != 0)
        {
            $atts['class'] = 'dropdown-item';
        }

        return $atts;
    }
}


add_filter( 'nav_menu_submenu_css_class', 'init_submenu_class', 3, 3 );
function init_submenu_class( $classes, $item, $args ) {
    $classes[] = 'subnav';
    return $classes;
}

//读取json配置文件并生成array
function get_json_toArray($dir){
    $json = file_get_contents($dir);
    $data = json_decode($json,true);
    return $data;
}

//根据当前文件全局获取配置文件变量
function json_config_array($file,$type = 'vars',$public = 0)
{

    $filename = explode('.',basename($file));
    if(is_array($filename) && count($filename) > 0)
    {
        $filename = $filename[0];
    }
    $file = $public ? 'public/'.$filename : 'portal/'.$filename;


    global $wpdb;
    $abbr = get_query_var('lang') ? get_query_var('lang'). '_' : '';
    $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}{$abbr}theme_file WHERE file = %s AND is_public = %d LIMIT 1",$file, $public ) );


    if($result !== false)
    {
        $result = (array)$result;
        $more = json_decode($result['more'],true);
        $config_more = json_decode($result['config_more'],true);

        if(isset($config_more['more'][$type])){
            $data = $config_more['more'][$type];
            return $data;
        }
    }
}
/**
 * ifEmptyText [字符判空]
 * @param $value [需要进行判空的值] [必传]
 * @param $default [默认值]
 * @author zhuoyue
 */
function ifEmptyText ($value,$default = '') {
    $data = isset($value) ? (!empty($value) ? $value : $default) : $default;
    return $data;
}

/**
 * ifEmptyText [数组判空]
 * @param $value [需要进行判空的值] [必传]
 * @param $default [默认值]
 * @author zhuoyue
 */

function ifEmptyArray ($value,$default = []) {
    $data = isset($value) ? (!empty($value) ? $value : $default) : $default;
    return $data;
}
/** 分页器 */
function wpbeginner_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="page-bar"><ul class="pages">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}

// 面包屑
function get_breadcrumbs()
{
    global $wp_query;

    if ( !is_home() ){

// Start the UL
        echo '<nav class="path-bar">';
        echo '<ul class="path-nav">';
// Add the Home link
        echo '<li><a class="home" href="'. get_lang_home_url() .'">Home</a></li>';

        if ( is_category() )
        {
            $catTitle = single_cat_title( "", false );
            $cat = get_cat_ID( $catTitle );
            preg_match_all('/<a href=\"(.*?)\".*?>(.*?)<\/a>/i',get_category_parents( $cat, TRUE, "" ),$a_link_array);
            $a_link_array=$a_link_array[0];
            foreach ( $a_link_array as $item ) {
                echo '<li">'.$item."</li>";
            }
        }
        elseif ( is_archive() && !is_category() )
        {
            echo "<li>Archives</li>";
        }
        elseif ( is_search() ) {

            echo "<li>Search Results</li>";
        }
        elseif ( is_404() )
        {
            echo "<li>404 Not Found</li>";
        }
        elseif ( is_single() )
        {
            $category = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );
            preg_match_all('/<a href=\"(.*?)\".*?>(.*?)<\/a>/i',get_category_parents( $category_id, TRUE, "" ),$a_link_array);
            $a_link_array=$a_link_array[0];
            foreach ( $a_link_array as $item ) {
                echo '<li>'.$item."</li>";
            }
            echo '<li><strong>'.the_title('','', FALSE)."</strong></li>";
        }
        elseif ( is_page() )
        {
            $post = $wp_query->get_queried_object();

            if ( $post->post_parent == 0 ){

                echo "<li><strong>".the_title('','', FALSE)."</strong></li>";

            } else {
                $title = the_title('','', FALSE);
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                array_push($ancestors, $post->ID);

                foreach ( $ancestors as $ancestor ){
                    if( $ancestor != end($ancestors) ){
                        echo '<li><a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';
                    } else {
                        echo '<li><strong>'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</strong></li>';
                    }
                }
            }
        }

// End the UL
        echo "</ul>";
        echo "</nav>";
    }
}

/**
 * 获取站点域名 不带.com
 * $_SERVER php超全局变量
 * eg ：www.tonpal.com | tonpal.com
 * echo : tonpal
 * @author zhuoyue
 */
function get_host_name () {
    $host = explode('.',$_SERVER['HTTP_HOST']);
    if(count($host) == 2){
        $host = $host[0];
    } elseif ( count($host) >2 ) {
        $host = $host[1];
    }
    echo $host;
}
/**
 * 获取首页url
 * 因为本站涉及多语种 需要对home_url() 做二次封装
 * @author zhuoyue
 */
function get_lang_home_url () {
    $home_url = home_url();
    return $home_url;
}
/**
 * 获取当前页面url
 * 多语种所需
 * @author zhuoyue
 */
function get_lang_page_url () {
    global $wp;
    $page_url = add_query_arg($wp->request);
    return $page_url;
}
/**
 * 获取语言数据
 * @author zhuoyue
 */
function get_languages(){
    $data = Db::table('wp_language')->where('status','1')->select();
    return $data;
}
// 祛除摘要自动添加分段
remove_filter( 'the_excerpt', 'wpautop' );
