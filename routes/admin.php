<?php

use App\Http\Controllers\AcountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard'); // admin.dashboard
});

Route::middleware(['auth', 'admin'])->prefix('admin')->controller(CategoryController::class)->name('categories.')->group(function () {
    Route::get('/categories', 'index')->name('index'); // categories.index
    Route::get('/categories/create', 'create')->name('create');
    Route::post('/categories/store', 'store')->name('store');
    Route::get('/categories/edit/{id}', 'edit')->name('edit');
    Route::put('/categories/update/{id}', 'update')->name('update');
    Route::delete('/categories/delete/{id}/delete', 'delete')->name('delete');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->controller(ProductController::class)->name('product.')->group(function () {
    Route::get('/product', 'index')->name('index'); // product.index
    Route::get('/product/create', 'create')->name('create');
    Route::post('/product/store', 'store')->name('store');
    Route::get('/product/edit/{id}', 'edit')->name('edit');
    Route::put('/product/update/{id}', 'update')->name('update');
    Route::delete('/product/delete/{id}', 'delete')->name('delete');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->controller(AcountController::class)->name('acount.')->group(function () {
    Route::get('/acount', 'index')->name('index'); // acount.index 
    Route::get('/acount/manager', 'indexM')->name('indexM'); // acount.indexM
    Route::get('/acount/user', 'indexU')->name('indexU'); // acount.indexU
    Route::get('/acount/edit/{id}', 'edit')->name('edit');
    Route::put('/acount/update/{id}', 'update')->name('update');
    Route::delete('/acount/delete/{id}', 'delete')->name('delete');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->controller(VoucherController::class)->name('voucher.')->group(function () {
    Route::get('/voucher', 'index')->name('index'); // voucher.index
    Route::get('/voucher/create', 'create')->name('create');
    Route::post('/voucher/store', 'store')->name('store');
    Route::get('/voucher/edit/{id}', 'edit')->name('edit');
    Route::put('/voucher/update/{id}', 'update')->name('update');
    Route::delete('/voucher/delete/{id}', 'delete')->name('delete');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->controller(BannerController::class)->name('banner.')->group(function () {
    Route::get('/banner', 'index')->name('index'); // banner.index 
    Route::get('/banner/create', 'create')->name('create');
    Route::post('/banner/store', 'store')->name('store');
    Route::get('/banner/edit/{id}','edit')->name('edit');
    Route::put('/banner/update/{id}','update')->name('update');
    Route::delete('/banner/delete/{id}','delete')->name('delete');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->controller(OrderController::class)->name('order.')->group(function () {
    Route::get('/order/index', 'index')->name('index'); // order.index 
    Route::get('/orders/{id}','show')->name('show');
    // Route::post('/banner/store', 'store')->name('store');
    // Route::get('/banner/edit/{id}','edit')->name('edit');
    // Route::put('/banner/update/{id}','update')->name('update');
    // Route::delete('/banner/delete/{id}','delete')->name('delete');
});


