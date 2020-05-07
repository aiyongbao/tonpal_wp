<?php

//自动导入文件
spl_autoload_register(function($class_name){

    $class_path = str_replace('\\','/',$class_name);
    if(isset($class_path) && strpos($class_path,'app') !== false){
        require_once ABSPATH . 'async-task/' . $class_path . '.php';
    }

});