<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuth\LogoutController;
use App\Http\Controllers\CustomerAuth\AuthController;
use App\Http\Controllers\CustomerAuth\RegisterController;
use App\Http\Controllers\CabinetUser\ProfileController;
use App\Http\Controllers\CabinetUser\PasswordChangeController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\GuestionUser;
use App\Http\Middleware\AuthUser;
require __DIR__ . '/admin/admin.php';
$market = parse_url(config('app.url'), PHP_URL_HOST);
Route::group([
    //'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect'],
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','web'],
    'domain' => $market,
    'prefix' => \LaravelLocalization::setLocale()
], function () {
    Route::group(['prefix' => 'products'], function () {
        Route::get('/{slug}', CategoryController::class)->name('product.category');
    });


    Route::get('/', function () {
        return view('index');
    })->name('index');;
    Route::group(['middleware' => ['auth_user']], function () {
        Route::get('/signout', LogoutController::class)->name('auth.signout');
        Route::get('/profile', ProfileController::class)->name('profile');

        Route::post('/profile', [ProfileController::class, 'getUpdate'])->name('profile.edit');
        Route::get('/change_password', PasswordChangeController::class)->name('change_password');
        Route::post('/change_password', [PasswordChangeController::class,'updatePassword'])->name('change_password.update');
        
        
    });
    Route::group(['middleware' => ['guestion_user']], function () {
        Route::get('/auth', AuthController::class)->name('auth.enter');
        Route::post('/auth', [AuthController::class,'getAuth'])->name('auth.get');
        Route::get('/register', RegisterController::class)->name('register');
        Route::post('/register', [RegisterController::class,'getRegister'])->name('register.get');
        
        
    });
});
