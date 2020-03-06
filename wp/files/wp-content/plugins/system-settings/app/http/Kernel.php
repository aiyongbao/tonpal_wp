<?php
namespace App\Http;
use middleware;

class Kernel extends middleware
{
    protected $middlewareGroups = [
        'api' => [
            \app\http\middleware\AdminAuth::class,
            \app\http\middleware\TestAuth::class,
        ],
    ];
}