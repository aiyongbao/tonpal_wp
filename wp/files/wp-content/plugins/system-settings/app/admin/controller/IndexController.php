<?php
namespace app\admin\controller;

use library\controller\RestController;

class IndexController extends RestController{

    public function __construct()
    {

    }


    public function index()
    {
        return 'hello world';
    }
    

}