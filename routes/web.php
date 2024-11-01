<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuth\LogoutController;
use App\Http\Controllers\CustomerAuth\AuthController;
use App\Http\Controllers\CustomerAuth\RegisterController;
use App\Http\Controllers\CabinetUser\ProfileController;
use App\Http\Controllers\CabinetUser\PasswordChangeController;

use App\Http\Controllers\CabinetUser\WishlistController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\GuestionUser;
use App\Http\Middleware\AuthUser;
use App\Http\Controllers\ViewProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CompareController;

require __DIR__ . '/admin/admin.php';
$market = parse_url(config('app.url'), PHP_URL_HOST);
Route::group([
    //'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect'],
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','web'],
    'domain' => $market,
    'prefix' => \LaravelLocalization::setLocale()
], function () {
    Route::group(['prefix' => 'products'], function () {
        Route::get('/{slug}/{filter?}', CategoryController::class)->name('product.category')->where('filter', '.*');
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('/{slug}', ViewProductController::class)->name('product.view');
    });    

    Route::group(['prefix' => 'compare'], function () {
        Route::get('/', CompareController::class)->name('compare.index');
        Route::post('/add', [CompareController::class,'add'])->name('compare.add');
        Route::get('/count', [CompareController::class,'count'])->name('compare.count');
        Route::delete('/delete/{id}', [CompareController::class,'delete'])->name('compare.delete');
    });   
    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', BrandController::class)->name('product.brand.list');
    });   
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/{slug}', [BrandController::class,'show'])->name('product.brand.show');
    }); 

    Route::group(['prefix' => 'basket'], function () {
        //Route::get('/', BasketController::class)->name('basket.index');
        Route::get('/basketJson', [BasketController::class,'basketJson'])->name('basket.basketJson');
        
        Route::post('/addBasket', [BasketController::class,'addBasket'])->name('basket.addBasket');
        Route::post('/quantity', [BasketController::class,'quantity'])->name('basket.quantity');
        
        Route::get('/countBasket', [BasketController::class,'countBasket'])->name('basket.count');
        Route::delete('/deleteBasker/{id}', [BasketController::class,'deleteBasket'])->name('basket.delete');
    }); 

    Route::get('/', function () {
        return view('index');
    })->name('index');;
    Route::group(['middleware' => ['auth_user']], function () {
        Route::get('/signout', LogoutController::class)->name('auth.signout');
        

        Route::group(['prefix' => 'wislist'], function () {
            Route::post('/add', [WishlistController::class, 'addWislist'])->name('wislist.add');
            Route::delete('/delete/{id}', [WishlistController::class, 'deleteWislist'])->name('wislist.delete');
            Route::get('/count', [WishlistController::class, 'count'])->name('wislist.count');
        });
       
        Route::group(['prefix' => 'cabinet'], function () {
            Route::get('/', ProfileController::class)->name('profile');
            Route::post('/', [ProfileController::class, 'getUpdate'])->name('profile.edit');
            Route::get('/change_password', PasswordChangeController::class)->name('change_password');
            Route::post('/change_password', [PasswordChangeController::class,'updatePassword'])->name('change_password.update');
            Route::get('/wislist', WishlistController::class)->name('profile.wislist');
        });
        
        
    });
    Route::group(['middleware' => ['guestion_user']], function () {
        Route::get('/auth', AuthController::class)->name('auth.enter');
        Route::post('/auth', [AuthController::class,'getAuth'])->name('auth.get');
        Route::get('/register', RegisterController::class)->name('register');
        Route::post('/register', [RegisterController::class,'getRegister'])->name('register.get');
        
        
    });
});
