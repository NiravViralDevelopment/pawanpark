<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/service/{id}', [PageController::class, 'serviceDetail'])->name('service.detail');
Route::get('/project', [PageController::class, 'project'])->name('project');
Route::get('/project/{id}', [PageController::class, 'projectDetail'])->name('project.detail');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{id}', [PageController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/brochure-download', [PageController::class, 'brochureDownload'])->name('brochure.download');
Route::post('/property-contact', [PageController::class, 'propertyContact'])->name('property.contact');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Projects CRUD
        Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
        Route::delete('/projects/{project}/delete-image', [\App\Http\Controllers\Admin\ProjectController::class, 'deleteImage'])->name('projects.delete-image');
        
        // Banners CRUD
        Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
        
        // Teams CRUD
        Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class);
        
        // Testimonials CRUD
        Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
        
        // Blogs CRUD
        Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
        
        // Services CRUD
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        
        // Contacts Management
        Route::get('/contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
        Route::post('/contacts/{id}/toggle-read', [\App\Http\Controllers\Admin\ContactController::class, 'toggleRead'])->name('contacts.toggle-read');
        Route::delete('/contacts/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contacts.destroy');
    });
});
