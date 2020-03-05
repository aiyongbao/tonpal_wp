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
  }

endif;
add_action('after_setup_theme', 'my_theme_setup');

//添加模板css样式
function add_theme_scripts()
{
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
