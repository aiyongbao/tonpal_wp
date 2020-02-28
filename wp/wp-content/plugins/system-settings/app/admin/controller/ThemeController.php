<?php
namespace app\admin\controller;
use library\controller\BaseController;

class ThemeController extends BaseController{

    public function __construct()
    {
        
    }

    public function index()
    {
        $result = [];
        $themes = wp_get_themes();
        foreach($themes as $key => $value)
        {
            $arr = [
                'name' => $value->__get('name'),
                'stylesheet' => $value->__get('stylesheet'),
                'description' => $value->__get('description'),
                'enable' => wp_get_theme() == $value->__get('name') ? true : false
            ];

            array_push($result,$arr);
        }
      
        return $this->success('获取成功！',$result);
    }
    
    //切换当前主题
    public function set_theme($request)
    {
        $theme_name = $request['name'];
        if(!empty($theme_name))
        {
            $theme = wp_get_theme($theme_name);
            if ( ! $theme->exists() || ! $theme->is_allowed() ) {
                return $this->error('当前主题不存在！');
            }
            switch_theme( $theme->get_stylesheet() );
            
            return $this->success('主题切换完成！');
        }
    }

    //设置导航栏所属类型
    public function set_menu_locations($request)
    {
        $locations      = get_registered_nav_menus();
        $menu_locations = get_nav_menu_locations();

        foreach ( $locations as $location => $description ) {
			if ( ( empty( $_POST['menu-locations'] ) || empty( $_POST['menu-locations'][ $location ] ) ) && isset( $menu_locations[ $location ] ) && $menu_locations[ $location ] == $nav_menu_selected_id ) {
				unset( $menu_locations[ $location ] );
			}
		}

		// Merge new and existing menu locations if any new ones are set.
		if ( isset( $_POST['menu-locations'] ) ) {
			$new_menu_locations = array_map( 'absint', $_POST['menu-locations'] );
			$menu_locations     = array_merge( $menu_locations, $new_menu_locations );
		}

		// Set menu locations.
        set_theme_mod( 'nav_menu_locations', $menu_locations );

        return $this->success('操作完成！',$menu_locations);
    }


}