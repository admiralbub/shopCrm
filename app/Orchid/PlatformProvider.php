<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make(__('Turn around to the store'))->icon('bs.layers')->url('/'),
            Menu::make(__('Order'))
                ->icon('bs.currency-exchange')
                ->route('platform.order.list')
                ->permission('platform.systems.users'),   
            Menu::make(__('Products'))
                ->icon('bs.cart')
                ->list([
                    
                    Menu::make(__('Goods'))->route('platform.products.list'),
                    Menu::make(__('Brand'))->route('platform.brands.list'),
                    Menu::make(__('Pack'))->route('platform.packs.list'),
                    Menu::make(__('Catogories'))->route('platform.catogories.list'),
                    Menu::make(__('Stocks'))->route('platform.stock.list'),
                    Menu::make(__('Attribute'))->route('platform.attr.list'),
                   
                  //  Menu::make(__('Price variation'))->route('platform.prices.list'),
                ]),

            Menu::make(__('Feedbacks'))
                ->icon('bi.chat-fill')
                ->route('platform.feedback.list')
                ->permission('platform.systems.users'),   
            Menu::make(__('Setting'))
                ->icon('bi.tools')
                ->route('platform.setting.list')
                ->permission('platform.systems.users'),    
            Menu::make(__('Pages'))
                ->icon('bs.files')
                ->route('platform.page.list')
                ->permission('platform.systems.users'),        
            Menu::make(__('Sliders'))
                ->icon('bs.card-image')
                ->route('platform.mainslider.list')
                ->permission('platform.systems.users'),        
            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users'),
                
           
            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

           
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
