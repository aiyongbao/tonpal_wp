<?php

use app\home\controller\CourseController;

/*
Plugin Name: system-settings Plugin
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: system-settings Plugin
Version:     20200213
Author:      dfy520.cn
Author URI:  https://developer.wordpress.org/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/

define('plugin_dir_path',plugin_dir_path(__FILE__));

error_reporting(1);

//启用钩子
require plugin_dir_path(__FILE__) . 'library/autoload/autoload.php';
