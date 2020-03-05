<?php
namespace app\http\middleware;
use Closure;
use library\controller\BaseController;

class AdminAuth extends BaseController{
    
    public function handle($request ,Closure $next)
    {
        //添加中间件执行代码
        // if(!current_user_can('manage_options')){
        //     return 'error cannot login';
        // };    
        return $next();
    }

} 