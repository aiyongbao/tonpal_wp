<?php
namespace app\admin\controller;
use library\controller\BaseController;
use library\Db;

class SlideItemController extends BaseController{

    public function add_item($request = '')
    {

        $slide_id = $request['slide_id'];
        $title = $request['title'];
        $description = $request['description'];
        $image = $request['image'];

        // $data = [
        //     'slide_id' => 1,
        //     'title' => '测试slide',
        //     'description' => '测试描述',
        //     'image' => 'http://placeimg.com/1200/300' 
        // ];
        
        $data = [
            'slide_id' => $slide_id,
            'title' => $title,
            'description' => $description,
            'image' => $image
        ];

        $result = Db::name('slide_item')->insert($data);
        if($result !== false)
        {
            return $this->success('添加成功');
        }
        else{
            $this->error('添加失败',$result);
        }
    }

}