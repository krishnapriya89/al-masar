<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Modules\Frontend\Http\Controllers\AuthController;
use Modules\Frontend\Http\Controllers\HomeController;

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

//user
Route::get('/register', [AuthController::class,'showRegisterForm'])->name('user.register.form');
Route::get('/register-store', [AuthController::class,'register'])->name('user.register.store');
Route::get('/login', [AuthController::class,'showLoginForm'])->name('user.login.form');

//home
Route::get('/',[HomeController::class,'index'])->name('home');
