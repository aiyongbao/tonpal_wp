<?php

namespace app\admin\controller;

use library\controller\RestController;
use library\Db;
use WP_Http;

class syncController extends RestController
{
    //执行语句Execute
    public function dbExecute($request)
    {
        $sql = $request['sql'];
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno($conn)) {
            echo "连接 MySQL 失败: " . mysqli_connect_error();
        }
        $res = $conn->multi_query($sql);
        mysqli_close($conn);

        if ($res !== false) {
            return $this->success("执行成功");
        } else {
            return $this->error("执行失败");
        }
    }

    //初始化语种数据库
    public function init($abbr)
    {
        $sql = <<<EOT
        CREATE TABLE IF NOT EXISTS `wp_{$abbr}_postmeta` (
        `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
        `meta_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
        `meta_value` longtext COLLATE utf8mb4_general_ci,
        PRIMARY KEY (`meta_id`),
        KEY `post_id` (`post_id`),
        KEY `meta_key` (`meta_key`(191))
        );

        CREATE TABLE IF NOT EXISTS `wp_{$abbr}_posts` (
        `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
        `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `post_content` longtext COLLATE utf8mb4_general_ci NOT NULL,
        `post_title` text COLLATE utf8mb4_general_ci NOT NULL,
        `post_excerpt` text COLLATE utf8mb4_general_ci NOT NULL,
        `post_status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'publish',
        `comment_status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'open',
        `ping_status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'open',
        `post_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
        `post_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
        `to_ping` text COLLATE utf8mb4_general_ci NOT NULL,
        `pinged` text COLLATE utf8mb4_general_ci NOT NULL,
        `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        `post_content_filtered` longtext COLLATE utf8mb4_general_ci NOT NULL,
        `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
        `guid` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
        `menu_order` int(11) NOT NULL DEFAULT '0',
        `post_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'post',
        `post_mime_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
        `comment_count` bigint(20) NOT NULL DEFAULT '0',
        PRIMARY KEY (`ID`),
        KEY `post_name` (`post_name`(191)),
        KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
        KEY `post_parent` (`post_parent`),
        KEY `post_author` (`post_author`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        CREATE TABLE IF NOT EXISTS `wp_{$abbr}_term_relationships` (
        `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
        `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
        `term_order` int(11) NOT NULL DEFAULT '0',
        PRIMARY KEY (`object_id`,`term_taxonomy_id`),
        KEY `term_taxonomy_id` (`term_taxonomy_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        CREATE TABLE IF NOT EXISTS `wp_{$abbr}_term_taxonomy` (
        `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
        `taxonomy` varchar(32) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
        `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
        `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
        `count` bigint(20) NOT NULL DEFAULT '0',
        PRIMARY KEY (`term_taxonomy_id`),
        UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
        KEY `taxonomy` (`taxonomy`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        CREATE TABLE IF NOT EXISTS `wp_{$abbr}_termmeta` (
        `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
        `meta_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
        `meta_value` longtext COLLATE utf8mb4_general_ci,
        PRIMARY KEY (`meta_id`),
        KEY `term_id` (`term_id`),
        KEY `meta_key` (`meta_key`(191))
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        CREATE TABLE IF NOT EXISTS `wp_{$abbr}_terms` (
        `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
        `slug` varchar(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
        `term_group` bigint(10) NOT NULL DEFAULT '0',
        PRIMARY KEY (`term_id`),
        KEY `slug` (`slug`(191)),
        KEY `name` (`name`(191))
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        CREATE TABLE IF NOT EXISTS `wp_{$abbr}_theme_file` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `is_public` tinyint(3) DEFAULT NULL COMMENT '是否公共模块',
        `theme` varchar(20) DEFAULT NULL,
        `name` varchar(20) DEFAULT NULL,
        `action` varchar(20) DEFAULT NULL,
        `file` varchar(50) DEFAULT NULL,
        `description` varchar(100) DEFAULT NULL,
        `more` text,
        `config_more` text,
        `list_order` float DEFAULT '10000',
        `object_id` int(11) DEFAULT NULL,
        PRIMARY KEY (`id`)
        );
EOT;
        
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno($conn)) {
            echo "连接 MySQL 失败: " . mysqli_connect_error();
        }
        $res = $conn->multi_query($sql);
        mysqli_close($conn);
        $this->init_theme_file($abbr);
        return $res;
    }

    //初始化主题
    function init_theme_file($abbr)
    {
      $jsonDir = get_template_directory() . '/json';
      $temp = scandir($jsonDir);
      foreach($temp as $key => $parentDir)
      {
          if($parentDir != '.' && $parentDir != '..'){
  
            if(is_dir($jsonDir.'/'.$parentDir)){
              $sonTemp = scandir($jsonDir.'/'.$parentDir);
              
              foreach($sonTemp as $k => $value)
              {
                $json_dir = $jsonDir.'/'.$parentDir.'/'.$value;
                if(is_file($json_dir))
                {
                  $item = $this->get_json_toArray($json_dir);
                  $filename = explode('.',$value);
                  if(is_array($filename) && count($filename) > 0)
                  {
                    $filename = $filename[0];
                  }
                  $filename = $parentDir. '/' .$filename;
                  global $wpdb;
                  $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}{$abbr}_theme_file WHERE file = %s",$filename ) );
                  $data = [
                    'is_public' =>  strpos($item['action'],'public') !==false  ? 1 : 0,
                    'theme' => wp_get_theme()->get('Name'),
                    'name' => $item['name'],
                    'action' => $item['action'],
                    'file' => $filename,
                    'description' => $item['description'],
                    'more' => json_encode($item ),
                    'config_more' => json_encode($item)
                  ];
                  
                  if(empty($result))
                  {
                    //新增
                    $res = $wpdb->insert( $wpdb->prefix . $abbr .'_theme_file' ,$data);
                  }
                  else{
                    $res = $wpdb->update( $wpdb->prefix . $abbr .'_theme_file' ,$data,['id' => $result->id]);
                  }

                  //print_r($wpdb);
                  
                }
  
              }
            }
          }
      }
  
    }

    function get_json_toArray($dir){
        $json = file_get_contents($dir);
        $data = json_decode($json,true);
        return $data;
    }

    //接受分类参数
    public function taxonomy($request)
    {

        $param = $request['param'];

        if (empty($param)) {
            return $this->error("param参数不正确！");
        }

        if (!is_string($param)) {
            return $this->error("目标参数不正确！");
        }

        $filepath = ABSPATH . "testfile.log";
        if (!file_exists($filepath)) {

            $myfile = fopen($filepath, "w");

            fwrite($myfile, $param);

            fclose($myfile);
        }

        $accept_param = json_decode($param, true);

        $param = $accept_param['data'];
        $type =  $accept_param['type'];

        return $this->syncCategory($param, $type);
    }

    //接受文章参数
    public function post($request)
    {
        $param = $request['param'];

        if (empty($param)) {
            return $this->error("param参数不正确！");
        }

        if (!is_string($param)) {
            return $this->error("目标参数不正确！");
        }

        //将参数保存到本地

        $data_json_file = ABSPATH . "async-task/data/" . date("Y-m-d H:i:s"). "-" . rand(0,1000) . '.json';

        if(!is_dir(ABSPATH . "async-task/data/"))
        {
            mkdir(ABSPATH . "async-task/data/",0777);
        }


        $data_json = fopen($data_json_file, "w");

        fwrite($data_json, $param);

        //模拟异步请求
        $task = ABSPATH . "task.php";
        $cli = "php {$task} post '{$data_json_file}'";

        $filepath = ABSPATH . "post.log";
        
        $myfile = fopen($filepath, "a");

        fwrite($myfile, date('Y-m-d H:i:s')." --". $cli . "\r\n");

        $file = popen($cli, "r");

        pclose($file);

        fclose($data_json);
        chmod($data_json_file, 0777);

        fclose($myfile);
        chmod($filepath, 0777);

        return $this->success("发起成功！");
    }

    //模拟进行异步调用
    public function asyncPostJson($request)
    {
        $accept_param = $request['json'];

        $lang = isset($request['lang']) ? $request['lang'] : 'en';

        $param = json_decode($accept_param, true);
        if (!empty($param)) {
            $data = $param['data'];

            $returnResult = [];

            foreach ($data as $key => $value) {

                //转换category_id为系统的分类id
                $data = Db::name('termmeta')->field('term_id')->where('meta_key', 'tonpal_cid')->where('meta_value', $value['category_id'])->find();
                
                $category_id = $data['term_id'];

                //转换tags_id为系统的tag_id
                
                $tag_ids = [];
                
                foreach($value['tags'] as $k => $tag)
                {
                    $tag_result = Db::name('termmeta')->field('term_id')->where('meta_key', 'tonpal_tid')->where('meta_value', $tag)->find();
                    if(!empty($tag_result))
                    {
                        $tag_ids[] = $tag_result['term_id'];
                    }
                }
                
                if(empty($category_id))
                {
                    return $this->error("分类不存在！",['category_id'=>$value['category_id']]);
                }

                $add_post = [
                    'post_title'       => $value['title'],
                    'post_name'        => $value['slug'],
                    'post_content'     => $value['content'],
                    'post_status'      => 'publish',
                    'post_excerpt'     => $value['excerpt'],
                    'meta_input' => [
                        'seo_title' => $value['seo_title'],
                        'seo_description' => $value['seo_description'],
                        'seo_keywords' => $value['seo_keywords'],
                        'thumbnail' => $value['thumbnail'],
                        'list_order' => $value['list_order']
                    ],
                    'category_id' => [
                        $category_id
                    ],
                    'tags_input' => $tag_ids
                ];

                
                $post = Db::name('posts')->where('post_title',$value['title'])->find();
                
                if(empty($post))
                {
                    $post_id = wp_insert_post($add_post);
                    
                }else{
                    $add_post['ID'] = $post['ID'];
                    $post_id = wp_update_post($add_post);
                }

                add_post_meta($post['ID'], 'tonpal_post_id', $value['id'], true );
                $photos = $value['photos'];
                
                delete_post_meta($post['ID'],'photos');
                
                foreach($photos as $key => $photo)
                {
                    $res = add_post_meta($post['ID'], 'photos', $photo ,true );
                }

                $returnResult[$value['id']] = $post_id;

            }

            //执行回调
            $http = new WP_Http;
            $body = [
                'data' => json_encode($returnResult),
                'lang' => $lang
            ];

            $result = $http->request( 'http://tonpaladmin.aiyongbao.com/action/syncCallback',['method' => 'POST', 'body' => $body] );

            return $this->success("操作成功",$returnResult);

        }
        return $this->error("操作失败");
    }

    //同步分类
    public function syncCategory($data = [], $type)
    {
        $parentArr = [];
        $returnResult = [];

        switch ($type) {
            case 'news':
                $parentArr[2] = 2;
                $taxonomy = 'category';
                $object_key = "tonpal_cid";
                break;
            case 'product':
                $parentArr[1] = 1;
                $taxonomy = 'category';
                $object_key = "tonpal_cid";
                break;
            case 'list':
                $parentArr[0] = 0;
                $taxonomy = 'category';
                $object_key = "tonpal_cid";
                break;
            case 'tag':
                $parentArr[0] = 0;
                $taxonomy = 'post_tag';
                $object_key = "tonpal_tid";
                break;
            default:
                return $this->error('type错误！');
        }

        foreach ($data as $key => $value) {

            $args = [
                'parent'      => $parentArr[$value['parent_id']],
                'slug'        => $value['slug']
            ];

            $result = get_term_by('name', $value['name'], $taxonomy, ARRAY_A);

            if (empty($result)) {
                $arr = wp_insert_term($value['name'], $taxonomy, $args);
            } else {
                $args['name'] = $value['name'];

                if($value['slug'] ==  $args['slug'])
                {
                    unset( $args['slug'] );
                }                
                $arr = wp_update_term($result['term_id'], $taxonomy, $args);
            };

            
            //新增扩展数据
            add_term_meta($arr['term_id'], $object_key, $value['id'], true);

            //保存对应关系
            $parentArr[$value['id']] = $arr['term_id'];

            $returnResult[$value['id']] = $arr['term_id'];
        }

        return $this->success("更新成功", $returnResult);
    }
}