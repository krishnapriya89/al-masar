<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Modules\Frontend\Http\Controllers\AuthController;
use Modules\Frontend\Http\Controllers\HomeController;
use Modules\Frontend\Http\Controllers\UserController;
use Modules\Frontend\Http\Controllers\ProductController;
use Modules\Frontend\Http\Controllers\QuotationController;
use Modules\Frontend\Http\Controllers\QuoteController;

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
Route::get('change-currency/{country}', [HomeController::class, 'changeCurrency'])->name('change-currency');

//user registration and login
Route::get('/register', [AuthController::class,'showRegisterForm'])->name('user.register.form');
Route::post('/register-store', [AuthController::class,'register'])->name('user.register.store');
Route::get('/verify-phone', [AuthController::class,'showPhoneVerificationForm'])->name('user.show-phone-verification.form');
Route::post('/verify-phone-store', [AuthController::class,'verifyPhone'])->name('user.verify-phone');
Route::get('/verify-office-phone', [AuthController::class,'showOfficePhoneVerificationForm'])->name('user.show-office-phone-verification.form');
Route::post('/verify-office-phone-store', [AuthController::class,'verifyOfficePhone'])->name('user.verify-office-phone');
Route::post('/resend-otp', [AuthController::class,'resendOtp'])->name('user.resend-otp');
Route::get('/login', [AuthController::class,'showLoginForm'])->name('user.login.form');
Route::post('/login-otp', [AuthController::class, 'login'])->name('user.login');
Route::post('/resend-login-otp', [AuthController::class,'resendLoginOtp'])->name('user.resend-login-otp');
Route::post('/verify-login-otp', [AuthController::class, 'verifyLoginOtp'])->name('user.verify-login-otp');
//email verification
Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('user.email.verify');

Route::group(['middleware' => 'auth.user'], function () {
    //cms
    //about
    Route::get('about',[HomeController::class,'about'])->name('about');
    //privacy policy
    Route::get('privacy-policy',[HomeController::class,'privacyPolicy'])->name('privacy-policy');
    //Terms And conditions
    Route::get('terms-and-conditions',[HomeController::class,'termsAndConditions'])->name('terms-and-conditions');
    //store contact enquiry
    Route::post('contact-enquiry',[HomeController::class,'storeContact'])->name('contact-enquiry');

    //E-commerce
    //product
    Route::get('/product',[ProductController::class,'products'])->name('product');
    Route::post('/product-list-search',[ProductController::class,'listSearch'])->name('product-list-search');
    Route::post('/calculate-price',[ProductController::class,'calculatePrice'])->name('calculate-price');
    //product detail
    Route::get('product-detail/{slug}',[ProductController::class,'productDetailPage'])->name('product-detail');

    //quote functionalities
    Route::get('/quote',[QuoteController::class, 'index'])->name('quote');
    Route::post('/add-to-quote',[QuoteController::class, 'addToQuote'])->name('add-to-quote');
    Route::post('/update-quote',[QuoteController::class, 'updateQuote'])->name('update-quote');
    Route::post('/remove-from-quote',[QuoteController::class, 'removeFromQuote'])->name('remove-from-quote');
    Route::get('/clear-quote',[QuoteController::class, 'quoteEmpty'])->name('clear-quote');
    Route::get('/submit-quote',[QuoteController::class, 'submitQuote'])->name('user.submit-quote');

    //quotation functionalities
    Route::get('/quotation',[QuotationController::class, 'index'])->name('user.quotation');
    Route::post('/vendor-action',[QuotationController::class, 'vendorAction'])->name('user.quotation.vendor-action');
    Route::get('/submit-quotation',[QuotationController::class, 'submitQuotation'])->name('user.submit-quotation');

    //notify-me
    Route::post('notify-me',[ProductController::class,'notifyMe'])->name('notify-me');
    //notify-user
    Route::get('notify-user',[HomeController::class,'notifyUser'])->name('notify-user');

    //user
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    //Address
    Route::get('address',[UserController::class,'newAddress'])->name('address');
    //add-billing-address
    Route::get('add-billing-address',[UserController::class,'addBillingAddress'])->name('add-billing-address');
    Route::post('add-billing-address',[UserController::class,'storeBillingAddress'])->name('store-billing-address');
    Route::get('edit-billing-address/{id}', [UserController::class, 'editBillingAddress'])->name('edit-billing-address');
    Route::post('edit-billing-address/{billing_address}', [UserController::class, 'updateBillingAddress'])->name('update-billing-address');
    //shipping-address
    Route::get('add-shipping-address',[UserController::class,'addShippingAddress'])->name('add-shipping-address');
    Route::post('store-shipping-address',[UserController::class,'storeShippingAddress'])->name('store-shipping-address');
    Route::get('edit-shipping-address/{id}', [UserController::class, 'editShippingAddress'])->name('edit-shipping-address');
    Route::post('edit-shipping-address/{shipping_address}', [UserController::class, 'updateShippingAddress'])->name('update-shipping-address');
    //is default change
    Route::post('/update-default',[UserController::class,'updateDefault'])->name('update-default');
    //destroy address
    Route::post('/address-destroy',[UserController::class,'destroyAddress'])->name('address-destroy');
    //product-search
    Route::get('product-search',[ProductController::class,'searchProduct'])->name('product-search');
});
//home
Route::get('/',[HomeController::class,'index'])->name('home');
