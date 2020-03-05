<?php
namespace app\admin\controller;
use library\controller\RestController;

class NavMenuController extends RestController{

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

    //根据父类导航id获取单个nav_item
    public function get_nav_item($request)
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
    public function add_nav_item($request)
    {
    
        $id = $request['id'];
        $data = [];

        // $data = [
        //     'menu-item-object'      => 'page',
        //     'menu-item-type'        => 'post_type',
        //     'menu-item-title'       => '示例页面',
        //     'menu-item-object-id'   => $id,
        //     'menu-item-object'      => 'page',
        //     'menu-item-status'      => 'publish'
        // ];
        
        isset($request['menu-item-type']) && $data['menu-item-type'] = $request['menu-item-type'] ;
        isset($request['menu-item-title']) && $data['menu-item-title'] = $request['menu-item-title'];
        isset($request['menu-item-object-id']) && $data['menu-item-object-id'] = $id;
        isset($request['menu-item-object']) && $data['menu-item-object'] = $request['menu-item-object'];
        isset($request['menu-item-type']) && $data['menu-item-type'] = $request['menu-item-type'];
        isset($request['menu-item-status']) && $data['menu-item-status'] = $request['menu-item-status'];
        
        
        $result = wp_update_nav_menu_item($id,0,$data);
        if(!$result->errors)
        {
            return $this->success('新增成功',['menu_id' => $result]);
        }
        else{
            return $this->success('添加失败！',$result);
        }
        
    }

    //根据id更新导航栏详情
    public function update_nav_menu_item($request)
    {
        $id = $request['id'];

        $data = [];

        // $data = [
        //     'menu-item-object'      => 'page',
        //     'menu-item-type'        => 'post_type',
        //     'menu-item-title'       => '示例页面',
        //     'menu-item-object-id'   => $id,
        //     'menu-item-object'      => 'page',
        //     'menu-item-status'      => 'publish'
        // ];
        
        isset($request['menu-item-type']) && $data['menu-item-type'] = $request['menu-item-type'] ;
        isset($request['menu-item-title']) && $data['menu-item-title'] = $request['menu-item-title'];
        isset($request['menu-item-object-id']) && $data['menu-item-object-id'] = $id;
        isset($request['menu-item-object']) && $data['menu-item-object'] = $request['menu-item-object'];
        isset($request['menu-item-type']) && $data['menu-item-type'] = $request['menu-item-type'];
        isset($request['menu-item-status']) && $data['menu-item-status'] = $request['menu-item-status'];

        $result  = wp_update_nav_menu_item($meun_id = 0,$id,$data);
        if(!$result->errors)
        {
            return $this->success('更新成功！',$result );
        }
        else{
            return $this->success('更新失败！',$result);
        }
    }

    //根据id删除导航栏详情
    public function delete_nav_menu_item($request)
    {
        $id = $request['id'];

        $result  = wp_delete_post( $id );
        if(!$result->errors)
        {
            return $this->success('删除成功！',$result );
        }
        else{
            return $this->success('删除失败！',$result);
        }
    }

}