<?php
namespace app\admin\controller;
use library\controller\RestController;
use library\Db;

class RobotsController extends RestController{

    //创建robots.txt
    public function index(){
       $languages = Db::name('language')->where('status','1')->select();  

       $robots = ABSPATH . "robots.txt";
       $handle = fopen($robots,"w+");

       $robots = <<<EOT
User-agent: *
Disallow: /async-task/
Disallow: /html/
Disallow: /s*?
Disallow: /logs/
Disallow: /log/
Disallow: /wp-admin/
Disallow: /wp-content/
Disallow: /wp-includes/
Disallow: /readme.html
Disallow: /post.log
Sitemap: {$_SERVER['HTTP_HOST']}/sitemap.xml\r\n
EOT;

        foreach($languages as $l){
            $robots .= "Sitemap: {$_SERVER['HTTP_HOST']}/{$l['abbr']}/sitemap.xml\r\n";
        }

       fwrite($handle,$robots);
       fclose($handle);

       
       return $this->success("robots生成完成");
       
    }
}