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

//bagian verifikasi
Route::get('/login', [AuthController::class, 'get_login'])->name('login');
Route::get('/register', [AuthController::class, 'get_register'])->name('register');

Route::post('/login', [AuthController::class, 'post_login']);
Route::post('/register', [AuthController::class, 'post_register']);

//verifikasi email
Route::get('/email//verify/need-verification', [VerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('auth', 'signed')->name('verification.verify');

//kirim link verifikasi lagi
Route::get('/email//verify/resend-verification', [VerificationController::class, 'send'])->middleware('auth', 'throttle:6,1')->name('verification.send');

//ini akan bisa diakses setelah user sudah verifikasi email, atau di database nya email_verified_at nya sudah ke isi
Route::middleware(['auth', 'auth.session', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return "selamat datang didashboard";
    });
});
