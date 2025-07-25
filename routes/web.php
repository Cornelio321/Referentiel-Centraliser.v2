<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Login/Logout routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users routes
    Route::get('/users', function() { return 'Users list'; })->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Utilisateurs routes (French)
    Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');
    Route::get('/utilisateurs/{user}/modifier', [UserController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{user}', [UserController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{user}', [UserController::class, 'destroy'])->name('utilisateurs.destroy');

    // Reports
    Route::get('/reports', function() { return 'Reports page'; })->name('reports.index');
});
