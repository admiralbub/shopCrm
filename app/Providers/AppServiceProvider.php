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

use App\Interfaces\WishlistInterface;
use App\Services\WishlistService;

use App\Interfaces\CompareInterface;
use App\Services\CompareService;

use Illuminate\Pagination\Paginator;
use Orchid\Support\Facades\Dashboard;
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
        Dashboard::useModel(
            \Orchid\Platform\Models\User::class,
            \App\Models\User::class
        );
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

        $this->app->bind(
            WishlistInterface::class,
            WishlistService::class,

        );

        $this->app->bind(
            CompareInterface::class,
            CompareService::class,

        );

        
        
    }


}
