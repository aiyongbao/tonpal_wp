<?php

//middleware逻辑代码
use App\Http\Kernel;

class middleware{


    protected $stacks;

    public function __construct($stacks = null)
    {
        if(!empty($stacks))
        {
            $this->stacks = $stacks;
        }
    }

    public static function run($guard = 'web')
    {
        $kernel = new Kernel();
        $middleStacks = $kernel->middlewareGroups;
        return new middleware($middleStacks[$guard]);
    }

    public function init($handler,$request)
    {
        $stacks = $this->stacks;
        $next = null;

        foreach (array_reverse($stacks) as $key => $middleware) 
        {
            
            if($key + 1 < count($stacks))
            {
                $nextStacks = function() use ($stacks, $key){
                    return new $stacks[$key + 1];
                };
            }

            else{
                $nextStacks = function() use ($handler){
                    return $handler;
                };
            }

            $class = new $stacks[$key]();
            $next = $class->handle($request,$nextStacks);
        }

        return $next;
    }
}