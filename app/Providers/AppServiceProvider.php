<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductType;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer(['layout.header'], function ($view) {
            $producttypes = ProductType::all();
            $view->with('producttypes', $producttypes);
        });
    }
}
