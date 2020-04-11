<?php

use app\admin\controller\SyncController;
use app\admin\controller\ThemeController;
use app\portal\controller\InquiryController;
use app\admin\controller\NavMenuController;
use app\admin\controller\SettingController;
use app\admin\controller\CategoryController;
use app\admin\controller\ThemeFileController;

class SystemSettingsRoutes {
    
    protected $namespace;

    function __construct()
    {
        $this->namespace = 'admin/v1';
        $this->portal_namespace = 'portal/v1';
    }

    //注册路由
    function register_plugins_routes()
    {

        //查看主题列表
        register_rest_route( $this->namespace , '/themes', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $theme = new ThemeController();
                return middleware::run('api')->init($theme->index(),$request);
            },
        ) );

        //设置主题
        register_rest_route( $this->namespace , '/themes', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $theme = new ThemeController();
                return middleware::run('api')->init( $theme->set_theme($request),$request);
            },
        ) );

        //设置导航栏所属类型
        register_rest_route( $this->namespace , '/set_nav_menu_type', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $theme = new ThemeController();
                return middleware::run('api')->init($theme->set_menu_locations($request),$request);
            }
        ) );


         //添加父类导航栏列表
         register_rest_route( $this->namespace , '/nav_menu', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->add_nav($request),$request);
            },
            'args' => function(){
                $args = array();
                // Here we are registering the schema for the filter argument.
                $args['description'] = array(
                    'description' => esc_html__('父类导航描述'),
                    'type'        => 'string',
                );

                $args['name'] = array(
                    'description' => esc_html__('父类导航名称'),
                    'type'        => 'string',
                    'required'    => true
                );

                $args['parent'] = array(
                    'description' => esc_html__('父类导航id'),
                    'type'        => 'id',
                );

                $args['slug'] = array(
                    'description' => esc_html__(''),
                    'type'        => 'string',
                );
                return $args;
            }
        ) );
        
        //获取父类导航栏列表
        register_rest_route( $this->namespace , '/nav_menu', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->get_nav(),$request);
            },
        ) );

        //根据id删除父类导航栏
        register_rest_route( $this->namespace , '/nav_menu/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::DELETABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->delete_nav($request),$request);
            },
        ) );

        //根据导航id删除导航全部子项
        register_rest_route( $this->namespace , '/nav_menu_all/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::DELETABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->delete_nav_all($request),$request);
            },
        ) );


        //获取子导航组详情类别
        register_rest_route( $this->namespace , '/nav_menu/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->get_nav_item($request),$request);
            },
            'args' => function(){
                $args = array();
            }
        ) );
        
        //增加父导航子项
        register_rest_route( $this->namespace , '/nav_menu/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->add_nav_item($request),$request);
            },
            'args' => function(){
                $args = array();
            }
        ) );

        //根据id更新导航栏子项
        register_rest_route( $this->namespace , '/update_nav_menu_item/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->update_nav_menu_item($request),$request);
            },
            'args' => function(){
                $args = array();
            }
        ) );
        
        //批量更新导航
        register_rest_route( $this->namespace , '/update_nav_menu_items', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->update_nav_menu_items($request),$request);
            }
        ) );

        //根据id删除导航栏子项
        register_rest_route( $this->namespace , '/nav_menu_item/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::DELETABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return middleware::run('api')->init($navMenu->delete_nav_menu_item($request),$request);
            },
            'args' => function(){
                $args = array();
            }
        ) );

        //初始化全部json主题
        //同步当前主题的json配置文件列表
        register_rest_route($this->namespace , '/theme_file_init',array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $themeFile = new ThemeFileController();
                return middleware::run('api')->init( $themeFile->theme_file_init(), $request);
            }
        ));

        //同步当前主题的json配置文件列表
        register_rest_route($this->namespace , '/theme_file_list',array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $themeFile = new ThemeFileController();
                return middleware::run('api')->init( $themeFile->index(), $request);
            }
        ));

        //获取当前主题的json配置文件列表
        register_rest_route($this->namespace , '/get_theme_file_list',array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $themeFile = new ThemeFileController();
                return middleware::run('api')->init( $themeFile->fileList(), $request);
            }
        ));

        //根据id获取主题的json单个配置文件列表
        register_rest_route($this->namespace , '/theme_file_item/(?P<id>[\d]+)',array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $themeFile = new ThemeFileController();
                return middleware::run('api')->init( $themeFile->fileItem($request) , $request);
            }
        ));

        //根据id获取主题的json单个配置文件列表
        register_rest_route($this->namespace , '/theme_file_item',array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $themeFile = new ThemeFileController();
                return middleware::run('api')->init( $themeFile->fileItemObject($request) , $request);
            }
        ));

        register_rest_route($this->namespace , '/theme_file_item/(?P<id>[\d]+)',array(
            'methods'  => WP_REST_Server::DELETABLE,
            'callback' => function($request){
                $themeFile = new ThemeFileController();
                return middleware::run('api')->init( $themeFile->delete($request) , $request);
            }
        ));

        //更新主题的json配置文件列表
        register_rest_route($this->namespace , '/update_theme_file_item/(?P<id>[\d]+)',array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $themeFile = new ThemeFileController();
                return middleware::run('api')->init( $themeFile->updateFileItem($request) , $request);
            }
        ));

        //获取站点的基本配置文件
        register_rest_route($this->namespace , '/settings',array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $settings = new SettingController();
                return middleware::run('api')->init( $settings->index() , $request);
            }
        ));

        //添加系统基本设置
        register_rest_route($this->namespace , '/settings/store',array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $settings = new SettingController();
                return middleware::run('api')->init( $settings->store($request) , $request);
            }
        ));

        //根据id删除网站分类和子分类
        register_rest_route($this->namespace , '/category/(?P<id>[\d]+)',array(
            'methods'  => WP_REST_Server::DELETABLE,
            'callback' => function($request){
                $category = new CategoryController();
                return middleware::run('api')->init( $category->deleteCategory($request) , $request);
            }
        ));

        //注册询盘链接
        register_rest_route($this->portal_namespace , '/inquiry',array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $inquiry = new InquiryController();
                return middleware::run('api')->init( $inquiry->index($request) , $request);
            }
        ));
        
        //前台同步数据
        register_rest_route($this->namespace , '/execute',array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $sync = new SyncController();
                $sync->dbExecute($request);
            }
        ));

        //接受分类同步数据参数
        register_rest_route($this->namespace, '/taxonomy' ,array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $sync = new SyncController();
                return middleware::run('api')->init( $sync->taxonomy($request) , $request);
            }
        ));

        //接受文章同步数据参数
        register_rest_route($this->namespace, '/sync/post' ,array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $sync = new SyncController();
                return middleware::run('api')->init( $sync->post($request) , $request);
            }
        ));

        //同步接口
        register_rest_route($this->namespace, '/async_post' ,array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $sync = new SyncController();
                return $sync->asyncPostJson($request);
            }
        ));

    }
}

add_action( 'rest_api_init', 'SystemSettingsRoutes' );

function SystemSettingsRoutes()
{
    $routes = new SystemSettingsRoutes();
    $routes->register_plugins_routes();
}