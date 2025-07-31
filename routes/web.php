<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReaderDashboardController;
use App\Http\Controllers\EditorDashboardController;
use App\Http\Controllers\UserController;

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Login/Logout routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Change password routes (accessible pour les utilisateurs connectés)
Route::middleware('auth')->group(function () {
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

// Routes protégées par l'authentification et le changement de mot de passe obligatoire
Route::middleware(['auth', 'first.login'])->group(function () {
    
    // Dashboard Admin (accessible seulement aux admins)
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Users management (admin only)
        Route::get('/users', function() { return 'Users list'; })->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        
        // Utilisateurs routes (French) - admin only
        Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');
        Route::get('/utilisateurs/{user}/modifier', [UserController::class, 'edit'])->name('utilisateurs.edit');
        Route::put('/utilisateurs/{user}', [UserController::class, 'update'])->name('utilisateurs.update');
        Route::delete('/utilisateurs/{user}', [UserController::class, 'destroy'])->name('utilisateurs.destroy');
        
        // Reports (admin only)
        Route::get('/reports', function() { return 'Admin Reports page'; })->name('reports.index');
    });

    // Dashboard Éditeur (accessible aux éditeurs et admins)
    Route::middleware('role:editeur,admin')->group(function () {
        Route::get('/editor/dashboard', [EditorDashboardController::class, 'index'])->name('editor.dashboard');
        
        // Routes spécifiques aux éditeurs
        Route::prefix('editor')->name('editor.')->group(function () {
            Route::get('/documents', function() { return 'Editor Documents'; })->name('documents.index');
            Route::get('/documents/create', function() { return 'Create Document'; })->name('documents.create');
            Route::get('/revisions', function() { return 'Editor Revisions'; })->name('revisions.index');
            Route::get('/statistics', function() { return 'Editor Statistics'; })->name('statistics.index');
        });
    });

    // Dashboard Lecteur (accessible à tous les rôles connectés)
    Route::get('/reader/dashboard', [ReaderDashboardController::class, 'index'])->name('reader.dashboard');
    
    // Routes spécifiques aux lecteurs (accessible à tous)
    Route::prefix('reader')->name('reader.')->group(function () {
        Route::get('/documents', function() { return 'Reader Documents'; })->name('documents.index');
        Route::get('/favorites', function() { return 'Reader Favorites'; })->name('favorites.index');
        Route::get('/profile', function() { return 'Reader Profile'; })->name('profile.show');
    });
    
    // Routes communes accessibles à tous les utilisateurs connectés
    Route::get('/profile/edit', function() { return 'Edit Profile'; })->name('profile.edit');
    Route::get('/notifications', function() { return 'Notifications'; })->name('notifications.index');
});
