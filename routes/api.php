<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\AuthContorller;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('login', [AuthContorller::class, 'apiLogin'])->name('login');
    });

    Route::get('categorys', [CategoryController::class, 'index'])->name('categorys');
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('show/{id}', [ProductController::class, 'show'])->name('show');
    });
});
