<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
/*use App\Interfaces\CategoryInterface;
use App\Services\CategoryService;*/

use App\Interfaces\ProductInterface;
use App\Services\ProductService;

use App\Interfaces\BrandInterface;
use App\Services\BrandService;

use App\Interfaces\BasketInterface;
use App\Services\BasketService;

use App\Interfaces\WishlistInterface;
use App\Services\WishlistService;

use App\Interfaces\CompareInterface;
use App\Services\CompareService;

use App\Interfaces\MainPageInterface;
use App\Services\MainPageService;

use Illuminate\Pagination\Paginator;
use Orchid\Support\Facades\Dashboard;

use App\Interfaces\PageInterface;
use App\Services\PageService;

use App\Interfaces\StockInterface;
use App\Services\StockService;

use App\Interfaces\OrderInterface;
use App\Services\OrderService;

use App\Interfaces\FeedbackInterface;
use App\Services\FeedbackService;

use App\Services\SalesdriverService;
use App\Interfaces\SalesdriverInterface;

use App\Interfaces\UserAuthManagerInterface;
use App\Services\UserAuthManagerService;

use App\Models\Setting;
use App\Models\Page;
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
        $this->app->bind(
            UserAuthManagerInterface::class,
            UserAuthManagerService::class,

        );

        $this->app->bind(
            StockInterface::class,
            StockService::class,

        );

        $this->app->bind(
            OrderInterface::class,
            OrderService::class,

        );
        Paginator::useBootstrap();
        Dashboard::useModel(
            \Orchid\Platform\Models\User::class,
            \App\Models\User::class
        );
        $this->app->bind(
            PageInterface::class,
            PageService::class,

        );

        $this->app->bind(
            MainPageInterface::class,
            MainPageService::class,

        );

        

        $this->app->bind(
            ProductInterface::class,
            ProductService::class,

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

        $this->app->bind(
            FeedbackInterface::class,
            FeedbackService::class,

        );

        $this->app->bind(
            SalesdriverInterface::class,
            SalesdriverService::class,

        );

        $this->app->singleton('settings', function () {
            return Setting::all()->pluck('value', 'key');
        });

        $this->app->singleton('pages', function () {
            return Page::available()->visible()->get();
        });
        
        
        
    }


}
