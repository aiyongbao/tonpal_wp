<?php
namespace app\admin\controller;
use library\controller\RestController;
use library\Db;

class NavMenuController extends RestController{

    static $delete_ids = [];
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
            return $this->error('获取失败，该导航栏不存在！');
        }
    }

    //根据父类导航id新增navitem
    public function add_nav_item($request)
    {
    
        $id = $request['id'];
        $data = [];
        
        isset($request['menu-item-title']) && $data['menu-item-title'] = $request['menu-item-title'];
        isset($request['menu-item-object-id']) && $data['menu-item-object-id'] = $request['menu-item-object-id'];
        isset($request['menu-item-object']) && $data['menu-item-object'] = $request['menu-item-object'];
        isset($request['menu-item-type']) && $data['menu-item-type'] = $request['menu-item-type'];
        isset($request['menu-item-status']) && $data['menu-item-status'] = $request['menu-item-status'];
        isset($request['menu-item-parent-id']) && $data['menu-item-parent-id'] = $request['menu-item-parent-id'];
        isset($request['menu-item-url']) && $data['menu-item-url'] = $request['menu-item-url'];
        isset($request['menu-item-attr-title']) && $data['menu-item-attr-title'] = $request['menu-item-attr-title'];
        isset($request['menu-item-target']) && $data['menu-item-target'] = $request['menu-item-target'];
        isset($request['menu-item-classes']) && $data['menu-item-classes'] = $request['menu-item-classes'];
        isset($request['menu-item-position']) && $data['menu-item-position'] = $request['menu-item-position'];
        
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

        /* $data = [
            'menu-item-position'    => '0', //排序
            'menu-item-type'        => 'post_type', // ['post_type','taxonomy', 'custom', 'post_type'] 
            'menu-item-title'       => '示例页面',
            'menu-item-object-id'   => $id,
            'menu-item-object'      => 'page',  //对应类型 ['page', 'category', 'custom', 'post']
            'menu-item-status'      => 'publish', // "publish", "future", "draft","pending", "private", "trash", "auto-draft", "inherit", "request-pending", "request-confirmed", "request-failed", "request-completed", "any"
            'menu-item-url'         => '', //type = custom 填写
            'menu-item-description' => '', //描述
            'menu-item-attr-title'  => '', //标签title属性
            'menu-item-target'      => '', // 是否打开新窗口
            'menu-item-classes'     => '', //样式class
        ]; */


        isset($request['menu-item-title']) && $data['menu-item-title'] = $request['menu-item-title']; 
        isset($request['menu-item-object-id']) && $data['menu-item-object-id'] = $request['menu-item-object-id']; 
        isset($request['menu-item-object']) && $data['menu-item-object'] = $request['menu-item-object'];
        isset($request['menu-item-type']) && $data['menu-item-type'] = $request['menu-item-type'];
        isset($request['menu-item-status']) && $data['menu-item-status'] = $request['menu-item-status'];
        isset($request['menu-item-parent-id']) && $data['menu-item-parent-id'] = $request['menu-item-parent-id'];
        isset($request['menu-item-url']) && $data['menu-item-url'] = $request['menu-item-url'];
        isset($request['menu-item-attr-title']) && $data['menu-item-attr-title'] = $request['menu-item-attr-title'];
        isset($request['menu-item-target']) && $data['menu-item-target'] = $request['menu-item-target'];
        isset($request['menu-item-classes']) && $data['menu-item-classes'] = $request['menu-item-classes'];
        isset($request['menu-item-position']) && $data['menu-item-position'] = $request['menu-item-position'];
    
        $result  = wp_update_nav_menu_item($meun_id = 0,$id,$data);
        if(!empty($data['menu-item-position'])){

            $post['ID']          = $id;
            $post['menu_order'] = $data['menu-item-position'];

            wp_update_post( $post );
        }

        if(!$result->errors)
        {
            return $this->success('更新成功！',[ 'id' => $result] );
        }
        else{
            return $this->error('更新失败！',$result);
        }
    }

    //根据id删除导航栏详情
    public function delete_nav_menu_item($request)
    {
        
        
        $id = $request['id'];

       
        $this->recursive_delete_nav_menu_item($id);
        
        foreach($this->delete_ids as $id)
        {
            $result  = wp_delete_post( $id );
        }
        
        if(!$result->errors)
        {
            return $this->success('删除成功！',[] );
        }
        else{
            return $this->error('删除失败！',$result);
        }
    }

    //递归删除自己的子项
    public function recursive_delete_nav_menu_item($id)
    {
        
        $this->delete_ids[] = $id;
        $parent = Db::name('postmeta')->alias('pm')
        ->join('posts p','p.id = pm.post_id')
        ->where('meta_key','_menu_item_menu_item_parent')->where('meta_value',$id)->field('pm.*')->select();

        foreach($parent as $key => $value)
        {
            if(!empty($value['post_id']))
            {
                $this->recursive_delete_nav_menu_item($value['post_id']);
            }
        }
    }

}