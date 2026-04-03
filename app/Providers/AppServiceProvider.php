<?php

namespace App\Providers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('categories', Categories::all());
        View::share('products', Products::all());
    }
}
