<?php

namespace app\home\controller;

use library\controller\BaseController;

class PostController extends BaseController
{
    //设置排序规则
    public function index($query)
    {
        //$query->set('meta_key', 'list_order');
        $query->set('orderby', 'list_order');
    }
}
