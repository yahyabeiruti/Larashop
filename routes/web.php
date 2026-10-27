<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function(){

    Route::get('/register',[AuthController::class, 'showRegisterPage'])->name('show.register');
    Route::get('/login',[AuthController::class, 'showLoginPage'])->name('show.login');
    Route::post('/register',[AuthController::class, 'Register'])->name('register');
    Route::post('/login',[AuthController::class, 'Login'])->name('login');
    
});

Route::post('/logout',[AuthController::class, 'Logout'])->name('logout');

Route::middleware('auth')->group(function (){

    Route::get('/history',[AuthController::class, 'showHistoryPage'])->name('history.show');

    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('add/cart', [CartController::class, 'addToCart'])->name('cart.add');
    
    Route::put('update/cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('remove/cart', [CartController::class, 'removeCartItem'])->name('cart.remove');
    
    Route::get('/payment', [PaymentController::class, 'showChoosePaymentPage'])->name('show.pay');
    Route::get('/payment/creditcard', [PaymentController::class, 'showCreditCardPayment'])->name('credit.pay');
    Route::Post('/payment/creditcard', [PaymentController::class, 'processCardPayment'])->name('credit.process');
    Route::get('/payment/cash', [PaymentController::class, 'showCashPayment'])->name('cash.pay');
    Route::post('/payment/cash', [PaymentController::class, 'processCashPayment'])->name('cash.process');
    Route::get('/payment/paypal', [PaymentController::class, 'showPaypalPayment'])->name('paypal.pay');
    Route::post('/payment/paypal', [PaymentController::class, 'processPaypalPayment'])->name('paypal.process');
    Route::get('/payment/wallet', [PaymentController::class, 'showWalletPayment'])->name('wallet.pay');
    Route::post('/payment/wallet', [PaymentController::class, 'processWalletPayment'])->name('wallet.process');
    
});


// Route::post('/payment', [PaymentController::class, 'processPayment']);