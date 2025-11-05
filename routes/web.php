<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\ContactController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/ordernow', [App\Http\Controllers\OrderController::class, 'index'])->name('ordernow');
Route::post('/order', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
Route::post('/order/create-session', [App\Http\Controllers\OrderController::class, 'createStripeSession'])->name('order.createSession');
Route::get('/order/payment-success', [App\Http\Controllers\OrderController::class, 'paymentSuccess'])->name('order.payment.success');

// Contact form routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin authentication routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected admin routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
        
        // Contact management routes
        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts');
        Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
        Route::post('/contacts/{id}/toggle-read', [AdminContactController::class, 'toggleRead'])->name('contacts.toggleRead');
        Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
        
        // Order management routes
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
    });
});

// API route for getting settings (for ordernow page)
Route::get('/api/settings', [AdminController::class, 'getSettings'])->name('api.settings');
