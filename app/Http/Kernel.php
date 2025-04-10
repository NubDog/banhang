<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // … (các thuộc tính $middleware, $middlewareGroups)

    // Tìm mảng $routeMiddleware hoặc $middlewareAliases và thêm dòng này
    protected $middlewareAliases = [
        // Các middleware khác...
        'adminLogin' => \App\Http\Middleware\AdminLoginMiddleware::class,
    ];

    // Hoặc nếu là phiên bản Laravel cũ hơn:
    protected $routeMiddleware = [
        // Các middleware khác...
        'adminLogin' => \App\Http\Middleware\AdminLoginMiddleware::class,
    ];
}