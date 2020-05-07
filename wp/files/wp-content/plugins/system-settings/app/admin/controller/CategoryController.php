<?php

namespace app\admin\controller;

use library\controller\RestController;
use library\Db;

/**
 * 分类资源控制器
 * User: Frank <belief_dfy@163.com>
 * Date: 2020/05/07
 * Time: 3:48 PM
 */
class CategoryController extends RestController
{

    protected $delCategorys = []; //需要删除的分类

    /**
     * 实现分类的钩子，增加字段和增删改查
     * @author frank <belief_dfy@163.com>
     * @return html
     */
    public function index()
    {
        register_rest_field('category', 'meta', array(
            'get_callback'    => function ($term, $request) {
                $display = get_term_meta($term['id'], 'display', true);
                if (empty($display)) {
                    $display = "show";
                }
                return ['display' => $display];
            }
        ));

        register_rest_field('category', 'list_order', array(
            'get_callback' => function ($params) {
                return Db::name('terms')->where('term_id', $params['id'])->value('list_order');
            },
            'update_callback' => function ($value, $object, $fieldName) {
                //return get_term_field('list_order',$object->ID,'category');
            }
        ));

        register_rest_field('category', 'header_desc', array(
            'get_callback' => function ($params) {
                return get_term_meta($params['id'], 'header_desc', true);
            },
            'update_callback' => function ($value, $object, $fieldName) {
                return update_post_meta($object->ID, $fieldName, $value);
            }
        ));

        register_rest_field('category', 'footer_desc', array(
            'get_callback' => function ($params) {
                return get_term_meta($params['id'], 'footer_desc', true);
            },
            'update_callback' => function ($value, $object, $fieldName) {
                return update_post_meta($object->ID, $fieldName, $value);
            }
        ));

        register_rest_field('category', 'background', array(
            'get_callback' => function ($params) {
                return get_term_meta($params['id'], 'background', true);
            },
            'update_callback' => function ($value, $object, $fieldName) {
                return update_post_meta($object->ID, $fieldName, $value);
            }
        ));

        register_rest_field('category', 'seo_title', array(
            'get_callback' => function ($params) {
                return get_term_meta($params['id'], 'seo_title', true);
            },
            'update_callback' => function ($value, $object, $fieldName) {
                return update_post_meta($object->ID, $fieldName, $value);
            }
        ));

        register_rest_field('category', 'seo_desc', array(
            'get_callback' => function ($params) {
                return get_term_meta($params['id'], 'seo_desc', true);
            },
            'update_callback' => function ($value, $object, $fieldName) {
                return update_post_meta($object->ID, $fieldName, $value);
            }
        ));

        register_rest_field('category', 'seo_keywords', array(
            'get_callback' => function ($params) {
                return get_term_meta($params['id'], 'seo_keywords', true);
            },
            'update_callback' => function ($value, $object, $fieldName) {
                return update_post_meta($object->ID, $fieldName, $value);
            }
        ));

        add_action("rest_after_insert_category", function ($term, $request, $bool) {

            global $wpdb;
            if ($bool && $request['type'] == 'list') {
                $item = $this->get_json_toArray(get_template_directory() . '/json/portal/category.json');
                $data = [
                    'object_id' => $term->term_id,
                    'is_public' =>  0,
                    'theme' => wp_get_theme()->get('Name'),
                    'name' => $item['name'],
                    'action' => $item['action'],
                    'file' => $item['action'],
                    'description' => $item['description'],
                    'more' => json_encode($item),
                    'config_more' => json_encode($item)
                ];

                $res = Db::name('theme_file')->insert($data);
                $insert_id = $wpdb->insert_id;

                register_rest_field('category', 'theme_file', [
                    'get_callback' => function ($params) use ($insert_id) {
                        return Db::name('theme_file')->where('id', $insert_id)->find();
                    }
                ]);
            }

            $header_desc = $request['header_desc'];
            $footer_desc = $request['footer_desc'];
            $background = $request['background'];

            //新增tdk
            $seo_title = $request['seo_title'];
            $seo_desc = $request['seo_desc'];
            $seo_keywords = $request['seo_keywords'];


            //新增或更新
            if (!empty($header_desc)) {
                //删除原来的数据
                delete_term_meta($term->term_id, 'header_desc');
                update_term_meta($term->term_id, 'header_desc', $header_desc);
            }

            if (!empty($footer_desc)) {
                delete_term_meta($term->term_id, 'footer_desc');
                update_term_meta($term->term_id, 'header_desc', $footer_desc);
            }

            if (!empty($background)) {
                delete_term_meta($term->term_id, 'background');
                update_term_meta($term->term_id, 'background', $background);
            }

            if (!empty($seo_title)) {
                delete_term_meta($term->term_id, 'seo_title');
                update_term_meta($term->term_id, 'seo_title', $seo_title);
            }

            if (!empty($seo_desc)) {
                delete_term_meta($term->term_id, 'seo_desc');
                update_term_meta($term->term_id, 'seo_desc', $seo_desc);
            }

            if (!empty($seo_keywords)) {
                delete_term_meta($term->term_id, 'seo_keywords');
                update_term_meta($term->term_id, 'seo_keywords', $seo_keywords);
            }

            update_term_meta($term->term_id, 'display', $request['display']);



            //更新排序
            $list_order = isset($request['list_order']) ? $request['list_order'] : 0;
            Db::name('terms')->where('term_id', $term->term_id)->update(['list_order' => $list_order]);
        }, 10, 3);
    }

    /**
     * json文件转数组
     * @author frank <belief_dfy@163.com>
     * @return array
     */
    public function get_json_toArray($dir)
    {
        $json = file_get_contents($dir);
        $data = json_decode($json, true);
        return $data;
    }

    //根据父级删除子集
    public function deleteCategory($request)
    {
        $id = $request['id'];

        $this->delCategorys[] = $id;
        $mid = $request['mid'];

        $this->movePostsByCid($id, $mid);
        $taxonomy_ids     = get_term_children($id, 'category');
        foreach ($taxonomy_ids as $key => $value) {
            $this->delCategorys[] = $value;
            $this->movePostsByCid($id, $mid);
        }

        foreach ($this->delCategorys as $value) {
            wp_delete_term($value, 'category');
        }

        return $this->success("操作成功");
    }

    //根据分类id删除或移动下面的文章
    public function movePostsByCid($cid, $mid = null)
    {
        $query_args = [
            "order" => "desc",
            "orderby" => "date",
            "post_status" => ["public"],
            "date_query" => [],
            'post_type' => 'post',
            'tax_query' => [
                [
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => [$cid],
                    'include_children' => 0
                ]
            ],

        ];

        $posts_query  = new \WP_Query();
        $query_result = $posts_query->query($query_args);
        //移动到指定分类
        foreach ($query_result as $key => $value) {
            if (!empty($mid)) {

                $param = [intval($mid)];

                $taxonomies = wp_list_filter(get_object_taxonomies('post', 'objects'), array('show_in_rest' => true));

                foreach ($taxonomies as $taxonomy) {

                    $result = wp_set_object_terms($value->ID, $param, $taxonomy->name);
                    if (is_wp_error($result)) {
                        return $result;
                    }
                }
            } else {

                //移到回收站
                $result   = wp_trash_post($value->ID);
            }
        }
    }
}
