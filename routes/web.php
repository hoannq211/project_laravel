<?php

use App\Http\Controllers\admin\AttendanceLogController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\client\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'vi'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');



Route::get('/', [HomeController::class,'index'])->name('home');

Route::get("/login", [AuthController::class, 'fromLogin'])->name("login");
Route::get("/register", [AuthController::class, 'fromRegister'])->name("register");
Route::post("/login", [AuthController::class, 'login'])->name("login");
Route::post("/register", [AuthController::class, 'register'])->name("register");
Route::get("/logout", [AuthController::class, "logout"])->name('logout');

// web.php
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::get('/verify-email/{id}', [VerifyEmailController::class, 'verifyEmail'])->name('');

Route::prefix('admin')->as('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::get('attendance-log/trash', [AttendanceLogController::class, 'trash'])->name('attendance-log.trash');
    Route::post('attendance-log/{id}/restore', [AttendanceLogController::class, 'restore'])->name('attendance-log.restore');
    Route::delete('attendance-log/{id}/force-delete', [AttendanceLogController::class, 'forceDelete'])->name('attendance-log.force-delete');
    Route::resource('attendance-log', AttendanceLogController::class);

});
