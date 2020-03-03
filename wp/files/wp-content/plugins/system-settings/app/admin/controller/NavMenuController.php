<?php
namespace app\admin\controller;
use library\controller\BaseController;

class NavMenuController extends BaseController{

    public function __construct()
    {
        
    }

    //新增navMenu父导航
    public function add_nav($request)
    {
        
        $name = $request['name'];

        if(empty($name))
        {
            return $this->error('name不能为空');
        }
        
        $menu_id = 0;
        $menu_data = array(
            'menu-name' => $name
        );

        $result = wp_update_nav_menu_object($menu_id,$menu_data);
        
        return $this->success('添加成功',['id' => $result ]);
    }

    //获取navMenu的全部列表
    public function get_nav()
    {
        $data = wp_get_nav_menus();
        return $this->success('获取成功',$data);
    }

    //根据id删除Nav
    public function delete_nav($request)
    {
        $id = $request['id'];
        $result = wp_delete_nav_menu($id);
        if($result !== false)
        {
            return $this->success('操作成功');
        }
        else{
            return $this->error('操作失败，该导航不存或已被删除！');
        }
    }

    //根据父类导航id获取单个navitem
    public function get_nav_items($request)
    {
        $id = $request['id'];
        $data = wp_get_nav_menu_items($id);
        if($data !== false)
        {
            return $this->success('获取成功',$data);
        }
        else{
            return $this->success('获取失败，该导航栏不存在！');
        }
    }

    //根据父类导航id新增navitem
    public function add_nav_items($request)
    {
        
        $type = $this->request->get('type');

        $data = [];
        
        switch($type)
        {
            case 'page':
                break;
                
        }

        $data = [
            'menu-item-object'      => 'page',
            'menu-item-type'        => 'post_type',
            'menu-item-title'       => '示例页面',
            'menu-item-object-id'   => 2,
            'menu-item-object'      => 'page',
            'menu-item-status'      => 'publish'
        ];
        
        wp_update_nav_menu_item(2,0,$data);
    }

}