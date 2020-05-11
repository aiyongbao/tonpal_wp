<?php

namespace app\admin\controller;

use library\controller\RestController;
use app\portal\controller\InquiryController;

/**
 * 系统设置
 * User: Frank <belief_dfy@163.com>
 */
class SettingController extends RestController
{

    /**
     * 内容初始化
     * @author frank <belief_dfy@163.com>
     */
    public function init()
    {
        //初始化sql
        $themeFile = new ThemeFileController();
        $themeFile->initSql();

        $inquiry = new InquiryController();
        $inquiry->initSql();
    }

    /**
     * 设置基础伪静态
     * @author frank <belief_dfy@163.com>
     * @return html
     */
    public function index()
    {
        /*  if ( ! current_user_can( 'manage_options' ) ) {
            return $this->error("你还未登录！请先登录",[]);
        } */

        $permalink_structure = get_option('permalink_structure');

        $prefix = $blog_prefix = '';

        if (!got_url_rewrite()) {
            $prefix = '/index.php';
        }

        if (is_multisite() && !is_subdomain_install() && is_main_site() && 0 === strpos($permalink_structure, '/blog/')) {
            $blog_prefix = '/blog';
        }

        $structures = array(
            0 => '',
            1 => $prefix . '/%year%/%monthnum%/%day%/%postname%/',
            2 => $prefix . '/%year%/%monthnum%/%postname%/',
            3 => $prefix . '/' . _x('archives', 'sample permalink base') . '/%post_id%',
            4 => $prefix . '/%postname%/',
        );

        $options = [
            'site_title' => get_option('blogname'),
            'site_desc' => get_option('blogdescription'),
            'site_router_rules' => [
                [
                    'name' => '朴素',
                    'url' => get_option('home') . '/?p=123',
                    'check' => trim(checked('', $permalink_structure)) == "checked='checked'" ? true : false
                ],
                [
                    'name' => '日期和名称型',
                    'url' => get_option('home') . $blog_prefix . $prefix . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . _x('sample-post', 'sample permalink structure') . '/',
                    'check' => trim(checked($structures[1], $permalink_structure, false)) == "checked='checked'" ? true : false
                ],
                [
                    'name' => '月份和名称型',
                    'url' => get_option('home') . $blog_prefix . $prefix . '/' . date('Y') . '/' . date('m') . '/' . _x('sample-post', 'sample permalink structure') . '/',
                    'check' => trim(checked($structures[2], $permalink_structure, false)) == "checked='checked'" ? true : false
                ],
                [
                    'name' => '数字型',
                    'url' => get_option('home') . $blog_prefix . $prefix . '/' . _x('archives', 'sample permalink base') . '/123',
                    'check' => trim(checked($structures[3], $permalink_structure, false)) == "checked='checked'" ? true : false
                ],
                [
                    'name' => '文章名',
                    'url' => get_option('home') . $blog_prefix . $prefix . '/' . _x('sample-post', 'sample permalink structure') . '/',
                    'check' => trim(checked($structures[4], $permalink_structure, false)) == "checked='checked'" ? true : false
                ],
                [
                    'name' => '自定义结构',
                    'url' => get_option('home') . $blog_prefix . esc_attr($permalink_structure),
                    'check' => trim(checked(!in_array($permalink_structure, $structures), true, false)) == "checked='checked'" ? true : false
                ]
            ]
        ];

        return $this->success("获取成功", $options);
    }

    /**
     * 更新后台设置
     * @author frank <belief_dfy@163.com>
     * @return html
     */
    public function store($request)
    {
        $key = $request['key'];
        $value = $request['value'];

        $res = update_option($key, $value);
        if ($res !== false) {
            return $this->success("设置成功！");
        } else {
            return $this->error("出现错误获取内容未修改！");
        }
    }

    /**
     * 启用nginx缓存清楚工具插件
     * @author frank <belief_dfy@163.com>
     * @return html
     */
    public function enable()
    {
        $nginx_settings = [
            'enable_purge' => '1',
            'cache_method' => 'enable_fastcgi',
            'purge_method' => 'unlink_files',
            'redis_hostname' => '1',
            'redis_port' => '1',
            'redis_prefix' => '1',
            'purge_homepage_on_edit' => '1',
            'purge_homepage_on_del' => '1',
            'purge_page_on_mod' => '1',
            'purge_page_on_new_comment' => '1',
            'purge_page_on_deleted_comment' => '1',
            'purge_archive_on_edit' => '1',
            'purge_archive_on_del' => '1',
            'purge_url' => '',
            'log_level' => 'INFO'
        ];
        update_site_option('rt_wp_nginx_helper_options', $nginx_settings);
        return get_option('rt_wp_nginx_helper_options');
    }

    /**
     * 下载插件并启动
     * @author frank <belief_dfy@163.com>
     * @return html
     */
    public function plugin($request)
    {

        $plugin = $request['plugin'];
        include_once(ABSPATH . 'wp-admin/includes/plugin-install.php'); //for plugins_api..
        $api = \plugins_api(
            'plugin_information',
            array(
                'slug'   => $plugin,
                'fields' => array(
                    'sections' => false,
                ),
            )
        );

        if (is_wp_error($api)) {
            wp_die($api);
        }

        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

        $type = 'web'; //Install plugin type, From Web or an Upload.
        $upgrader = new \Plugin_Upgrader();

        //下载安装插件
        $upgrader->install($api->download_link);

        //启用全部插件
        $data = get_plugins();
        foreach ($data as $key => $plugin) {
            activate_plugin($key);
        }
    }
}
