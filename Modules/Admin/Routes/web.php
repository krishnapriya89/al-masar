<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AuthController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\HomeBannerController;
use Modules\Admin\Http\Controllers\AdminConfigController;
use Modules\Admin\Http\Controllers\ProductSubCategoryController;
use Modules\Admin\Http\Controllers\ProductMainCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('al-masar-admin-auth')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => 'auth:admin', 'prevent-back-history'], function () {

         // dashboard
         Route::get('/', [DashboardController::class, 'index']);
         Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

         // config
        Route::get('config', [AdminConfigController::class, 'index'])->name('config.index');
        Route::get('config/{id}/edit', [AdminConfigController::class, 'edit'])->name('config.edit');
        Route::post('config/{id}/update', [AdminConfigController::class, 'update'])->name('config.update');

        //product and related data routes
        //main category
        Route::resource('product-main-category', ProductMainCategoryController::class);
        Route::resource('product-sub-category', ProductSubCategoryController::class);

        Route::get('get-not-last-child-sub-categories/{category}', [ProductMainCategoryController::class, 'getNotLastChildSubCategories'])->name('get-not-last-child-sub-categories');
        Route::get('get-sub-categories/{category}', [ProductMainCategoryController::class, 'getSubCategories'])->name('get-sub-categories');
        Route::get('get-sub-categories-products/{subcategories}', [ProductMainCategoryController::class, 'getSubCategoriesProducts'])->name('get-sub-categories-products');

        //Home Banner
        Route::resource('home-banner',HomeBannerController::class);
    });
});

