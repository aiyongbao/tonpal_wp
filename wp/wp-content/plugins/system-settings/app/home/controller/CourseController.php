<?php
namespace app\home\controller;

use library\controller\BaseController;
use library\Db;

class CourseController extends BaseController
{
    public function Index()
    {
        $data = Db::name('slide_item')->where('slide_id','1')->select();
        return $data;
    }
}