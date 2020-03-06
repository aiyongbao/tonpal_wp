<?php
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

    //注册模板初始化json文件
    init_theme_file();
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
                $wpdb->theme_file = "wp_theme_file";
                $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->theme_file WHERE file = %s",$filename ) );
                $data = [
                  'is_public' =>  0,
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

//添加模板css样式
function add_theme_scripts()
{
   

    //引入jquery依赖
    wp_enqueue_script('jQuerytest',get_template_directory_uri() . '/assets/plugins/jQuery/jquery.min.js');
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

function get_category_root_id($cat)
{
  $this_category = get_category($cat); // 取得当前分类
  while ($this_category->category_parent) // 若当前分类有上级分类时，循环
  {
    $this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
  }
  return $this_category->term_id; // 返回根分类的id号
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
      $classes[] = 'dropdown view';
    }

  }
  return $classes; 
}

add_filter( 'nav_menu_link_attributes', 'init_menu_link_attributes', 2, 3 );
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
    $classes[] = 'dropdown-menu';
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
  
  $file = $public ? $file = 'public/'.$filename : 'portal/'.$filename;
  
  global $wpdb;
  $wpdb->theme_file = "wp_theme_file";
  $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->theme_file WHERE file = %s AND is_public = %d", $file, $public ) );

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