<?php

namespace app\home\controller;

use library\controller\BaseController;

class PostController extends BaseController
{
    public function index($query)
    {
        //$query->set('meta_key', 'list_order');
        $query->set('orderby', 'list_order');
    }
}
