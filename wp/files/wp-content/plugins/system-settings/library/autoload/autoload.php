<?php

require_once plugin_dir_path . 'route/SystemSettingsRoutes.php';
require_once plugin_dir_path(__FILE__) . '../controller/BaseController.php';
require_once plugin_dir_path(__FILE__) . '../controller/RestController.php';
require_once plugin_dir_path(__FILE__) . '../Db.php';
require_once plugin_dir_path(__FILE__) . '../middleware.php';
require_once plugin_dir_path(__FILE__) .'../../app/http/Kernel.php';

require_once plugin_dir_path . '../../../wp-admin/includes/misc.php';


spl_autoload_register(function($class_name){

    $class_path = str_replace('\\','/',$class_name);
    if(isset($class_path) && strpos($class_path,'app') !== false){
        require_once plugin_dir_path . $class_path . '.php';
    }

});

