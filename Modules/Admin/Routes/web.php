<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Modules\Admin\Http\Controllers\AboutUsController;
use Modules\Admin\Http\Controllers\AuthController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\AdminConfigController;
use Modules\Admin\Http\Controllers\ContactController;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\HomeBannerController;
use Modules\Admin\Http\Controllers\HowToBuyController;
use Modules\Admin\Http\Controllers\WhyChooseController;

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

          //delete-image
        Route::post('delete-image', [AdminController::class, 'deleteImage'])->name('delete-image');

         // config
        Route::get('config', [AdminConfigController::class, 'index'])->name('config.index');
        Route::get('config/{id}/edit', [AdminConfigController::class, 'edit'])->name('config.edit');
        Route::post('config/{id}/update', [AdminConfigController::class, 'update'])->name('config.update');
        //Home Banner
        Route::resource('home-banner',HomeBannerController::class);
        //about us
        Route::get('about-us/edit',[AboutUsController::class,'edit'])->name('about-us.edit');
        Route::post('about-us/update/{id}',[AboutUsController::class,'update'])->name('about-us.update');
        //why choose
        Route::get('why-choose/edit',[WhyChooseController::class,'edit'])->name('why-choose.edit');
        Route::post('why-choose/update/{id}',[WhyChooseController::class,'update'])->name('why-choose.update');
        //How To Buy
        Route::get('how-to-buy/edit',[HowToBuyController::class,'edit'])->name('how-to-buy.edit');
        Route::post('how-to-buy/update/{id}',[HowToBuyController::class,'update'])->name('how-to-buy.update');
        //Contact
        Route::get('contact/edit',[ContactController::class,'edit'])->name('contact.edit');
        Route::post('contact/update/{id}',[ContactController::class,'update'])->name('contact.update');
    });
});

