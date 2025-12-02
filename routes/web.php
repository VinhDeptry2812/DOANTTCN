<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


Route::get('/', [HomePageController::class, 'index'])->name('homepage');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');