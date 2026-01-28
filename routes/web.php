<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    
    // POS / Session Management
    Route::post('/sessions', [App\Http\Controllers\SaunaSessionController::class, 'store'])->name('sessions.store');
    Route::post('/sessions/{sessionId}/pay', [App\Http\Controllers\SaunaSessionController::class, 'recordPayment'])->name('sessions.pay');
    Route::post('/sessions/{sessionId}/checkout', [App\Http\Controllers\SaunaSessionController::class, 'checkout'])->name('sessions.checkout');

    // Pricing Rules
    Route::resource('pricing-rules', App\Http\Controllers\PricingRuleController::class)->only(['index', 'store', 'destroy']);
    
    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    
    // Admin-only routes
    Route::middleware('can:admin')->group(function () {
        Route::resource('branches', App\Http\Controllers\BranchController::class)->only(['index', 'store', 'destroy']);
        Route::resource('users', App\Http\Controllers\UserController::class)->only(['index', 'store', 'destroy']);
    });
});
