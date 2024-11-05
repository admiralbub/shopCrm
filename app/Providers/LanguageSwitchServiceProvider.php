<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Admin\LangueOrchidController;
use App\Http\Middleware\LanguageSwitchOrchid;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;
use Illuminate\Support\Facades\Cache;
class LanguageSwitchServiceProvider extends OrchidServiceProvider
{
    /**
     * Register services.
    */
    public function register(): void
    {
        //
    }

    public function boot(Dashboard $dashboard): void
    {
      
        
        parent::boot($dashboard);

        $this->app->booted(function()
        {
            $this->router();
        });

        app('router')->pushMiddlewareToGroup('web', LanguageSwitchOrchid::class);
    }

    public function router(): void
    {
        if ($this->app->routesAreCached())
        {
            return;
        }

        app('router')
            ->domain((string) config('platform.domain'))
            ->middleware(config('platform.middleware.private'))
            ->name('orchid-language-switch')
            ->prefix(Dashboard::prefix('/orchid-language-switch'))
            ->get('{lang}', LangueOrchidController::class);
    }
}
