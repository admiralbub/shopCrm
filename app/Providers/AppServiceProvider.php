<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CategoryInterface;
use App\Services\CategoryService;

use App\Interfaces\ProductShowInterface;
use App\Services\ProductShowService;

use App\Interfaces\BrandInterface;
use App\Services\BrandService;

use App\Interfaces\BasketInterface;
use App\Services\BasketService;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        $this->app->bind(
            CategoryInterface::class,
            CategoryService::class,

        );
        $this->app->bind(
            ProductShowInterface::class,
            ProductShowService::class,

        );

        $this->app->bind(
            BrandInterface::class,
            BrandService::class,

        );

        $this->app->bind(
            BasketInterface::class,
            BasketService::class,

        );
        
    }


}
