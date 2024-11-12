<?php

declare(strict_types=1);


use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\Brand\BrandScreen;
use App\Orchid\Screens\Brand\BrandEditScreen;

use App\Orchid\Screens\Category\CategoryListScreen;
use App\Orchid\Screens\Category\CategoryEditScreen;

use App\Orchid\Screens\Price\PriceListScreen;
use App\Orchid\Screens\Price\PriceEditScreen;

use App\Orchid\Screens\Product\ProductListScreen;
use App\Orchid\Screens\Product\ProductEditScreen;

use App\Orchid\Screens\Pack\PackListScreen;
use App\Orchid\Screens\Pack\PackEditScreen;

use App\Orchid\Screens\AttrGroup\AttrGroupListScreen;
use App\Orchid\Screens\AttrGroup\AttrGroupEditScreen;

use App\Orchid\Screens\Attr\AttrListScreen;
use App\Orchid\Screens\Attr\AttrEditScreen;

use App\Orchid\Screens\MainSlider\MainSliderEditScreen;
use App\Orchid\Screens\MainSlider\MainSliderListScreen;

use App\Orchid\Screens\Page\PageEditScreen;
use App\Orchid\Screens\Page\PageListScreen;
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->first_name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

        
Route::screen('/brands', BrandScreen::class)
    ->name('platform.brands.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Brand'), route('platform.brands.list')));



Route::screen('brands/{brand}/edit', BrandEditScreen::class)
    ->name('platform.brand.edit')
    ->breadcrumbs(fn (Trail $trail, $brand) => $trail
        ->parent('platform.brands.list')
        ->push($brand->name_ua, route('platform.brand.edit', $brand)));

Route::screen('brands/create', BrandEditScreen::class)
    ->name('platform.brand.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.brands.list')
        ->push(__('Edit'), route('platform.brand.create')));

Route::screen('/categories', CategoryListScreen::class)
    ->name('platform.catogories.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Catogories'), route('platform.catogories.list')));
 
Route::screen('categories/{category}/edit', CategoryEditScreen::class)
    ->name('platform.category.edit')
    ->breadcrumbs(fn (Trail $trail, $category) => $trail
        ->parent('platform.catogories.list')
        ->push($category->name_ua, route('platform.category.edit', $category)));
    
Route::screen('categories/create', CategoryEditScreen::class)
    ->name('platform.categories.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.catogories.list')
        ->push(__('Catogories'), route('platform.categories.create')));



///////
Route::screen('/prices', PriceListScreen::class)
    ->name('platform.prices.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Price variation'), route('platform.prices.list')));
 
Route::screen('prices/{price}/edit', PriceEditScreen::class)
    ->name('platform.price.edit')
    ->breadcrumbs(fn (Trail $trail, $price) => $trail
        ->parent('platform.prices.list')
        ->push($price->name_ua, route('platform.price.edit', $price)));
    
Route::screen('prices/create', PriceEditScreen::class)
    ->name('platform.price.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.prices.list')
        ->push(__('Add price'), route('platform.price.create')));

///////
Route::screen('/products', ProductListScreen::class)
    ->name('platform.products.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Goods'), route('platform.products.list')));
 
Route::screen('products/{product}/edit', ProductEditScreen::class)
    ->name('platform.product.edit')
    ->breadcrumbs(fn (Trail $trail, $product) => $trail
        ->parent('platform.products.list')
        ->push($product->name_ua, route('platform.product.edit', $product)));
    
Route::screen('products/create', ProductEditScreen::class)
    ->name('platform.product.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.products.list')
        ->push(__('Add product'), route('platform.price.create')));

///////
Route::screen('/packs', PackListScreen::class)
    ->name('platform.packs.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Pack'), route('platform.packs.list')));
 
Route::screen('packs/{pack}/edit', PackEditScreen::class)
    ->name('platform.pack.edit')
    ->breadcrumbs(fn (Trail $trail, $pack) => $trail
        ->parent('platform.packs.list')
        ->push($pack->name_ua, route('platform.pack.edit', $pack)));
    
Route::screen('packs/create', PackEditScreen::class)
    ->name('platform.pack.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.packs.list')
        ->push(__('Add pack'), route('platform.pack.create')));

///////Attr Group
Route::screen('/attrgroups', AttrGroupListScreen::class)
    ->name('platform.attrgroup.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Attribute group'), route('platform.attrgroup.list')));
 
Route::screen('attrgroups/{attrgroup}/edit', AttrGroupEditScreen::class)
    ->name('platform.attrgroup.edit')
    ->breadcrumbs(fn (Trail $trail, $attr) => $trail
        ->parent('platform.attrgroup.list')
        ->push($attr->name_ua, route('platform.attrgroup.edit', $attr)));
    
Route::screen('attrgroups/create', AttrGroupEditScreen::class)
    ->name('platform.attrgroup.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.attrgroup.list')
        ->push(__('Add attribute group'), route('platform.attrgroup.create')));


///////Attr
Route::screen('/attrs', AttrListScreen::class)
    ->name('platform.attr.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Attribute'), route('platform.attr.list')));
 
Route::screen('attrs/{attr}/edit', AttrEditScreen::class)
    ->name('platform.attr.edit')
    ->breadcrumbs(fn (Trail $trail, $attr) => $trail
        ->parent('platform.attr.list')
        ->push($attr->name_ua, route('platform.attr.edit', $attr)));
    
Route::screen('attrs/create', AttrEditScreen::class)
    ->name('platform.attr.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.attr.list')
        ->push(__('Add attribute'), route('platform.attr.create')));

///////Main slider
Route::screen('/mainsliders', MainSliderListScreen::class)
    ->name('platform.mainslider.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Sliders'), route('platform.mainslider.list')));
 
Route::screen('mainsliders/{mainslider}/edit', MainSliderEditScreen::class)
    ->name('platform.mainslider.edit')
    ->breadcrumbs(fn (Trail $trail, $mainslider) => $trail
        ->parent('platform.mainslider.list')
        ->push(__("Edit slider"), route('platform.mainslider.edit', $mainslider)));
    
Route::screen('mainsliders/create', MainSliderEditScreen::class)
    ->name('platform.mainslider.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.mainslider.list')
        ->push(__('Add slider'), route('platform.mainslider.create')));

///////Page
Route::screen('/pages', PageListScreen::class)
    ->name('platform.page.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Pages'), route('platform.page.list')));
 
Route::screen('pages/{page}/edit', PageEditScreen::class)
    ->name('platform.page.edit')
    ->breadcrumbs(fn (Trail $trail, $page) => $trail
        ->parent('platform.page.list')
        ->push(__("Edit page"), route('platform.page.edit', $page)));
    
Route::screen('pages/create', PageEditScreen::class)
    ->name('platform.page.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.page.list')
        ->push(__('Add page'), route('platform.page.create')));