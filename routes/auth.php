<?php

use App\Http\Controllers\Auth\AuthContorller;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthContorller::class, 'login'])->name('login');
    Route::get('logout', [AuthContorller::class, 'logout'])->middleware('auth')->name('logout');
});
