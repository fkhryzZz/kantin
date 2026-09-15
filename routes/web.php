<?php

use Illuminate\Support\Facades\Route;

// Redirect root ke kantin contoh
Route::redirect('/', '/kantin/kantin-pusat');

// 1. Route Publik Customer
Route::prefix('kantin/{canteen:slug}')
    ->name('customer.')
    ->group(base_path('routes/customer.php'));

// 2. Route Internal (Wajib Auth)
Route::middleware(['auth', 'verified'])->group(function (): void {

    // Route Dashboard bawaan
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Route Profile bawaan starter kit (MEMPERBAIKI 3 ERROR TERSISA)
    Route::view('/profile', 'profile')->name('profile');

    // Route Tenant
    Route::prefix('tenant/{tenant:slug}')
        ->scopeBindings()
        ->name('tenant.')
        ->group(base_path('routes/tenant.php'));

    // Route Admin
    Route::prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

require __DIR__.'/auth.php';
