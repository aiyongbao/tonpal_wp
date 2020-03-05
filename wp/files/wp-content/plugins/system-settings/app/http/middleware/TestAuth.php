<?php
namespace app\http\middleware;
use Closure;
use library\controller\RestController;

class TestAuth extends RestController{
    
    public function handle($request ,Closure $next)
    {
        //添加中间件执行代码
        if(!current_user_can('manage_options')){
            return $this->error('请先进行登录');
        };
        return $next();
    }

} 