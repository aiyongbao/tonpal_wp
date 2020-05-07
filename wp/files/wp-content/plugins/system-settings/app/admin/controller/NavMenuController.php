<?php

namespace app\admin\controller;

use library\controller\RestController;
use library\Db;

/**
 * 导航栏管理
 * User: Frank <belief_dfy@163.com>
 */
class NavMenuController extends RestController
{

    protected $delete_ids = [];

    //新增navMenu父导航
    public function add_nav($request)
    {
        $name = $request['name'];
        if (empty($name)) {
            return $this->error('name不能为空');
        }

        $menu_id = 0;
        $menu_data = array(
            'menu-name' => $name
        );

        $result = wp_update_nav_menu_object($menu_id, $menu_data); //官方方法 更新导航对象
        $lang = $_REQUEST['lang'];
        if (!isset($result->errors) && isset($lang)) {
            global $wpdb;
            $wpdb->set_prefix = 'wp_';

            //多语种保存信息到设置表
            $sql = <<<EOT
                SELECT option_value FROM `wp_options` WHERE `option_name` = '{$lang}_primary' limit 1;
EOT;
            $primary = $wpdb->get_row($sql);

            if (empty($primary)) {
                $res = $wpdb->insert('wp_options', [
                    'option_name' => $lang . '_primary', 'option_value' => $result
                ], []);
            } else {
                $res = $wpdb->query(
                    "UPDATE `wp_options` SET `option_value` = '{$result}' WHERE option_name = '{$lang}_primary'"
                );
            }
        }

        return $this->success('添加成功', ['id' => $result]);
    }

    //获取navMenu的全部列表
    public function get_nav()
    {
        $data = wp_get_nav_menus();
        return $this->success('获取成功', $data);
    }

    //根据id删除Nav
    public function delete_nav($request)
    {
        $id = $request['id'];
        $result = wp_delete_nav_menu($id);
        if ($result !== false) {
            return $this->success('操作成功');
        } else {
            return $this->error('操作失败，该导航不存或已被删除！');
        }
    }

    //根据父类导航id获取单个nav_item
    public function get_nav_item($request)
    {
        $id = $request['id'];
        $data = wp_get_nav_menu_items($id);
        if ($data !== false) {
            return $this->success('获取成功', $data);
        } else {
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

        $result = wp_update_nav_menu_item($id, 0, $data);

        if (!empty($data['menu-item-position'])) {
            $pdate_post['ID']          = $result;
            $pdate_post['menu_order'] = $data['menu-item-position'];

            wp_update_post($pdate_post);
        }

        if (!$result->errors) {
            return $this->success('新增成功', ['menu_id' => $result]);
        } else {
            return $this->success('添加失败！', $result);
        }
    }

    //根据id更新导航栏详情
    public function update_nav_menu_item($request)
    {

        $id = $request['id'];
        $post = get_post($id);
        $object_id = get_post_meta($post->ID, '_menu_item_object_id', true);
        $object    = get_post_meta($post->ID, '_menu_item_object', true);
        $type      = get_post_meta($post->ID, '_menu_item_type', true);
        $data = [];

        $data['menu-item-title'] = isset($request['menu-item-title']) ?  $request['menu-item-title'] : $post->post_title;
        $data['menu-item-object-id'] = isset($request['menu-item-object-id']) ? $request['menu-item-object-id'] : $object_id;
        $data['menu-item-object'] = isset($request['menu-item-object']) ? $request['menu-item-object'] : $object;
        $data['menu-item-type'] = isset($request['menu-item-type']) ? $request['menu-item-type'] : $type;
        isset($request['menu-item-status']) && $data['menu-item-status'] = $request['menu-item-status'];
        isset($request['menu-item-parent-id']) && $data['menu-item-parent-id'] = $request['menu-item-parent-id'];
        isset($request['menu-item-url']) && $data['menu-item-url'] = $request['menu-item-url'];
        isset($request['menu-item-attr-title']) && $data['menu-item-attr-title'] = $request['menu-item-attr-title'];
        isset($request['menu-item-target']) && $data['menu-item-target'] = $request['menu-item-target'];
        isset($request['menu-item-classes']) && $data['menu-item-classes'] = $request['menu-item-classes'];
        isset($request['menu-item-position']) && $data['menu-item-position'] = $request['menu-item-position'];

        $result  = wp_update_nav_menu_item($meun_id = 0, $id, $data);
        if (!empty($data['menu-item-position'])) {

            $pdate_post['ID']          = $id;
            $pdate_post['menu_order'] = $data['menu-item-position'];

            wp_update_post($pdate_post);
        }

        if (!$result->errors) {
            return $this->success('更新成功！', ['id' => $result]);
        } else {
            return $this->error('更新失败！', $result);
        }
    }

    //批量更新导航栏详情
    public function update_nav_menu_items($request)
    {
        $params = $request['params'];
        $params = json_decode($params, true);

        $messages = [];
        $errors = [];

        foreach ($params as $key => $item) {
            $result = $this->update_nav_menu_item($item);
            if ($result->data['code'] == 0) {
                $errors[] = [
                    'id' => $item['id'],
                    'messgae' => $result->data['msg'],
                    'code' => $result->data['code'],
                ];
            } else {
                $messages[] = [
                    'id' => $item['id'],
                    'messgae' => $result->data['msg'],
                    'code' => $result->data['code'],
                ];
            }
        }

        return $this->success('执行成功！,一共' . count($params) . '条数据，成功' . count($messages) . '条', ['success' => $messages, 'error' => $errors]);
    }

    //根据id删除导航栏详情
    public function delete_nav_menu_item($request)
    {
        $id = $request['id'];
        $this->recursive_delete_nav_menu_item($id);
        foreach ($this->delete_ids as $id) {
            $result  = wp_delete_post($id);
        }
        if (!$result->errors) {
            return $this->success('删除成功！', []);
        } else {
            return $this->error('删除失败！', $result);
        }
    }

    //递归删除自己的子项
    public function recursive_delete_nav_menu_item($id)
    {
        $this->delete_ids[] = $id;
        $parent = Db::name('postmeta')->alias('pm')
            ->join('posts p', 'p.id = pm.post_id')
            ->where('meta_key', '_menu_item_menu_item_parent')->where('meta_value', $id)->field('pm.*')->select();
        foreach ($parent as $key => $value) {
            if (!empty($value['post_id'])) {
                $this->recursive_delete_nav_menu_item($value['post_id']);
            }
        }
    }

    //根据导航id删除全部导航子项
    public function delete_nav_all($request)
    {
        $id = $request['id'];
        if (empty($id)) {
            return $this->error("id不能为空！");
        }
        $unsorted_menu_items = wp_get_nav_menu_items(
            $id,
            array(
                'orderby'     => 'ID',
                'output'      => ARRAY_A,
                'output_key'  => 'ID',
                'post_status' => 'draft,publish',
            )
        );
        $menu_items          = array();
        // Index menu items by db ID
        foreach ($unsorted_menu_items as $_item) {
            $menu_items[$_item->db_id] = $_item;
        }
        // Remove menu items from the menu that weren't in $_POST
        if (!empty($menu_items)) {
            foreach (array_keys($menu_items) as $menu_item_id) {
                if (is_nav_menu_item($menu_item_id)) {
                    wp_delete_post($menu_item_id);
                }
            }
        }
        return $this->success("操作成功！");
    }
}
