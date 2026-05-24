<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return auth()->check() ? redirect('/customers') : view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('invoices', InvoiceController::class)->names([
        'index'   => 'invoice.index',
        'create'  => 'invoice.create',
        'store'   => 'invoice.store',
        'show'    => 'invoice.show',
        'edit'    => 'invoice.edit',
        'update'  => 'invoice.update',
        'destroy' => 'invoice.destroy',
    ]);
});

// Customer Portal Routes
Route::middleware('auth:customer')->prefix('portal')->name('customer.')->group(function () {
    Route::get('/dashboard', function () {
        $invoices = auth()->user()->invoices;
        return view('customer-portal.dashboard', compact('invoices'));
    })->name('dashboard');
    
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
});

require __DIR__.'/auth.php';
require __DIR__.'/customer-auth.php';
