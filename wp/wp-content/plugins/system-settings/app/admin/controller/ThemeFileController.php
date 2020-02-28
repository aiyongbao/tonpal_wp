<?php
namespace app\admin\controller;
use library\controller\BaseController;

class ThemeFileController extends BaseController{

    public function __construct()
    {
        
    }

    public function index()
    {
        $result = [];
        $jsonDir = get_template_directory() . '/json/';
        $temp = scandir($jsonDir);
        foreach($temp as $key => $value)
        {
            if($value != '.' && $value != '..'){
                $item = file_get_contents( $jsonDir. $value);
                $item = json_decode($item,true);
                $result[$value] = $item;
            }
        }
        return $this->success("获取成功",$result);
    }

}