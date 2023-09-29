<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Modules\Frontend\Http\Controllers\AuthController;
use Modules\Frontend\Http\Controllers\HomeController;
use Modules\Frontend\Http\Controllers\UserController;

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

// Route::prefix('frontend')->group(function() {
//     Route::get('/', 'FrontendController@index');
// });

//user registration and login
Route::get('/register', [AuthController::class,'showRegisterForm'])->name('user.register.form');
Route::post('/register-store', [AuthController::class,'register'])->name('user.register.store');
Route::get('/verify-phone', [AuthController::class,'showPhoneVerificationForm'])->name('user.show-phone-verification.form');
Route::post('/verify-phone-store', [AuthController::class,'verifyPhone'])->name('user.verify-phone');
Route::get('/verify-office-phone', [AuthController::class,'showOfficePhoneVerificationForm'])->name('user.show-office-phone-verification.form');
Route::post('/verify-office-phone-store', [AuthController::class,'verifyOfficePhone'])->name('user.verify-office-phone');
Route::post('/resend-otp', [AuthController::class,'resendOtp'])->name('user.resend.otp');
Route::get('/login', [AuthController::class,'showLoginForm'])->name('user.login.form');
Route::post('/login-otp', [AuthController::class, 'login'])->name('user.login');
Route::post('/verify-login-otp', [AuthController::class, 'verifyLoginOtp'])->name('user.verify-login-otp');
//email verification
Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('user.email.verify');


Route::group(['middleware' => 'auth.user'], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});


//home
Route::get('/',[HomeController::class,'index'])->name('home');
//about
Route::get('about',[HomeController::class,'about'])->name('about');
//privacy policy
Route::get('privacy-policy',[HomeController::class,'privacyPolicy'])->name('privacy-policy');
//Terms And conditions
Route::get('terms-and-conditions',[HomeController::class,'termsAndConditions'])->name('terms-and-conditions');
//store contact enquiry
Route::post('contact-enquiry',[HomeController::class,'storeContact'])->name('contact-enquiry');
