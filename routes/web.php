<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ThemeController as AdminThemeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\BlogFeedController;
use App\Http\Controllers\ProgrammaticSeoController;
use App\Http\Controllers\RobotsController;
use Illuminate\Support\Facades\Route;

// SEO: dynamic robots.txt (do not add a static public/robots.txt)
Route::get('/robots.txt', RobotsController::class)->name('robots');

// Programmatic SEO hubs (must stay above the portfolio catch-all route)
$seoHubs = implode('|', array_keys(config('seo.programmatic_hubs', [])));
Route::get('/{hub}', [ProgrammaticSeoController::class, 'hub'])
    ->where('hub', $seoHubs)
    ->name('seo.hub');
Route::get('/{hub}/{slug}', [ProgrammaticSeoController::class, 'page'])
    ->where('hub', $seoHubs)
    ->name('seo.page');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/preview/{id}', [HomeController::class, 'previewTheme'])->name('preview.theme');
Route::get('/select-theme/{id}', [HomeController::class, 'selectTheme'])->name('select.theme');

// Blog (must stay above portfolio catch-all)
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/feed.xml', BlogFeedController::class)->name('blog.feed');
Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Contact form
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');

// Legal pages
Route::get('/privacy', [App\Http\Controllers\LegalController::class, 'privacy'])->name('privacy');
Route::get('/terms', [App\Http\Controllers\LegalController::class, 'terms'])->name('terms');

Route::get('/portfolio/{id}/{username}/pdf', [PortfolioController::class, 'downloadPdf'])
    ->name('portfolio.pdf');
// Blocks
Route::put('/dashboard/blocks/{userBlock}/enable', [DashboardController::class, 'enableBlock'])
    ->name('dashboard.blocks.enable');

Route::put('/dashboard/blocks/{userBlock}/disable', [DashboardController::class, 'disableBlock'])
    ->name('dashboard.blocks.disable');
Route::post('/dashboard/blocks', [DashboardController::class, 'store'])->name('dashboard.blocks.store');
// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'overview'])->name('dashboard');
    Route::get('/dashboard/content', [DashboardController::class, 'content'])->name('dashboard.content');
    Route::get('/dashboard/templates', [DashboardController::class, 'templates'])->name('dashboard.templates');
    Route::get('/dashboard/publish', [DashboardController::class, 'publish'])->name('dashboard.publish');
    Route::get('/dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');
    Route::get('/dashboard/upgrade', [DashboardController::class, 'upgrade'])->name('dashboard.upgrade');
    Route::post('/dashboard/waitlist', [DashboardController::class, 'joinWaitlist'])->name('dashboard.waitlist');
    Route::post('/dashboard/resume/import', [DashboardController::class, 'importResume'])->name('dashboard.resume.import');



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

    Route::post('/dashboard/achievement', [DashboardController::class, 'storeAchievement'])
    ->name('dashboard.achievements.store');

Route::put('/dashboard/achievement/{id}', [DashboardController::class, 'updateAchievement'])
    ->name('dashboard.achievements.update');

Route::post('/dashboard/achievement/reorder', [DashboardController::class, 'reorderAchievements'])
    ->name('dashboard.achievements.reorder');

Route::delete('/dashboard/achievement/{id}', [DashboardController::class, 'deleteAchievement'])
    ->name('dashboard.achievements.delete');
    Route::post('/dashboard/gallery', [DashboardController::class, 'storeGallery'])
    ->name('dashboard.gallery.store');

Route::put('/dashboard/gallery/{id}', [DashboardController::class, 'updateGallery'])
    ->name('dashboard.gallery.update');

Route::post('/dashboard/gallery/reorder', [DashboardController::class, 'reorderGalleries'])
    ->name('dashboard.gallery.reorder');

Route::delete('/dashboard/gallery/{id}', [DashboardController::class, 'deleteGallery'])
    ->name('dashboard.gallery.delete');



    Route::post('/dashboard/certifications', [DashboardController::class, 'storeCertification'])
    ->name('dashboard.certifications.store');

Route::put('/dashboard/certifications/{id}', [DashboardController::class, 'updateCertification'])
    ->name('dashboard.certifications.update');

Route::post('/dashboard/certifications/reorder', [DashboardController::class, 'reorderCertifications'])
    ->name('dashboard.certifications.reorder');

Route::delete('/dashboard/certifications/{id}', [DashboardController::class, 'deleteCertification'])
    ->name('dashboard.certifications.delete');

    Route::post('/dashboard/education', [DashboardController::class, 'storeEducation'])->name('dashboard.education.store');
    Route::put('/dashboard/education/{id}', [DashboardController::class, 'updateEducation'])->name('dashboard.education.update');
    Route::post('/dashboard/education/reorder', [DashboardController::class, 'reorderEducations'])->name('dashboard.education.reorder');
    Route::delete('/dashboard/education/{id}', [DashboardController::class, 'deleteEducation'])->name('dashboard.education.delete');

    Route::post('/dashboard/testimonial', [DashboardController::class, 'storeTestimonial'])
    ->name('dashboard.testimonial.store');

Route::put('/dashboard/testimonial/{id}', [DashboardController::class, 'updateTestimonial'])
    ->name('dashboard.testimonial.update');

Route::post('/dashboard/testimonial/reorder', [DashboardController::class, 'reorderTestimonials'])
    ->name('dashboard.testimonial.reorder');

Route::delete('/dashboard/testimonial/{id}', [DashboardController::class, 'deleteTestimonial'])
    ->name('dashboard.testimonial.delete');

    Route::post('/dashboard/experience', [DashboardController::class, 'storeExperience'])->name('dashboard.experience.store');
    Route::put('/dashboard/experience/{id}', [DashboardController::class, 'updateExperience'])->name('dashboard.experience.update');
    Route::post('/dashboard/experience/reorder', [DashboardController::class, 'reorderExperiences'])->name('dashboard.experience.reorder');
    Route::delete('/dashboard/experience/{id}', [DashboardController::class, 'deleteExperience'])->name('dashboard.experience.delete');

    Route::post('/dashboard/volunteers', [DashboardController::class, 'storeVolunteer'])
    ->name('dashboard.volunteers.store');

Route::put('/dashboard/volunteers/{id}', [DashboardController::class, 'updateVolunteer'])
    ->name('dashboard.volunteers.update');

Route::post('/dashboard/volunteers/reorder', [DashboardController::class, 'reorderVolunteers'])
    ->name('dashboard.volunteers.reorder');

Route::delete('/dashboard/volunteers/{id}', [DashboardController::class, 'deleteVolunteer'])
    ->name('dashboard.volunteers.delete');

    Route::post('/dashboard/service', [DashboardController::class, 'storeService'])
    ->name('dashboard.service.store');

Route::put('/dashboard/service/{id}', [DashboardController::class, 'updateService'])
    ->name('dashboard.service.update');

Route::post('/dashboard/service/reorder', [DashboardController::class, 'reorderServices'])
    ->name('dashboard.service.reorder');

Route::delete('/dashboard/service/{id}', [DashboardController::class, 'deleteService'])
    ->name('dashboard.service.delete');
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('themes', AdminThemeController::class);
        Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
        Route::resource('users', AdminUserController::class);
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
    });
});

// Sitemap
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

require __DIR__.'/auth.php';

// Public portfolio route (must be last to avoid conflicts)
Route::get('/{id}/{username}', [PortfolioController::class, 'show'])->name('portfolio.show');
