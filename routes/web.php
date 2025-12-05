<?php

use App\Http\Controllers\AcountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ForgotPassWordController;

Route::get('/', [HomePageController::class, 'index'])->name('homepage');

Route::get('/product/{id}', [HomePageController::class, 'productdetail'])->name('productdetail');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::post('/ordersuccess', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

Route::get('/ordercomplete', [CheckoutController::class, 'list'])->name('checkout.list');

Route::get('/acount_info', [AcountController::class, 'acount_info'])->name('acount.info');

Route::put('/acount_info/update', [AcountController::class, 'update_info'])->name('acount.update_info');


