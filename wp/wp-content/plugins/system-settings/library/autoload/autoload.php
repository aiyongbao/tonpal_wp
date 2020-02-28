<?php

require plugin_dir_path . 'route/class-system-settings-routes.php';

require plugin_dir_path(__FILE__) . '../controller/BaseController.php';

require plugin_dir_path(__FILE__) . '../Db.php';

spl_autoload_register(function($class_name){

    $class_path = str_replace('\\','/',$class_name);

    if(isset($class_path) && strpos($class_path,'app') !== false){
        require_once plugin_dir_path . $class_path . '.php';
    }

    //加载library下的类

});