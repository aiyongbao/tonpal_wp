<?php
namespace app\admin\controller;
use library\controller\RestController;
use library\Db;

class ThemeFileController extends RestController{

    static $file = [];

    public function __construct()
    {
        
    }

    //初始化sql语句
    public function initSql($prefix = 'wp_')
    {
        $sql = <<<EOT
            DROP TABLE IF EXISTS `{$prefix}theme_file`;
            CREATE TABLE `{$prefix}theme_file` (
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
            ) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;
            SET FOREIGN_KEY_CHECKS = 1;
EOT;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function index()
    {
        $result = [];
        $jsonDir = get_template_directory() . '/json';
        self::recursion($jsonDir);

        $result_mark = [];

        //更新待删除列表
        $is_del = [];


        $theme_file = Db::name('theme_file')->select();
        foreach($theme_file as $key => $value)
        {
            $is_del[] = $value['action'];
        };


        foreach(self::$file as $key => $file)
        {
            $item = file_get_contents( $file );
            $item = json_decode($item,true);
            $result = Db::name('theme_file')->where('action',$item['action'])->find();

            if(in_array($item['action'],$is_del))
            {
                unset($is_del[array_search($item['action'],$is_del)]);
            }

            if($result !== false)
            {
                $res = Db::name('theme_file')->where('id',$result['id'])->update(['more' => json_encode($item['more'] ), 'config_more' => json_encode($item['more'])]);

                $result_mark[] = [
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'type' => 'update'
                ];
            }

            else{

                $res = Db::name('theme_file')->insert(['more' => $item['more'] , 'config_more' => $item['more']]);
                $result_mark[] = [
                    'id' => $res['id'],
                    'name' => $item['name'],
                    'update' => 'insert'
                ];
            }

        }

        //删除已经删除的文件数据
        
        $delete_data = [];
        foreach($is_del as $key => $value)
        {
            array_push($delete_data,[
                'action' => $value
            ]);
        }

        if(count($delete_data) > 0)
        {
            Db::name('theme_file')->where($delete_data)->delete();
        }
        
        return $this->success('操作完成！',$result_mark);

    }

     //初始化主题
     function theme_file_init()
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
                   $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}_theme_file WHERE file = %s",$filename ) );
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
                     $res = $wpdb->insert( $wpdb->prefix .'_theme_file' ,$data);
                   }
                   else{
                     $res = $wpdb->update( $wpdb->prefix .'_theme_file' ,$data,['id' => $result->id]);
                   }
 
                   //print_r($wpdb);
                   
                 }
   
               }
             }
           }
       }

       $theme_file = Db::name('theme_file')->select();

       return $this->success('操作完成！',$theme_file);
     }

     function get_json_toArray($dir){
        $json = file_get_contents($dir);
        $data = json_decode($json,true);
        return $data;
    }

    //读取文件列表json
    public function fileList(){
        $theme_file = Db::name('theme_file')->select();
        if($theme_file !== false)
        {
            return $this->success('获取成功！',$theme_file);
        }
        else{
            return $this->error('获取失败！',$theme_file);
        }
    }

    //读取文件单项
    public function fileItem($request)
    {
        $id = $request['id'];
        $theme_file = Db::name('theme_file')->where('id',$id)->find();
        
        if($theme_file !== null)
        {
            return $this->success('获取成功！',$theme_file);
        }
        else{
            return $this->error('获取失败,数据不存在！',$theme_file);
        }
    }

    //更新文件单项
    public function updateFileItem($request)
    {
        
        $id = $request['id'];
        if(empty($id))
        {
            return $this->error("id不能为空！");
        }
        
        $config_more = $request['config_more'];
        if(empty($config_more))
        {
            return $this->error("配置文件不能为空！");
        }

        $data = ['config_more' => $config_more];
        $res = Db::name('theme_file')->where('id',$id)->update($data);       
        
        if($res != false)
        {
            return $this->success('更新成功！');
        }
        else{
            return $this->error('更新失败，目标数据不存在！');
        }

    }

    //遍历json文件列表数据
    public static function recursion($dir)
    {
        if(is_dir($dir))
        {
            $temp = scandir($dir);
            foreach($temp as $key => $value)
            {
                if($value != '.' && $value != '..'){
                 self::recursion($dir . '/' . $value);   
                }
            }
        }
        else{
            self::$file[] = $dir;
        }
    }

}