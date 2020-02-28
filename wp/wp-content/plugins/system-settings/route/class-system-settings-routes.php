<?php

use PhpMyAdmin\Theme;
use app\admin\controller\SlideController;
use app\admin\controller\ThemeController;
use app\admin\controller\NavMenuController;
use app\admin\controller\SlideItemController;
use app\admin\controller\ThemeFileController;

class routes {
    
    protected $namespace;

    function __construct()
    {
        $this->namespace = 'admin/v1';
    }

    //注册路由
    function register_plugins_routes()
    {

        //查看主题列表
        register_rest_route( $this->namespace , '/themes', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function(){
                $theme = new ThemeController();
                return $theme->index();
            },
        ) );

        //设置主题
        register_rest_route( $this->namespace , '/themes', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $theme = new ThemeController();
                return $theme->set_theme($request);
            },
        ) );

        //设置导航栏所属类型
        register_rest_route( $this->namespace , '/set_nav_menu_type', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $theme = new ThemeController();
                return $theme->set_menu_locations($request);
            },
            'permission_callback' => function(){
                
                if(!current_user_can( 'edit_theme_options' ))
                {
                    return new WP_Error( 'rest_forbidden', esc_html__( '您没有权限进行此操作！'), array( 'status' => 403 ) );
                }

                return true;

            }
        ) );


         //添加父类导航栏列表
         register_rest_route( $this->namespace , '/nav_menu', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return $navMenu->add_nav($request);
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
            'callback' => function(){
                $navMenu = new NavMenuController();
                return $navMenu->get_nav();
            },
        ) );

        //根据id删除父类导航栏
        register_rest_route( $this->namespace , '/nav_menu/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::DELETABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return $navMenu->delete_nav($request);
            },
        ) );

        //获取子导航组详情类别
        register_rest_route( $this->namespace , '/nav_menu/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return $navMenu->get_nav_items($request);
            },
            'args' => function(){
                $args = array();
            }
        ) );
        
        //增加父导航子项
        register_rest_route( $this->namespace , '/nav_menu_items/(?P<id>[\d]+)', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $navMenu = new NavMenuController();
                return $navMenu->add_nav_items($request);
            },
            'args' => function(){
                $args = array();
            }
        ) );

        //获取轮播播图父列表
        register_rest_route( $this->namespace , '/slide', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $slide = new SlideController($request);
                return $slide->get_list();
            }
        ) );

        //增加轮播图子项
        register_rest_route( $this->namespace , '/slide_item', array(
            'methods'  => WP_REST_Server::CREATABLE,
            'callback' => function($request){
                $slideItem = new SlideItemController($request);
                return $slideItem->add_item($request);
            }
        ) );

        //获取当前主题的json配置文件列表
        register_rest_route($this->namespace , '/theme_file_list',array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => function($request){
                $themeFile = new ThemeFileController();
                return $themeFile->index();
            }
        ));
    }
}

add_action( 'rest_api_init', 'system_settings_register_plugins_routes' );

function system_settings_register_plugins_routes()
{
    $routes = new routes();
    $routes->register_plugins_routes();
}