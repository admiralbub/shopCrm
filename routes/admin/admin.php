<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryOrchidController;
Route::post('/writesort_product', [CategoryOrchidController::class, 'editSort'])->name('admin.editSort');
Route::group(['prefix' => 'filemanager'],  function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});