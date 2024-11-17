<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Products\UserProdController;
use App\Http\Controllers\Products\AdminProdController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\LogoutController;
use App\Http\Controllers\Users\RegisterController;
use App\Http\Controllers\Users\ForgotPasswordController;
use App\Http\Controllers\Users\ResetPasswordController;
use App\Http\Controllers\Cart\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');


//Admin
Route::middleware(['auth', \App\Http\Middleware\AuthAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/product/{category?}', [AdminController::class, 'productManagment'])->name('admin.product');

    //Gestión de Productos
    Route::get('/dashboard/new/product/create', [AdminProdController::class, 'create'])->name('product.create');
    Route::post('/dashboard/new/product/store', [AdminProdController::class, 'store'])->name('product.store');
    Route::get('/dashboard/product/{id}/edit', [AdminProdController::class, 'edit'])->name('product.edit');
    Route::put('/dashboard/product/{id}', [AdminProdController::class, 'update'])->name('product.update');
    Route::delete('/dashboard/product/{id}', [AdminProdController::class, 'destroy'])->name('product.destroy');
    Route::patch('/dashboard/product/{id}/toggle', [AdminProdController::class, 'toggleStatus'])->name('product.toggleStatus');
});
//

//Auth
Route::middleware('guest')->group(function () {
    //Login
    Route::get('/login', [LoginController::class, 'index'])->name('user.login');
    Route::post('/login', [LoginController::class, 'login']);

    //Register
    Route::get('/register', [RegisterController::class, 'index'])->name('user.register');
    Route::post('/register', [RegisterController::class, 'register']);

    //Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendEmail'])->name('password.email');

    //Reset Password
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPasswordUpdate'])->name('password.update');
});
//Logout
Route::post('', [LogoutController::class, 'logout'])->name('user.logout');
//

//Productos
Route::get('/jewelry/{type?}', [UserProdController::class, 'index'])->name('jewelry.index');
Route::get('/jewelry/{id}', [UserProdController::class, 'show'])->name('jewelry.show');
//

//Carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//