<?php

namespace app\admin\controller;

use library\controller\RestController;
use app\portal\controller\InquiryController;

class SettingController extends RestController
{

    public function __construct()
    {
        
    }

    public function init()
    {
        //初始化sql
        $themeFile = new ThemeFileController();
        $themeFile->initSql();

        $inquiry = new InquiryController();
        $inquiry->initSql();
    }

    public function index()
    {
        /*  if ( ! current_user_can( 'manage_options' ) ) {
            return $this->error("你还未登录！请先登录",[]);
        } */

        $permalink_structure = get_option('permalink_structure');

        $prefix = $blog_prefix = '';

        if ( ! got_url_rewrite() ) {
            $prefix = '/index.php';
        }

        if (is_multisite() && !is_subdomain_install() && is_main_site() && 0 === strpos($permalink_structure, '/blog/')) {
            $blog_prefix = '/blog';
        }

        $structures = array(
            0 => '',
            1 => $prefix . '/%year%/%monthnum%/%day%/%postname%/',
            2 => $prefix . '/%year%/%monthnum%/%postname%/',
            3 => $prefix . '/' . _x( 'archives', 'sample permalink base' ) . '/%post_id%',
            4 => $prefix . '/%postname%/',
        );

        $options = [
            'site_title' => get_option('blogname'),
            'site_desc' => get_option('blogdescription'),
            'site_router_rules' => [
                [
                    'name' => '朴素',
                    'url' => get_option('home') . '/?p=123',
                    'check' => trim(checked('', $permalink_structure)) == "checked='checked'" ? true :false
                ],
                [
                    'name' => '日期和名称型',
                    'url' => get_option('home') . $blog_prefix . $prefix . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . _x('sample-post', 'sample permalink structure') . '/',
                    'check' => trim(checked( $structures[1], $permalink_structure, false )) == "checked='checked'" ? true :false
                ],
                [
                    'name' => '月份和名称型',
                    'url' => get_option( 'home' ) . $blog_prefix . $prefix . '/' . date( 'Y' ) . '/' . date( 'm' ) . '/' . _x( 'sample-post', 'sample permalink structure' ) . '/',
                    'check' => trim(checked( $structures[2], $permalink_structure, false )) == "checked='checked'" ? true :false
                ],
                [
                    'name' => '数字型',
                    'url' => get_option( 'home' ) . $blog_prefix . $prefix . '/' . _x( 'archives', 'sample permalink base' ) . '/123',
                    'check' => trim(checked( $structures[3], $permalink_structure, false )) == "checked='checked'" ? true :false
                ],
                [
                    'name' => '文章名',
                    'url' => get_option( 'home' ) . $blog_prefix . $prefix . '/' . _x( 'sample-post', 'sample permalink structure' ) . '/',
                    'check' => trim(checked( $structures[4], $permalink_structure, false )) == "checked='checked'" ? true :false
                ],
                [
                    'name' => '自定义结构',
                    'url' => get_option( 'home' ) . $blog_prefix . esc_attr( $permalink_structure ),
                    'check' => trim(checked( ! in_array( $permalink_structure, $structures ) ,true, false)) == "checked='checked'" ? true :false
                ]
            ]
        ];

        return $this->success("获取成功", $options);
    }

    public function store($request)
    {

        $key = 'site_title';
        $value = '外贸通宝建站';

        $options = [
            'site_title' => 'blogname',
            'site_desc' => 'blogdescription'
        ];

        if(isset($options[$key]))
        {
           $res = update_option($options[$key],$value);
           if($res !== false)
           {
               return $this->success("设置成功！");
           }
           else{
            return $this->error("未做任何修改！");
           }
        }
        else{
            return $this->error("请稍后再试！");
        }

    }
}
