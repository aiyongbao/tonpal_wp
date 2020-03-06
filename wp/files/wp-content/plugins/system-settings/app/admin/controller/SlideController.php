<?php
namespace app\admin\controller;
use library\controller\RestController;

class SlideController extends RestController{

    //获取slide的列表
    public function get_list($request = '')
    {
        $sql = "SELECT * FROM wp_slide limit 0,10";
        $data = $this->db->get_results($sql);
        $result = $this->object_array($data);
        return $this->success("获取成功",$result);
    }

}