<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\EditeurDashboardController;
use App\Http\Controllers\LecteurDashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LecteurScriptController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Login/Logout routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'password.changed'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard Éditeur
    Route::get('/editeur/dashboard', [EditeurDashboardController::class, 'index'])->name('editeur.dashboard');

    // Dashboard Lecteur
    Route::get('/lecteur/dashboard', [LecteurDashboardController::class, 'index'])->name('lecteur.dashboard');

    // Users routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Utilisateurs routes (French)
    Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');
    Route::get('/utilisateurs/{user}/modifier', [UserController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/utilisateurs/{user}', [UserController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/utilisateurs/{user}', [UserController::class, 'destroy'])->name('utilisateurs.destroy');

    // Routes pour les rapports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');

    // Routes pour les favoris
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{script}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Routes pour les profils
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Routes pour les éditeurs
    Route::prefix('editeur')->name('editeur.')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    });

    // Routes pour les lecteurs
    Route::prefix('lecteur')->name('lecteur.')->group(function () {
        Route::get('/scripts', [LecteurScriptController::class, 'index'])->name('scripts');
        Route::get('/scripts/{script}', [LecteurScriptController::class, 'show'])->name('scripts.show');
        Route::get('/favorites', [LecteurScriptController::class, 'favorites'])->name('favorites');
        Route::get('/history', [LecteurScriptController::class, 'history'])->name('history');
        Route::get('/popular', [LecteurScriptController::class, 'popular'])->name('popular');
        Route::get('/recent', [LecteurScriptController::class, 'recent'])->name('recent');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    });
});





// Routes pour le changement de mot de passe (nécessite d'être connecté)
Route::middleware('auth')->group(function () {
    // Route pour afficher le formulaire
    Route::get('/change-password', [App\Http\Controllers\ChangePasswordController::class, 'showForm'])
        ->name('password.change.form');

    // Route pour vérifier les identifiants
    Route::post('/verify-credentials', [App\Http\Controllers\ChangePasswordController::class, 'verifyCredentials'])
        ->name('password.verify');

    // Route pour soumettre le changement de mot de passe
    Route::post('/change-password', [App\Http\Controllers\ChangePasswordController::class, 'updatePassword'])
        ->name('password.change.submit');
        });




// Routes existantes...

// Routes pour la gestion des scripts
Route::prefix('scripts')->name('scripts.')->middleware(['auth', 'password.changed'])->group(function () {
    Route::get('/', [ScriptController::class, 'index'])->name('index');
    Route::get('/create', [ScriptController::class, 'create'])->name('create');
    Route::get('/active', [ScriptController::class, 'active'])->name('active');
    Route::get('/history', [ScriptController::class, 'history'])->name('history');

    // Routes additionnelles si nécessaire
    Route::post('/', [ScriptController::class, 'store'])->name('store');
    Route::get('/{id}', [ScriptController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ScriptController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ScriptController::class, 'update'])->name('update');
    Route::delete('/{id}', [ScriptController::class, 'destroy'])->name('destroy');
});
