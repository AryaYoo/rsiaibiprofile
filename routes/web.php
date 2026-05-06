<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\ComproController::class, 'index'])->name('home');

// Admin Auth & Protected Routes
Route::prefix('admienz')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    
    // CMS Settings & Doctors
    Route::get('settings', [App\Http\Controllers\Admin\ContentController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [App\Http\Controllers\Admin\ContentController::class, 'update'])->name('admin.settings.update');
    Route::resource('doctors', App\Http\Controllers\Admin\DoctorController::class)->names('admin.doctors');
    Route::resource('promotions', App\Http\Controllers\Admin\PromotionController::class)->names('admin.promotions');
    Route::post('promotions/{promotion}/toggle', [App\Http\Controllers\Admin\PromotionController::class, 'toggle'])->name('admin.promotions.toggle');

    // CMS News
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class)->names([
        'index' => 'admin.news.index',
        'create' => 'admin.news.create',
        'store' => 'admin.news.store',
        'edit' => 'admin.news.edit',
        'update' => 'admin.news.update',
        'destroy' => 'admin.news.destroy',
    ]);
    
    // CMS Services
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);
    
    // CMS Gallery
    Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class)->only(['index', 'store', 'destroy'])->names([
        'index' => 'admin.gallery.index',
        'store' => 'admin.gallery.store',
        'destroy' => 'admin.gallery.destroy',
    ]);
    
    // CMS Schedules
    Route::resource('schedules', App\Http\Controllers\Admin\ScheduleController::class)->names([
        'index' => 'admin.schedules.index',
        'create' => 'admin.schedules.create',
        'store' => 'admin.schedules.store',
        'edit' => 'admin.schedules.edit',
        'update' => 'admin.schedules.update',
        'destroy' => 'admin.schedules.destroy',
    ]);
    
    // CMS Instagram
    Route::resource('instagram', App\Http\Controllers\Admin\InstagramPostController::class)->only(['index', 'store', 'update', 'destroy'])->names([
        'index' => 'admin.instagram.index',
        'store' => 'admin.instagram.store',
        'update' => 'admin.instagram.update',
        'destroy' => 'admin.instagram.destroy',
    ]);
    
    // CMS Feedback
    Route::resource('feedback', App\Http\Controllers\Admin\FeedbackController::class)->only(['index', 'show', 'destroy'])->names([
        'index' => 'admin.feedback.index',
        'show' => 'admin.feedback.show',
        'destroy' => 'admin.feedback.destroy',
    ]);
    
    // Future CMS Routes
    // Route::resource('news', NewsController::class);
    // Route::resource('services', ServiceController::class);
    // Route::resource('gallery', GalleryController::class);
    // Route::resource('settings', ContentController::class);
    });
});

Route::prefix('company-profile')->group(function () {
    Route::get('/layanan', [App\Http\Controllers\ComproController::class, 'layanan'])->name('compro.layanan');
    Route::get('/tentang', [App\Http\Controllers\ComproController::class, 'tentang'])->name('compro.tentang');
    Route::get('/berita', [App\Http\Controllers\ComproController::class, 'berita'])->name('compro.berita');
    Route::get('/berita/{slug}', [App\Http\Controllers\ComproController::class, 'beritaDetail'])->name('compro.berita.detail');
    Route::get('/kontak', [App\Http\Controllers\ComproController::class, 'kontak'])->name('compro.kontak');
    Route::get('/galeri', [App\Http\Controllers\ComproController::class, 'galeri'])->name('compro.galeri');
    Route::post('/feedback', [App\Http\Controllers\ComproController::class, 'storeFeedback'])->name('compro.feedback.store');
    Route::get('/under-development', function () {
        return view('compro.under-development');
    })->name('compro.under-development');
});
