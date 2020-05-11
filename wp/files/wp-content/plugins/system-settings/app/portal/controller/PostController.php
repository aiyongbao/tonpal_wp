<?php

namespace app\portal\controller;

use library\controller\BaseController;
use library\Db;

/**
 * 文章控制器
 * User: Frank <belief_dfy@163.com>
 */
class PostController extends BaseController
{
    //设置排序规则
    public function index($query)
    {
        $hide_category = $query->query_vars['category__not_in'];
        //筛选出隐藏的内容
        $data = Db::name('termmeta')->where('meta_key', 'display')->where('meta_value', 'hide')->select();


        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $hide_category[] = $value['term_id'];
            }
        }

        $query->query_vars['category__not_in'] =  $hide_category;

        return $query;
    }
}
