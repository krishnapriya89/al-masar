<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AuthController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\OrderController;
use Modules\Admin\Http\Controllers\StateController;
use Modules\Admin\Http\Controllers\ReportController;
use Modules\Admin\Http\Controllers\VendorController;
use Modules\Admin\Http\Controllers\AboutUsController;
use Modules\Admin\Http\Controllers\ContactController;
use Modules\Admin\Http\Controllers\CountryController;
use Modules\Admin\Http\Controllers\PaymentController;
use Modules\Admin\Http\Controllers\ProductController;
use Modules\Admin\Http\Controllers\CurrencyController;
use Modules\Admin\Http\Controllers\HowToBuyController;
use Modules\Admin\Http\Controllers\ProviderController;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\QuotationController;
use Modules\Admin\Http\Controllers\WhyChooseController;
use Modules\Admin\Http\Controllers\HomeBannerController;
use Modules\Admin\Http\Controllers\AdminConfigController;
use Modules\Admin\Http\Controllers\SiteSettingsController;
use Modules\Admin\Http\Controllers\PrivacyPolicyController;
use Modules\Admin\Http\Controllers\TaxManagementController;
use Modules\Admin\Http\Controllers\ContactEnquiryController;
use Modules\Admin\Http\Controllers\ProductGalleryController;
use Modules\Admin\Http\Controllers\ProviderDetailController;
use Modules\Admin\Http\Controllers\ProductSubCategoryController;
use Modules\Admin\Http\Controllers\TermsAndConditionsController;
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
        //currency
        Route::resource('currency',CurrencyController::class);
        //payment
        Route::resource('payment',PaymentController::class);
        //provider
        Route::resource('provider',ProviderController::class);
        Route::get('provider/{provider}/provider-detail', [ProviderDetailController::class, 'index'])->name('provider-detail.index');
        Route::get('provider/{provider}/provider-detail/create', [ProviderDetailController::class, 'create'])->name('provider-detail.create');
        Route::post('provider/{provider}/provider-detail', [ProviderDetailController::class, 'store'])->name('provider-detail.store');
        Route::post('provider/{provider}/provider-detail/update', [ProviderDetailController::class, 'update'])->name('provider-detail.update');
        Route::delete('provider/{provider}/provider-detail/{provider_detail}', [ProviderDetailController::class, 'destroy'])->name('provider-detail.destroy');
        // Site Settings
        Route::get('site-settings',[TaxManagementController::class,'edit'])->name('site-settings.edit');
        Route::post('site-settings/update/{id}',[TaxManagementController::class,'update'])->name('site-settings.update');
        //product and related data routes
        //main category
        Route::resource('product-main-category', ProductMainCategoryController::class);
        Route::resource('product-sub-category', ProductSubCategoryController::class);

        Route::get('get-parent-sub-categories/{category}', [ProductMainCategoryController::class, 'getParentSubCategories'])->name('get-parent-sub-categories');
        Route::get('get-child-sub-categories/{sub_category}', [ProductMainCategoryController::class, 'getChildSubCategories'])->name('get-child-sub-categories');

        //product
        Route::resource('product', ProductController::class);
        //product gallery
        Route::get('product/{product}/gallery', [ProductGalleryController::class, 'index'])->name('product-gallery.index');
        Route::get('product/{product}/gallery/create', [ProductGalleryController::class, 'create'])->name('product-gallery.create');
        Route::post('product/{product}/gallery/store', [ProductGalleryController::class, 'store'])->name('product-gallery.store');
        Route::get('product/{product}/gallery/{gallery}/edit', [ProductGalleryController::class, 'edit'])->name('product-gallery.edit');
        Route::put('product/{product}/gallery/{gallery}/update', [ProductGalleryController::class, 'update'])->name('product-gallery.update');
        Route::delete('product/{product}gallery/{gallery}', [ProductGalleryController::class, 'destroy'])->name('product-gallery.destroy');

        // quotation management
        Route::get('quotation-management', [QuotationController::class, 'index'])->name('quotation-management.index');
        Route::post('quotation-management/change-quotation-status', [QuotationController::class, 'changeQuotationStatus'])->name('quotation-management.change-quotation-status');
        Route::post('quotation-management/change-quotation-detail-status', [QuotationController::class, 'changeQuotationDetailStatus'])->name('quotation-management.change-quotation-detail-status');
        //Order Management
        Route::get('order', [OrderController::class,'index'])->name('order.index');
        Route::get('order/{uid}', [OrderController::class,'show'])->name('order.details');
        //accept or reject the order
        Route::post('accept-or-reject-order', [OrderController::class,'acceptOrRejectOrder'])->name('accept-or-reject-order');
        //change order status to shipped or delivered
        Route::post('order/change-status', [OrderController::class,'updateOrderStatus'])->name('order.change-status');

        // user management
        Route::resource('user-management', UserController::class);
        //change status
        Route::post('change-status',[UserController::class,'changeStatus'])->name('user-management.change-status');
        //verify user
        Route::post('verify-user',[UserController::class,'VerifyUser'])->name('user-management.verify-user');

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

        //Reports
        Route::get('report', [ReportController::class,'orderReport'])->name('report.index');
        Route::get('report/order-export', [ReportController::class, 'orderReportExport'])->name('report.export');

    });

    Route::fallback(function () {
        if (request()->is('al-masar-admin-auth/*')) {
            return response()->view('admin::errors.404', [], Response::HTTP_NOT_FOUND);
        }
    });
});
