public function boot()
{
    $this->configureRateLimiting();

    $this->routes(function () {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    });

    // Add this line
    Route::aliasMiddleware('adminLogin', \App\Http\Middleware\AdminLoginMiddleware::class);
}