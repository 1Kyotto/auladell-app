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
use App\Http\Controllers\Materials\MaterialController;
use App\Http\Controllers\Orders\OrderController;
use App\Http\Controllers\Payments\PaymentController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');


//Admin
Route::middleware(['auth', \App\Http\Middleware\AuthAdmin::class])->group(function () {
    Route::get('/dashboard/orders/', [AdminController::class, 'orders'])->name('admin.order');
    Route::get('/dashboard/reports/', [AdminController::class, 'reports'])->name('admin.rerpot');
    Route::get('/dashboard/materials/', [AdminController::class, 'materials'])->name('admin.material');

    //Gestión de Productos
    Route::get('/dashboard/product/', [AdminProdController::class, 'index'])->name('admin.product');
    Route::post('/dashboard/product/store', [AdminProdController::class, 'store'])->name('admin.product.store');
    Route::post('/dashboard/product/store-step1', [AdminProdController::class, 'storeStep1'])->name('admin.products.store-step1');

    Route::patch('/dashboard/product/{product}/toggle-status', [AdminProdController::class, 'toggleStatus'])->name('admin.product.toggle-status');

    Route::get('/dashboard/product/{productId}/customizations', [AdminProdController::class, 'getCustomizations'])->name('admin.products.customizations');
    Route::delete('/dashboard/product/customization/{id}', [AdminProdController::class, 'deleteCustomization'])->name('admin.products.customization.delete');
    
    Route::get('/dashboard/customization/{customization}/options', [AdminProdController::class, 'getCustomizationOptions'])->name('admin.products.customization-options');
    Route::post('/dashboard/product/store-customization', [AdminProdController::class, 'store'])->name('admin.products.store-customization');

    Route::get('/dashboard/product/{product}/edit', [AdminProdController::class, 'edit'])->name('admin.product.edit');
    Route::put('/dashboard/product/{product}/update', [AdminProdController::class, 'update'])->name('admin.product.update');

    Route::delete('/dashboard/product/{id}', [AdminProdController::class, 'destroy'])->name('admin.product.destroy');
    
    //Gestion de Materiales
    Route::get('/dashboard/materials', [MaterialController::class, 'index'])->name('admin.materials');
    Route::post('/dashboard/materials', [MaterialController::class, 'store'])->name('admin.materials.store');
    Route::get('/dashboard/materials/{material}/edit', [MaterialController::class, 'edit'])->name('admin.materials.edit');
    Route::put('/dashboard/materials/{material}', [MaterialController::class, 'update'])->name('admin.materials.update');
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

Route::middleware('auth')->group(function () {
    //Logout
    Route::post('', [LogoutController::class, 'logout'])->name('user.logout');
    //
});

//Productos
Route::get('/jewelry/{type?}', [UserProdController::class, 'index'])->name('jewelry.index');
Route::get('/jewelry/product/{id}', [UserProdController::class, 'show'])->name('jewelry.show');
//

//Carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout/information', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/checkout/payment', [CartController::class, 'payment'])->name('cart.payment');
Route::put('/checkout/payment', [CartController::class, 'updateGuest'])->name('cart.update.guest');
//

//Pagos
Route::post('/checkout/payment', [PaymentController::class, 'store'])->name('payment.store');
//

//Pedidos
Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('admin.order');
Route::get('/dashboard/order/{order}', [OrderController::class, 'show'])->name('admin.order.show');
Route::put('/dashboard/order/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.order.status');

Route::get('/order-status', [OrderController::class, 'orderNumber'])->name('order.number');
Route::post('/status', [OrderController::class, 'status'])->name('order.status');
//