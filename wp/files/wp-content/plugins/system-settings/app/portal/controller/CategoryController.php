<?php

namespace app\portal\controller;

use library\controller\BaseController;
use library\Db;

class CategoryController extends BaseController
{
    public function index($query)
    {
        $hide_category = [];
        $data = Db::name('termmeta')->where('meta_key','display')->where('meta_value','hide')->select();
        if(!empty($data))
        {
            foreach($data as $key => $value)
            {
                $hide_category[] = intval($value['term_id']);
            }
        }
        $query->query_vars['exclude'] =  $hide_category;
        $query->query_vars['hide_empty'] = 0;
        
        return $query;
    }
}