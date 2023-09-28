<?php

use Database\Seeders\PrivacyPolicySeeder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AboutUsController;
use Modules\Admin\Http\Controllers\AuthController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\AdminConfigController;
use Modules\Admin\Http\Controllers\ContactController;
use Modules\Admin\Http\Controllers\ContactEnquiryController;
use Modules\Admin\Http\Controllers\StateController;
use Modules\Admin\Http\Controllers\CountryController;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\HomeBannerController;
use Modules\Admin\Http\Controllers\HowToBuyController;
use Modules\Admin\Http\Controllers\PrivacyPolicyController;
use Modules\Admin\Http\Controllers\SiteSettingsController;
use Modules\Admin\Http\Controllers\TermsAndConditionsController;
use Modules\Admin\Http\Controllers\WhyChooseController;
use Modules\Admin\Http\Controllers\ProductController;
use Modules\Admin\Http\Controllers\ProductSubCategoryController;
use Modules\Admin\Http\Controllers\ProductMainCategoryController;
use Modules\Admin\Http\Controllers\VendorController;

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

        //master data's
        //country
        Route::resource('country', CountryController::class);
        //state
        Route::get('state/{country_id}', [StateController::class, 'index'])->name('state.index');
        Route::get('state/create/{country_id}', [StateController::class, 'create'])->name('state.create');
        Route::post('state/store', [StateController::class, 'store'])->name('state.store');
        Route::get('state/{id}/edit', [StateController::class, 'edit'])->name('state.edit');
        Route::put('state/{state}/update', [StateController::class, 'update'])->name('state.update');
        Route::delete('state/{state}', [StateController::class, 'destroy'])->name('state.destroy');
        //vendor
        Route::resource('vendor', VendorController::class);

        //product and related data routes
        //main category
        Route::resource('product-main-category', ProductMainCategoryController::class);
        Route::resource('product-sub-category', ProductSubCategoryController::class);

        Route::get('get-parent-sub-categories/{category}', [ProductMainCategoryController::class, 'getParentSubCategories'])->name('get-parent-sub-categories');
        Route::get('get-child-sub-categories/{sub_category}', [ProductMainCategoryController::class, 'getChildSubCategories'])->name('get-child-sub-categories');

        //product
        Route::resource('product', ProductController::class);

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
        //privacy policy
        Route::get('privacy-policy/edit',[PrivacyPolicyController::class,'edit'])->name('privacy-policy.edit');
        Route::post('privacy-policy/update/{id}',[PrivacyPolicyController::class,'update'])->name('privacy-policy.update');
        //terms & conditions
        Route::get('terms-and-conditions/edit',[TermsAndConditionsController::class,'edit'])->name('terms-and-conditions.edit');
        Route::post('terms-and-conditions/update/{id}',[TermsAndConditionsController::class,'update'])->name('terms-and-conditions.update');
        // site common cms
        Route::get('site-common-cms/edit',[SiteSettingsController::class,'edit'])->name('site-common-cms.edit');
        Route::post('site-common-cms/update/{id}',[SiteSettingsController::class,'update'])->name('site-common-cms.update');
        //Contact Enquiry Listing
        Route::resource('contact-enquiry-listing',ContactEnquiryController::class);
        Route::post('reply',[ContactEnquiryController::class,'addReply'])->name('contact-enquiry-listing.reply');
    });
});
