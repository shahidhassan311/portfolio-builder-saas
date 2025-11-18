<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ThemeController as AdminThemeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/preview/{id}', [HomeController::class, 'previewTheme'])->name('preview.theme');
Route::get('/select-theme/{id}', [HomeController::class, 'selectTheme'])->name('select.theme');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard update routes
    Route::post('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::post('/dashboard/about', [DashboardController::class, 'updateAbout'])->name('dashboard.about.update');
    Route::post('/dashboard/contact', [DashboardController::class, 'updateContact'])->name('dashboard.contact.update');
    Route::post('/dashboard/theme', [DashboardController::class, 'updateTheme'])->name('dashboard.theme.update');

    // Skills routes
    Route::post('/dashboard/skills', [DashboardController::class, 'storeSkill'])->name('dashboard.skills.store');
    Route::put('/dashboard/skills/{id}', [DashboardController::class, 'updateSkill'])->name('dashboard.skills.update');
    Route::delete('/dashboard/skills/{id}', [DashboardController::class, 'deleteSkill'])->name('dashboard.skills.delete');

    // Projects routes
    Route::post('/dashboard/projects', [DashboardController::class, 'storeProject'])->name('dashboard.projects.store');
    Route::put('/dashboard/projects/{id}', [DashboardController::class, 'updateProject'])->name('dashboard.projects.update');
    Route::delete('/dashboard/projects/{id}', [DashboardController::class, 'deleteProject'])->name('dashboard.projects.delete');

    // Goals routes
    Route::post('/dashboard/goals', [DashboardController::class, 'storeGoal'])->name('dashboard.goals.store');
    Route::put('/dashboard/goals/{id}', [DashboardController::class, 'updateGoal'])->name('dashboard.goals.update');
    Route::delete('/dashboard/goals/{id}', [DashboardController::class, 'deleteGoal'])->name('dashboard.goals.delete');


    Route::post('/dashboard/education', [DashboardController::class, 'storeEducation'])->name('dashboard.education.store');
    Route::put('/dashboard/education/{id}', [DashboardController::class, 'updateEducation'])->name('dashboard.education.update');
    Route::delete('/dashboard/education/{id}', [DashboardController::class, 'deleteEducation'])->name('dashboard.education.delete');

    Route::post('/dashboard/experience', [DashboardController::class, 'storeExperience'])->name('dashboard.experience.store');
    Route::put('/dashboard/experience/{id}', [DashboardController::class, 'updateExperience'])->name('dashboard.experience.update');
    Route::delete('/dashboard/experience/{id}', [DashboardController::class, 'deleteExperience'])->name('dashboard.experience.delete');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('themes', AdminThemeController::class);
        Route::resource('users', AdminUserController::class);
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
    });
});

require __DIR__.'/auth.php';

// Public portfolio route (must be last to avoid conflicts)
Route::get('/{id}/{username}', [PortfolioController::class, 'show'])->name('portfolio.show');
