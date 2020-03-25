<?php
namespace app\http\middleware;
use Closure;
use library\controller\RestController;

class AdminAuth extends RestController{
    
    public function handle($request ,Closure $next)
    {

        if(!current_user_can('manage_options')){
            return $this->error('请先进行登录');
        };
        return $next();
    }

} 