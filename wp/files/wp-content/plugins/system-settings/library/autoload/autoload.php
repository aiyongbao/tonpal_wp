<?php

require_once plugin_dir_path . 'route/SystemSettingsRoutes.php'; // 加载路由
require_once plugin_dir_path(__FILE__) . '../controller/BaseController.php'; // 系统基类
require_once plugin_dir_path(__FILE__) . '../controller/RestController.php'; // 资源类
require_once plugin_dir_path(__FILE__) . '../Db.php'; // 数据库类
require_once plugin_dir_path(__FILE__) . '../middleware.php'; // 中间间类
require_once plugin_dir_path(__FILE__) .'../../app/http/Kernel.php'; // 注册中间件
require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // 注册全局mysql操作方法

require_once plugin_dir_path . '../../../wp-admin/includes/misc.php'; //wordpress内置

//自动导入文件
spl_autoload_register(function($class_name){

    $class_path = str_replace('\\','/',$class_name);
    if(isset($class_path) && strpos($class_path,'app') !== false){
        require_once plugin_dir_path . $class_path . '.php';
    }

});

