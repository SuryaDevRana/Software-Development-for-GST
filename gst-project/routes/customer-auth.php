<?php

use App\Http\Controllers\CustomerAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:customer')->group(function () {
    Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/customer/login', [CustomerAuthController::class, 'login']);
});

Route::middleware('auth:customer')->group(function () {
    Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
});