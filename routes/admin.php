<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
    // Route::put('/{id}','update')->name('update');
    // Route::delete('/{id}/delete','delete')->name('delete');
});
