protected $routeMiddleware = [
    // ... other middlewares
    'adminLogin' => \App\Http\Middleware\AdminLoginMiddleware::class,
];