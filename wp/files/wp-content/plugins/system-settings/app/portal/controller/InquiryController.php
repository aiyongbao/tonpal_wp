<?php
namespace app\portal\controller;
use library\controller\RestController;
use library\Db;

class InquiryController extends RestController{
    
    //初始化sql语句
    public function initSql($prefix = 'wp_')
    {
        global $wpdb;
        $sql = <<<EOT
        DROP TABLE IF EXISTS `{$wpdb->prefix}inquiry`;
        CREATE TABLE `{$wpdb->prefix}inquiry` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(20) DEFAULT NULL,
          `email` varchar(100) DEFAULT NULL,
          `phone` varchar(20) DEFAULT NULL,
          `message` text,
          `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
          `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
EOT;
        dbDelta($sql);
    }

    public function index($request)
    {
        $post_name = isset($request['post_name']) ? $request['post_name'] : "";
        $name = $request['name'];
        $email = isset($request['email']) ? $request['email'] : "";
        if(empty($email)){
            return $this->error('邮箱不能为空！');
        }
        $phone = isset($request['phone']) ? $request['phone'] : "";
        $message = isset($request['message']) ? $request['message'] : "";
        $reference = isset($request['reference']) ? $request['reference'] : "";
        if(empty($reference)){
            return $this->error('reference不能为空！');
        }

        $result = Db::name('inquiry')->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ]);
        
        if($result !== false)
        {

            $url = 'http://tonpal.aiyongbao.com/action/savemessage';
            $params = [
                'callback' => 'callback2020',
                'product_title' => $post_name,
                'contact_name' => $name,
                'contact_email' => $email,
                'contact_subject' => $phone,
                'contact_comment' => $message,
                'reference' => $reference,
                'organization_id' => get_option('organization_id')
            ];
            $params = http_build_query($params);
            $res = wp_remote_get($url. '?'.$params);
            return $this->success("提交成功");
        }
        else{
            return $this->error("提交失败");
        }

    }
}