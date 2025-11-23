<?php

use App\Http\Controllers\AcountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard'); // admin.dashboard
});

Route::middleware(['auth', 'admin'])->prefix('categories')->controller(CategoryController::class)->name('categories.')->group(function () {
    Route::get('/', 'index')->name('index'); // categories.index
    Route::get('/create','create')->name('create');
    Route::post('/','store')->name('store');
    Route::get('/{id}','edit')->name('edit');
    Route::put('/{id}','update')->name('update');
    Route::delete('/{id}/delete','delete')->name('delete');
});


Route::middleware(['auth', 'admin'])->prefix('product')->controller(ProductController::class)->name('product.')->group(function () {
    Route::get('/', 'index')->name('index'); // product.index
    Route::get('/create','create')->name('create');
    Route::post('/','store')->name('store');
    Route::get('/{id}','edit')->name('edit');
    Route::put('/{id}','update')->name('update');
    Route::delete('/{id}/delete','delete')->name('delete');
});

Route::middleware(['auth', 'admin'])->prefix('acount')->controller(AcountController::class)->name('acount.')->group(function () {
    Route::get('/admin', 'index')->name('index'); // acount.index 
    Route::get('/manager', 'indexM')->name('indexM'); // acount.indexM
    Route::get('/user', 'indexU')->name('indexU'); // acount.indexU
    Route::get('/{id}','edit')->name('edit');
    Route::put('/{id}','update')->name('update');
    Route::delete('/{id}/delete','delete')->name('delete');
});

Route::middleware(['auth', 'admin'])->prefix('voucher')->controller(VoucherController::class)->name('voucher.')->group(function () {
    Route::get('/', 'index')->name('index'); // voucher.index
    Route::get('/create','create')->name('create');
    Route::post('/','store')->name('store');
    Route::get('/{id}','edit')->name('edit');
    Route::put('/{id}','update')->name('update');
    Route::delete('/{id}/delete','delete')->name('delete');
});
