<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

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

Route::get('/', [WebController::class, 'index']);
Route::get('/payment', [WebController::class, 'payment']);
Route::post('/payment', [WebController::class, 'payment_post']);

//verifikasi
Route::get('/login', [AuthController::class, 'get_login'])->name('login');
Route::get('/register', [AuthController::class, 'get_register'])->name('register');

Route::post('/login', [AuthController::class, 'post_login']);
Route::post('/register', [AuthController::class, 'post_register']);

Route::get('/email/need-verification', [VerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
