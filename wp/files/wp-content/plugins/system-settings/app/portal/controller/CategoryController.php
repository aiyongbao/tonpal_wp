<?php

namespace app\portal\controller;

use library\controller\BaseController;
use library\Db;

/**
 * 前台分类控制器
 * User: Frank <belief_dfy@163.com>
 */
class CategoryController extends BaseController
{
    /**
     * 分类过滤方法
     * @author frank <belief_dfy@163.com>
     */
    public function index($query)
    {
        $hide_category = [];
        $data = Db::name('termmeta')->where('meta_key', 'display')->where('meta_value', 'hide')->select();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $hide_category[] = intval($value['term_id']);
            }
        }

        $query->query_vars['exclude'] =  $hide_category;
        $query->query_vars['hide_empty'] = 0;

        return $query;
    }
}
